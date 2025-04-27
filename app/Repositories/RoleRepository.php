<?php
namespace App\Repositories;

use App\Models\Role;

class RoleRepository
{
    /**
     * Create a new class instance.
     */
    public function getAll()
    {
        return Role::all();
    }
    public function getById($id)
    {
        return Role::find($id);
    }
    public function create($data)
    {
        return Role::create($data);
    }
    public function update($id, $data)
    {
        $role = Role::find($id);
        if ($role) {
            $role->update($data);
            return $role;
        }
        return null;
    }
    public function delete($id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->delete();
            return true;
        }
        return false;
    }

}
