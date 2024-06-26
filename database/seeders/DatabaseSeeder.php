<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Level;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /* Roles */

        /* ID = 1 */
        $role = new Role();
        $role->name = 'a';
        $role->description = 'Admin';
        $role->save();

        /* ID = 2 */
        $role = new Role();
        $role->name = 'u';
        $role->description = 'User';
        $role->save();


        /* Admin */
        $user = new User();

        $user->f_name = 'Admin';
        $user->l_name = 'Inventory';
        $user->phone = 0000000000;
        $user->email = 'mikecervantes2024@gmail.com';
        $user->password = Hash::make('admin.pass');
        // $user->email = 'coriaedd@gmail.com';
        // $user->password = Hash::make('kobeni');
        $user->active = true;
        $user->role_id = 1;

        $user->save();

        /* Levels */
        for($i = 1; $i <= 4; $i ++){
            $level = new Level();
            $level->name = "lvl".(string)$i;
            $level->save();
        }
    }
}
