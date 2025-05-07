<?php
namespace App\Repositories;

use App\Models\Products;

class ProductRepository
{
    /**
     * Create a new class instance.
     */
    public function getAll()
    {
        return Products::whereHas('supplier')->get();
    }
    public function getById($id)
    {
        return Products::find($id);
    }
    public function getTrashed()
    {
        return Products::onlyTrashed()->get();
    }
    public function restoreItem($id)
    {
        return Products::onlyTrashed()->find($id)->restore();
    }

    public function create($data)
    {
        return Products::create($data);
    }
    public function update($id, $data)
    {
        $product = Products::find($id);
        if ($product) {
            $product->update($data);
            return $product;
        }
        return null;
    }
    public function delete($id)
    {
        $product = Products::find($id);
        if ($product) {
            $product->delete();
            return true;
        }
        return false;
    }
}
