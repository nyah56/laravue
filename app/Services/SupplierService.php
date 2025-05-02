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
    public function getDeleted()
    {
        return $this->supplier->getDeleted();
    }
    public function restoreItemDeleted($id)
    {
        $this->supplier->restoreItemDeleted($id);
    }
    public function restoreAllDeleted()
    {
        $this->supplier->restoreAllDeleted();
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
