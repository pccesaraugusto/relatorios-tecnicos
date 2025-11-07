<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return Role::all();
    }

    public function show($id)
    {
        return Role::findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'description' => 'nullable',
            'permissions' => 'nullable|json',
        ]);

        return Role::create($data);
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $data = $request->validate([
            'display_name' => 'sometimes|required',
            'description' => 'nullable',
            'permissions' => 'nullable|json',
        ]);
        $role->update($data);
        return $role;
    }

    public function destroy($id)
    {
        Role::destroy($id);
        return response()->noContent();
    }
}
