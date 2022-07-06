<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Role::class);
        return response()->json(Role::all());
    }

    public function show(Role $role)
    {
        $this->authorize('view', $role);
        return $role;
    }

    public function store(Request $request)
    {
        $this->authorize('create', Role::class);

        $validatedData = $request->validate([
            'name' => 'required|string|unique:roles|max:255',
        ]);

        $role = Role::create($validatedData);

        return response()->json($role, 201);
    }

    public function update(Request $request, Role $role)
    {
        $this->authorize('update', $role);

        $validatedData = $request->validate([
            'name' => 'required|string|unique:roles|max:255',
        ]);

        $role->update($validatedData);
        return response()->json($role, 200);
    }

    public function delete(Request $request, Role $role)
    {
        $this->authorize('delete', $role);

        $role->delete();
        return response()->json(null, 204);
    }
}
