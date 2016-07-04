<?php

namespace MichalJurkowski\TgPass\database\seeds;

use Illuminate\Database\Seeder;
use App\Engine\Models\PassUserRole;
use App\Engine\Models\PassRole;
use App\Engine\Models\User;

class PassUserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRoles = config('tg_pass.userRoles');

        foreach ($userRoles as $userRole) {
            $userId = (new User)->getIdByEmail($userRole['user_email']);
            if (! $userId)
                dd('user id is missing');

            $roleId = (new PassRole)->getIdByName($userRole['role']);
            if (! $roleId)
                dd('role id is missing');

            $userRoleExists = (new PassUserRole)->userRoleExists($userId, $roleId);

            if (! $userRoleExists) {
                (new PassUserRole)->create([
                    'user_id' => $userId,
                    'role_id' => $roleId
                ]);

                $this->command->info('Role '. $userRole['role'] .' for user '. $userRole['user_email'] .' was added!');
            }
        }
    }
}
