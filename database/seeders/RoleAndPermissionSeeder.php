<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleAndPermissionSeeder extends Seeder
{
	public function run()
	{
		$permissionsUser = [
			'products.index',
			'products.getProduct',

            'categories.index',
			'categories.getCategory',

            'cart.index',
            'cart.create',
            'cart.destroy',
		];
		$permissionsAdmin = array_merge([
			'users.index',
            'users.create',
            'users.modify',
            'users.destroy',



            'categories.create',
            'categories.modify',
            'categories.destroy',


            'products.create',
            'products.modify',
            'products.destroy',




		], $permissionsUser);

		// Roles
		$admin = Role::create(['name' => 'admin']);
		$user = Role::create(['name' => 'user']);

		foreach ($permissionsAdmin as $permission) {
			$permission = Permission::create(['name' => $permission]);
			$admin->givePermissionTo($permission);
		}
		foreach ($permissionsUser as $permission) {
			$permission = Permission::where(['name' => $permission])->first();
			$user->givePermissionTo($permission);
		}
	}
}
