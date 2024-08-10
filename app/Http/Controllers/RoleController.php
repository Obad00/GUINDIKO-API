<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    public function index(): JsonResponse
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate(['name' => 'required|unique:roles,name']);
        $role = Role::create(['name' => $request->name]);
        return response()->json($role, 201);
    }

    public function show(Role $role): JsonResponse
    {
        return response()->json($role);
    }

    public function update(Request $request, Role $role): JsonResponse
    {
        $request->validate(['name' => 'required|unique:roles,name,' . $role->id]);
        $role->update(['name' => $request->name]);
        return response()->json($role);
    }

    public function destroy(Role $role): JsonResponse
    {
        $role->delete();
        return response()->json(null, 204);
    }
}

