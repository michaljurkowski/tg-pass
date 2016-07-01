<?php

namespace App\Engine\Models;

use Illuminate\Database\Eloquent\Model;

class PassPermission extends Model
{

    protected $fillabe = [
        'role_id',
        'resource_id'
    ];

    public function permissionExists($roleId, $resourceId) {
        $count = $this
            ->where('role_id', $roleId)
            ->where('resource_id', $resourceId)
            ->count();

        return $count != 0;
    }
}
