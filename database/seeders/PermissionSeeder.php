<?php

namespace Database\Seeders;

use App\Models\User\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
  /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Permission::LIST_OF_PERMISSIONS as $key => $value)
        {
            Permission::create([
                'key'           => $key,
                'label'         => $value
            ]);
        }
    }
}
