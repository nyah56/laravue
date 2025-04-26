<?php
namespace App\Http\Controllers;

use App\Http\Requests\StockMovementRequest;
use App\Http\Resources\StockMovementResource;
use App\Services\StockMovementService;

class StockMovementController extends Controller
{
    //
    protected $stocks;
    public function __construct(StockMovementService $stocks)
    {
        $this->stocks = $stocks;
    }
    public function index()
    {
        // return response()->json([
        //     'data' => $this->stocks->getAll(),
        // ]);
        return StockMovementResource::collection($this->stocks->getAll());
    }
    public function show($id)
    {
        $stocks = $this->stocks->getById($id);
        if ($stocks) {
            return response()->json([
                'data' => $stocks,
            ]);
        }
        return response()->json([
            'message' => 'stocks not found',
        ], 404);
    }

    public function store(StockMovementRequest $request)
    {

        $validated = $request->validated();

        $stocks = $this->stocks->create($validated);
        // dd($stocks);
        return response()->json([
            'data' => $stocks,
        ]);
    }
    public function update(StockMovementRequest $request, $id)
    {
        $validated = $request->validated();
        $stocks    = $this->stocks->update($validated, $id);
        if ($stocks) {
            return response()->json([
                'data' => $stocks,
            ]);
        }
        return response()->json([
            'message' => 'stocks not found',
        ], 404);
    }
    public function destroy($id)
    {
        $deleted = $this->stocks->delete($id);
        if ($deleted) {
            return response()->json([
                'message' => 'stocks deleted successfully',
            ]);
        }
        return response()->json([
            'message' => 'stocks not found',
        ], 404);
    }
}
