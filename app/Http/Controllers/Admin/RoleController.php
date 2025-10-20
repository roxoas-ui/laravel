<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreRoleRequest;

class RoleController extends Controller
{
    public function index()
    {
        return Role::all();
    }

    public function store(StoreRoleRequest $request)
    {
        // API admin endpoints use sanctum guard
        $guard = 'sanctum';
        $role = Role::create(['name' => $request->input('name'), 'guard_name' => $guard]);
        return response()->json($role, 201);
    }
}
