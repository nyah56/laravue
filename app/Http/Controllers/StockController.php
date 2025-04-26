<?php
namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Http\Resources\StockResource;
use App\Services\StockService;

class StockController extends Controller
{
    //
    protected $stocks;
    public function __construct(StockService $stocks)
    {
        $this->stocks = $stocks;
    }
    public function index()
    {
        // return response()->json([
        //     'data' => $this->stocks->getAll(),
        // ]);
        // dd($this->stocks->getAll());
        return StockResource::collection($this->stocks->getAll());
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

    public function store(StockRequest $request)
    {

        $validated = $request->validated();

        $stocks = $this->stocks->create($validated);
        return response()->json([
            'data' => $stocks,
        ]);
    }
    public function update(StockRequest $request, $id)
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
