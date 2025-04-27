<?php
namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService
{
    /**
     * Create a new class instance.
     */
    protected $role;
    public function __construct(RoleRepository $role)
    {
        //
        $this->role = $role;
    }
    public function getAll()
    {
        return $this->role->getAll();
    }
    public function getById($id)
    {
        return $this->role->getById($id);
    }
    public function create(array $data)
    {
        return $this->role->create($data);
    }
    public function update(array $data, $id)
    {
        return $this->role->update($id, $data);
    }
    public function delete($id)
    {
        return $this->role->delete($id);
    }
}
