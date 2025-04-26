<?php
namespace App\Repositories;

use App\Models\StockMovement;
use App\Models\Stocks;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StockMovementRepository
{
    /**
     * Create a new class instance.
     */
    public function getAll()
    {
        return StockMovement::all();
    }
    public function getById($id)
    {
        return StockMovement::find($id);
    }
    public function create($data)
    {
        // dd($data);
        try {
            DB::beginTransaction(); // Optional: ensures rollback on failure

            // Update or create stock
            $stock = Stocks::updateOrCreate(
                ['product_id' => $data['product_id']]
            );

            // Handle PDF file upload
            $docs = isset($data['manifest_hardcopy'])
            ? $data['manifest_hardcopy']->storeAs(
                'documents',
                $data['product_id'] . '-' . now()->timestamp . '-' . $data['manifest_hardcopy']->getClientOriginalName(),
                'public'
            )
            : null;

            // Adjust stock quantity
            if ($data['type'] === 'in') {
                $stock->quantity += $data['quantity'];
            } else {
                if ($stock->quantity < $data['quantity']) {
                    throw new \Exception('Not enough stock to proceed.');
                }
                $stock->quantity -= $data['quantity'];
            }

            $stock->save();

            // Add PDF path to data
            $data['manifest_hardcopy'] = $docs;

            // Create stock movement record
            $movement = StockMovement::create($data);

            DB::commit();

            return $movement;

        } catch (\Exception $e) {
            DB::rollBack(); // Optional: only needed if DB transactions are used

            Log::error('Stock Movement Error: ' . $e->getMessage());

            return response()->json([
                'error'   => 'Failed to process stock movement.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function update($id, $data)
    {
        // dd($data);
        try {
            DB::beginTransaction(); // optional but recommended

            $stockMovement = StockMovement::find($id);
            // dd($stockMovement->quantity);
            if (! $stockMovement) {
                throw new \Exception("Stock movement with ID {$id} not found.");
            }

            // Get current stock or create new one
            $stock = Stocks::updateOrCreate(['product_id' => $stockMovement->product_id]);

            // If a new file is uploaded, store it. Otherwise keep the old one
            $docs = isset($data['manifest_hardcopy'])
            ? $data['manifest_hardcopy']->storeAs(
                'documents',
                $stockMovement->product_id . '-' . now()->timestamp . '-' . $data['manifest_hardcopy']->getClientOriginalName(),
                'public'
            )
            : $stockMovement->manifest_hardcopy; //retrieve data from the database if change doesnt happen

            // Adjust stock
            // dd($stock['quantity']);
            $diff = $data['quantity'] - $stockMovement->quantity;
            if ($data['type'] === 'in') {
                $stock['quantity'] += $diff;
            } else {
                if ($stock['quantity'] < $diff) {
                    throw new \Exception('Not enough stock to fulfill this update.');
                }
                $stock['quantity'] -= $diff;
            }

            $stock->save();

            // Update the data array with current doc path
            $data['manifest_hardcopy'] = $docs;

            // Update the movement
            $stockMovement->update($data);

            DB::commit();

            return $stockMovement;

        } catch (\Exception $e) {
            DB::rollBack(); // rollback any DB changes

            Log::error('Stock Movement Update Error: ' . $e->getMessage());

            return response()->json([
                'error'   => 'Failed to update stock movement.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function delete($id)
    {
        $stockMovement = StockMovement::find($id);
        if ($stockMovement) {
            $stockMovement->delete();
            return true;
        }
        return false;
    }
}
