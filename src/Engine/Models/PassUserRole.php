<?php

namespace App\Engine\Models;

use Illuminate\Database\Eloquent\Model;

class PassUserRole extends Model
{

    protected $fillable = [
        'user_id',
        'role_id'
    ];

    public function userRoleExists($userId, $roleId) {
        $count = $this
            ->where('user_id', $userId)
            ->where('role_id', $roleId)
            ->count();

        return $count != 0;
    }

    public function getByUserId($userId)
    {
        return $this->where('user_id', $userId)->first();
    }
}
