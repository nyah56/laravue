<?php
namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    protected $role;
    public function __construct(RoleService $role)
    {
        $this->role = $role;
    }
    public function index()
    {
        // return response()->json([
        //     'data' => $this->role->getAll(),
        // ]);
        // dd($this->role->getAll());
        return RoleResource::collection($this->role->getAll());
    }
    public function show($id)
    {
        // dd($id);
        $role = $this->role->getById($id);
        // dd($role);
        if ($role) {
            return response()->json([
                'data' => $role,
            ]);
        }
        return response()->json([
            'message' => 'Product not found',
        ], 404);
    }
    // on store and update dont forget add role_image logic on storage link
    public function store(Request $request)
    {
        $validated = $request->validated();
        $role      = $this->role->create($validated);
        return response()->json([
            'data' => $role,
        ]);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->all();
        $role      = $this->role->update($validated, $id);
        if ($role) {
            return response()->json([
                'data' => $role,
            ]);
        }
        return response()->json([
            'message' => 'Product not found',
        ], 404);
    }
    public function destroy($id)
    {
        dd($id);
        $deleted = $this->role->delete($id);
        if ($deleted) {
            return response()->json([
                'message' => 'Product deleted successfully',
            ]);
        }
        return response()->json([
            'message' => 'Product not found',
        ], 404);
    }

}
