<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\JsonResponse;

class PermissionController extends Controller
{
    public function index(): JsonResponse
    {
        $permissions = Permission::all();
        return response()->json($permissions);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate(['name' => 'required|unique:permissions,name']);
        $permission = Permission::create(['name' => $request->name]);
        return response()->json($permission, 201);
    }

    public function show(Permission $permission): JsonResponse
    {
        return response()->json($permission);
    }

    public function update(Request $request, Permission $permission): JsonResponse
    {
        $request->validate(['name' => 'required|unique:permissions,name,' . $permission->id]);
        $permission->update(['name' => $request->name]);
        return response()->json($permission);
    }

    public function destroy(Permission $permission): JsonResponse
    {
        $permission->delete();
        return response()->json(null, 204);
    }
}
