<?php
namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    /**
     * Create a new class instance.
     */
    protected $product;
    public function __construct(ProductRepository $product)
    {
        //
        $this->product = $product;
    }

    public function getAll()
    {
        return $this->product->getAll();
    }
    public function getById($id)
    {
        return $this->product->getById($id);
    }
    public function create(array $data)
    {
        return $this->product->create($data);
    }
    public function update(array $data, $id)
    {
        return $this->product->update($id, $data);
    }
    public function delete($id)
    {
        return $this->product->delete($id);
    }
}
