<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StorePermissionRequest;

class PermissionController extends Controller
{
    public function index()
    {
        return Permission::all();
    }

    public function store(StorePermissionRequest $request)
    {
        $permission = Permission::create(['name' => $request->input('name'), 'guard_name' => 'sanctum']);
        return response()->json($permission, 201);
    }
}
