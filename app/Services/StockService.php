<?php
namespace App\Services;

use App\Repositories\StockRepository;

class StockService
{
    /**
     * Create a new class instance.
     */
    protected $stocks;
    public function __construct(StockRepository $stocks)
    {
        //
        $this->stocks = $stocks;
    }
    public function getAll()
    {
        return $this->stocks->getAll();
    }
    public function getById($id)
    {
        return $this->stocks->getById($id);
    }
    public function create(array $data)
    {
        return $this->stocks->create($data);
    }
    public function update(array $data, $id)
    {
        return $this->stocks->update($id, $data);
    }
    public function delete($id)
    {
        return $this->stocks->delete($id);
    }
}
