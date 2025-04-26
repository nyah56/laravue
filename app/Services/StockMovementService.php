<?php
namespace App\Services;

use App\Repositories\StockMovementRepository;

class StockMovementService
{
    /**
     * Create a new class instance.
     */
    protected $stocks;
    public function __construct(StockMovementRepository $stocks)
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
