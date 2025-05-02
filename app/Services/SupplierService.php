<?php
namespace App\Services;

use App\Repositories\SupplierRepository;

// use App\Repository\SupplierRepository as RepositorySupplierRepository;

class SupplierService
{
    /**
     * Create a new class instance.
     */
    protected $supplier;
    public function __construct(SupplierRepository $supplier)
    {
        //
        $this->supplier = $supplier;
    }
    public function getAll()
    {
        return $this->supplier->getAll();
    }
    public function getTrashed()
    {
        return $this->supplier->getTrashed();
    }
    public function restoreItemTrashed($id)
    {
        $this->supplier->restoreItemTrashed($id);
    }
    public function restoreAllTrashed()
    {
        $this->supplier->restoreAllTrashed();
    }
    public function getById($id)
    {
        return $this->supplier->getById($id);
    }
    public function create(array $data)
    {
        return $this->supplier->create($data);
    }
    public function update(array $data, $id)
    {
        return $this->supplier->update($id, $data);
    }
    public function delete($id)
    {
        return $this->supplier->delete($id);
    }
}
