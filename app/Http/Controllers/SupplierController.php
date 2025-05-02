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
    public function getDeleted()
    {
        return response()->json([
            'data' => $this->supplier->getDeleted(),
        ]);
    }
    public function restoreItemDeleted($id)
    {

        $supplier = $this->supplier->restoreItemDeleted($id);

        // dd($supplier_name);
        if (! $supplier) {
            return response()->json([
                'message' => 'Data Restored: ',
            ]);
        }
        return response()->json([
            'message' => 'Supplier not found',
        ], 404);
    }
    public function restoreAllDeleted()
    {

        $supplier = $this->supplier->restoreAllDeleted();

        // dd($supplier_name);

        return response()->json([
            'message' => 'Data Restored: ',
        ]);

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
        ]);
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
            ]);
        }
        return response()->json([
            'message' => 'Supplier not found',
        ], 404);
    }
}
