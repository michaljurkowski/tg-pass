<?php

namespace MichalJurkowski\TgPass\Engine\Models\Traits;

use Session;
use Auth;

trait PassUserTrait
{
    public function getIdByEmail($email)
    {
        return $this->where('email', $email)->value('id');
    }

    public function isSuperAdmin()
    {
        $user = Auth::user();
        $result = $user
            ?  $this->getUserRole($user->id) == 'SuperAdmin'
            :  false;

        return $result;
    }

    public function can($ability, $attributes = [])
    {
        $user = Auth::user();

        $abilityList = $this->userHasAbility($user->id);

        $result = in_array($ability, $abilityList);

        return $result;
    }

    private function userHasAbility($userId)
    {
        if(Session::has('tg_pass.ability_list')) {
            return Session::get('tg_pass.ability_list');
        }

        $abilityList = $this
            ->leftJoin('pass_user_roles', 'users.id', '=', 'pass_user_roles.user_id')
            ->leftJoin('pass_permissions', 'pass_permissions.role_id', '=', 'pass_user_roles.role_id')
            ->leftJoin('pass_resources', 'pass_resources.id', '=', 'pass_permissions.resource_id')
            ->where('users.id', $userId)
            ->select('pass_resources.name')
            ->pluck('name')
            ->toArray();

        Session::put('tg_pass.ability_list', $abilityList);

        return $abilityList;
    }

    public function getUserRole($userId = null)
    {

        if (!$userId) {
            if ($this->id)
                $userId = $this->id;
            else
                return 'guest';
        }

        if(Session::has('tg_pass.role_name')) {
            return Session::get('tg_pass.role_name');
        }

        $roleName =  $this
            ->leftJoin('pass_user_roles', 'users.id', '=', 'pass_user_roles.user_id')
            ->leftJoin('pass_roles', 'pass_roles.id', '=', 'pass_user_roles.role_id')
            ->where('users.id', $userId)
            ->select('pass_roles.name as role_name')
            ->value('role_name');

        Session::put('tg_pass.role_name', $roleName);

        return $roleName;
    }
}
