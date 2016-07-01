<?php


namespace MichalJurkowski\TgPass\Engine\Models\Traits;

trait PassUserTrait
{
    public function getIdByEmail($email) {
        return $this->where('email', $email)->value('id');
    }

    public function isSuperAdmin() {
        $user = Auth::user();
        $result = $user
            ?  $this->getUserRole($user->id) == 'SuperAdmin'
            :  false;

        return $result;
    }

    public function can($ability, $attributes = []) {
        $user = Auth::user();
        $result = $user
            ? $this->userHasAbility($ability, $user->id)
            : false;

        return $result;
    }

    private function userHasAbility($ability, $userId) {
        $count = $this
            ->leftJoin('pass_user_roles', 'users.id', '=', 'pass_user_roles.user_id')
            ->leftJoin('pass_permissions', 'pass_permissions.role_id', '=', 'pass_user_roles.role_id')
            ->leftJoin('pass_resources', 'pass_resources.id', '=', 'pass_permissions.resource_id')
            ->where('users.id', $userId)
            ->where('pass_resources.name', $ability)
            ->count();

        return $count != 0;
    }

    public function getUserRole($userId = null) {
        if (!$userId) {
            if ($this->id)
                $userId = $this->id;
            else
                return 'guest';
        }

        return $this
            ->leftJoin('pass_user_roles', 'users.id', '=', 'pass_user_roles.user_id')
            ->leftJoin('pass_roles', 'pass_roles.id', '=', 'pass_user_roles.role_id')
            ->where('users.id', $userId)
            ->select('pass_roles.name as role_name')
            ->value('role_name');
    }
}
