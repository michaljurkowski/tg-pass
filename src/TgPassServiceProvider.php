<?php

namespace MichalJurkowski\TgPass;

use Illuminate\Support\ServiceProvider;

class TgPassServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // use this if your package needs a config file
        $this->publishes([
            __DIR__.'/config/tg_pass.php' => config_path('tg_pass.php'),
        ]);

        $this->publishes([
            __DIR__.'/database/migrations/2016_06_30_110848_create_pass_roles_table.php' => app_path('../database/migrations/2016_06_30_110848_create_pass_roles_table.php'),
            __DIR__.'/database/migrations/2016_06_30_113403_create_pass_user_roles_table.php' => app_path('../database/migrations/2016_06_30_113403_create_pass_user_roles_table.php'),
            __DIR__.'/database/migrations/2016_06_30_113435_create_pass_resources_table.php' => app_path('../database/migrations/2016_06_30_113435_create_pass_resources_table.php'),
            __DIR__.'/database/migrations/2016_06_30_113520_create_pass_permissions_table.php' => app_path('../database/migrations/2016_06_30_113520_create_pass_permissions_table.php')
        ], 'migrations');

        $this->publishes([
            __DIR__.'/database/seeds/PassPermissionsTableSeeder.php' => app_path('../database/seeds/PassPermissionsTableSeeder.php'),
            __DIR__.'/database/seeds/PassResourcesTableSeeder.php' => app_path('../database/seeds/PassResourcesTableSeeder.php'),
            __DIR__.'/database/seeds/PassRolesTableSeeder.php' => app_path('../database/seeds/PassRolesTableSeeder.php'),
            __DIR__.'/database/seeds/PassUserRolesTableSeeder.php' => app_path('../database/seeds/PassUserRolesTableSeeder.php'),
            __DIR__.'/database/seeds/PassUsersTableSeeder.php' => app_path('../database/seeds/PassUsersTableSeeder.php')
        ], 'seeds');

        $this->publishes([
            __DIR__.'/Engine/Models/PassPermission.php' => app_path('../app/Engine/Models/PassPermission.php'),
            __DIR__.'/Engine/Models/PassResource.php' => app_path('../app/Engine/Models/PassResource.php'),
            __DIR__.'/Engine/Models/PassRole.php' => app_path('../app/Engine/Models/PassRole.php'),
            __DIR__.'/Engine/Models/PassUserRole.php' => app_path('../app/Engine/Models/PassUserRole.php'),
            __DIR__.'/Engine/Models/User.php' => app_path('../app/Engine/Models/User.php')
        ], 'engine');


    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // use this if your package has a config file
        config([
            'config/tg_pass.php',
        ]);

        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(
            __DIR__.'/config/tg_pass.php', 'tg_pass'
        );
    }
}
