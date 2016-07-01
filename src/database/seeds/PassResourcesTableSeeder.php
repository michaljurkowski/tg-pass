<?php

use Illuminate\Database\Seeder;
use App\Engine\Models\PassResource;

class PassResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resources = config('tg_pass.resources');

        foreach ($resources as $resource) {
            $resourceExists = (new PassResource)->resourceExists($resource);

            if (! $resourceExists) {
                (new PassResource)->create([
                    'name' => $resource
                ]);

                $this->command->info('New resource ' . $resource . ' was added!');
            }
        }
    }
}
