<?php

namespace MichalJurkowski\TgPass\database\seeds;

use Illuminate\Database\Seeder;

class PassUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = config('tg_pass.users');

        foreach ($users as $user) {
            $userExists = DB::table('users')
                ->where('users.email', $user['email'])
                ->count();

            if ($userExists == 0) {
                $user['password'] = bcrypt($user['password']);
                DB::table('users')->insert($user);
                $this->command->info('New user ' . $user['name'] . ' was added!');
            }
        }
    }
}
