<?php

namespace App\Http\Controllers\api;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        return response()->json($role);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'description' => 'nullable',
            'permissions' => 'nullable|json',
        ]);

        $role = Role::create($data);
        return response()->json($role, 201);
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'display_name' => 'required',
            'description' => 'nullable',
            'permissions' => 'nullable|json',
        ]);

        $role->update($data);

        return response()->json($role, 200);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->noContent(); // HTTP 204
    }
}
