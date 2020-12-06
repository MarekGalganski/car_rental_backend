<?php

namespace App\Traits;

use App\Models\Permission;

trait HasPermissions
{
    public function hasPermissionTo(...$permissions)
    {
        return $this->permissions()->whereIn('slug', $permissions)->count() ||
            $this->roles()->whereHas('permissions', function($q) use ($permissions) {
                $q->whereIn('slug', $permissions);
            })->count();
    }

    private function getPermissionIdsBySlug($permissions)
    {
        return Permission::whereIn('slug', $permissions)->get()->pluck('id')->toArray();
    }

    public function givePermissionTo(...$permissions)
    {
        $permissionsIds = $this->getPermissionIdsBySlug($permissions);
        $this->permissions()->attach($permissionsIds);
    }

    public function setPermissions(...$permissions)
    {
        $permissionsIds = $this->getPermissionIdsBySlug($permissions);
        $this->permissions()->sync($permissionsIds);
    }

    public function detachPermissions(...$permissions)
    {
        $permissionsIds = $this->getPermissionIdsBySlug($permissions);
        $this->permissions()->detach($permissionsIds);
    }
}