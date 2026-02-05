<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Ticket;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $manager = User::query()->create([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('123456')
        ]);

        Role::query()->create(['name' => 'Admin']);

        $role = Role::query()->create(['name' => 'Manager']);

        $permissions = Permission::query()->pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $manager->assignRole([$role->id]);

        Ticket::factory(200)->create();
    }
}
