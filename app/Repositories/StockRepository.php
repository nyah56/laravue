<?php
namespace App\Repositories;

use App\Models\Stocks;

class StockRepository
{
    /**
     * Create a new class instance.
     */
    public function getAll()
    {
        return Stocks::all();
    }
    public function getById($id)
    {
        return Stocks::find($id);
    }
    public function create($data)
    {
        return Stocks::create($data);
    }
    public function update($id, $data)
    {
        $stocks = Stocks::find($id);
        if ($stocks) {
            $stocks->update($data);
            return $stocks;
        }
        return null;
    }
    public function delete($id)
    {
        $stocks = Stocks::find($id);
        if ($stocks) {
            $stocks->delete();
            return true;
        }
        return false;
    }
}
