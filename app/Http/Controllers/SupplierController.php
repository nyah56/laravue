<?php
namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Services\SupplierService;

class SupplierController extends Controller
{
    //
    protected $supplier;
    public function __construct(SupplierService $supplier)
    {
        $this->supplier = $supplier;
    }
    public function index()
    {
        return response()->json([
            'data' => $this->supplier->getAll(),
        ]);
    }
    public function trashed()
    {
        return response()->json([
            'data' => $this->supplier->getTrashed(),
        ]);
    }
    public function restore($id)
    {

        $supplier = $this->supplier->restoreItem($id);

        // dd($supplier_name);
        if ($supplier) {
            return response()->json([
                'message' => 'Data Restored: ',
            ]);
        }
        return response()->json([
            'message' => 'Supplier not found',
        ], 404);
    }

    public function show($id)
    {
        $supplier = $this->supplier->getById($id);
        if ($supplier) {
            return response()->json([
                'data' => $supplier,
            ]);
        }
        return response()->json([
            'message' => 'Supplier not found',
        ], 404);
    }

    public function store(SupplierRequest $request)
    {

        $validated = $request->validated();

        $supplier = $this->supplier->create($validated);
        return response()->json([
            'data' => $supplier,
        ], 201);
    }
    public function update(SupplierRequest $request, $id)
    {
        $validated = $request->validated();
        $supplier  = $this->supplier->update($validated, $id);
        if ($supplier) {
            return response()->json([
                'data' => $supplier,
            ]);
        }
        return response()->json([
            'message' => 'Supplier not found',
        ], 404);
    }
    public function destroy($id)
    {
        $deleted = $this->supplier->delete($id);
        if ($deleted) {
            return response()->json([
                'message' => 'Supplier deleted successfully',
            ], 204);
        }
        return response()->json([
            'message' => 'Supplier not found',
        ], 404);
    }
}
