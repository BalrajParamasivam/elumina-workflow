<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'admin-permission']);
        Permission::create(['name' => 'customer-permission']);


         // create roles
         $role_admin    = Role::create(['name' => 'admin']);
         $role_customer    = Role::create(['name' => 'customer']);

         // give permission based on role.
		$role_admin->givePermissionTo(['admin-permission']);

		$role_customer->givePermissionTo(['customer-permission']);


    }
}
