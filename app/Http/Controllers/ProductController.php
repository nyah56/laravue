<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;

class ProductController extends Controller
{
    //
    protected $product;
    public function __construct(ProductService $product)
    {
        $this->product = $product;
    }
    public function index()
    {
        // return response()->json([
        //     'data' => $this->product->getAll(),
        // ]);
        // dd($this->product->getAll());
        return ProductResource::collection($this->product->getAll());
    }
    public function trashed()
    {
        // return response()->json([
        //     'data' => $this->product->getAll(),
        // ]);
        // dd($this->product->getAll());
        return ProductResource::collection($this->product->getTrashed());
    }
    public function restore($id)
    {
        $product = $this->product->restoreItem($id);

        // dd($product_name);
        if ($product) {
            return response()->json([
                'message' => 'Data Restored: ',
            ]);
        }
        return response()->json([
            'message' => 'Product not found',
        ], 404);
    }

    public function show($id)
    {
        $product = $this->product->getById($id);
        if ($product) {
            return response()->json([
                'data' => $product,
            ]);
        }
        return response()->json([
            'message' => 'Product not found',
        ], 404);
    }
    // on store and update dont forget add product_image logic on storage link
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        $product   = $this->product->create($validated);
        return response()->json([
            'data' => $product,
        ]);
    }
    public function update(ProductRequest $request, $id)
    {
        $validated = $request->validated();
        $product   = $this->product->update($validated, $id);
        if ($product) {
            return response()->json([
                'data' => $product,
            ]);
        }
        return response()->json([
            'message' => 'Product not found',
        ], 404);
    }
    public function destroy($id)
    {
        $deleted = $this->product->delete($id);
        if ($deleted) {
            return response()->json([
                'message' => 'Product deleted successfully',
            ]);
        }
        return response()->json([
            'message' => 'Product not found',
        ], 404);
    }
}
