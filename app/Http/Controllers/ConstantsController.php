<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;

class ConstantsController extends Controller
{
    public function index()
    {
        $permissions = Permission::all()->map(function ($permission) {
            $permission->slugCamel = Str::camel($permission->slug);
            return $permission;
        })->pluck('slug', 'slugCamel');

        $roles = Role::all()->map(function ($role) {
            $role->slugCamel = Str::camel($role->slug);
            return $role;
        })->pluck('slug', 'slugCamel');

        return response()->json([
            'permissions' => $permissions,
            'roles' => $roles
        ]);
    }
}
