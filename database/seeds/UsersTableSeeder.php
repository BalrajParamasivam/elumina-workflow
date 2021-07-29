<?php

use Illuminate\Database\Seeder;

use App\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user= User::create(['name' => 'admin', 'password' => 'admin']);

        $user->assignRole('admin');

        $user1= User::create(['name' => 'customer', 'password' => 'customer']);

        $user1->assignRole('customer');
    }
}
