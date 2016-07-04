<?php

namespace MichalJurkowski\TgPass\database\seeds;

use Illuminate\Database\Seeder;
use App\Engine\Models\PassRole;
use App\Engine\Models\PassResource;
use App\Engine\Models\PassPermission;

class PassPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolePermissions = config('tg_pass.rolePermissions');

        foreach ($rolePermissions as $role => $resources) {
            foreach($resources as $resource) {
                $roleId = (new PassRole)->getIdByName($role);
                    if (! $roleId)
                        dd('role id is missing');

                $resourceId = (new PassResource)->getIdByName($resource);
                    if (! $resourceId)
                        dd('resource id is missing: '. $resource);

                $permissionExists = (new PassPermission)->permissionExists($roleId, $resourceId);

                if (! $permissionExists) {
                    (new PassPermission)->create([
                        'role_id' => $roleId,
                        'resource_id' => $resourceId
                    ]);

                    $this->command->info('Permission to role '. $role .' for resource '. $resource .' was added!');
                }
            }
        }
    }
}
