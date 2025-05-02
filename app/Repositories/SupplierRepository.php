<?php
namespace App\Repositories;

use App\Models\Supplier;

class SupplierRepository
{
    /**
     * Create a new class instance.
     */

    public function getAll()
    {
        return Supplier::all();
    }
    public function getDeleted()
    {
        return Supplier::onlyTrashed()->get();
    }
    public function restoreItemDeleted($id)
    {
        return Supplier::onlyTrashed()->find($id)->restore();
    }
    public function restoreAllDeleted()
    {
        return Supplier::onlyTrashed()->restore();
    }
    public function getById($id)
    {
        return Supplier::find($id);
    }
    public function create($data)
    {
        return Supplier::create($data);
    }
    public function update($id, $data)
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            $supplier->update($data);
            return $supplier;
        }
        return null;
    }
    public function delete($id)
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            $supplier->delete();
            return true;
        }
        return false;
    }

}
