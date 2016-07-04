<?php

namespace MichalJurkowski\TgPass\database\seeds;

use Illuminate\Database\Seeder;
use App\Engine\Models\PassRole;

class PassRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = config('tg_pass.roles');

        foreach ($roles as $role) {
            $roleExists = (new PassRole)->roleExists($role);

            if (! $roleExists) {
                (new PassRole)->create([
                    'name' => $role
                ]);

                $this->command->info('New role ' . $role . ' was added!');
            }
        }
    }
}
