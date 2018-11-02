<?php


use Illuminate\Database\Seeder;
//use Illuminate\Foundation\Auth\User;
use App\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('permissions')->truncate();

        Schema::enableForeignKeyConstraints();

        //Permission list
        Permission::create(['name' => 'role.list']);
        Permission::create(['name' => 'role.create']);
        Permission::create(['name' => 'role.edit']);
        Permission::create(['name' => 'role.delete']);
        Permission::create(['name' => 'user.list']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.edit']);
        Permission::create(['name' => 'user.delete']);
        Permission::create(['name' => 'zone.list']);
        Permission::create(['name' => 'zone.create']);
        Permission::create(['name' => 'zone.edit']);
        Permission::create(['name' => 'zone.delete']);
        Permission::create(['name' => 'collector.list']);
        Permission::create(['name' => 'collector.create']);
        Permission::create(['name' => 'collector.edit']);
        Permission::create(['name' => 'collector.delete']);
        Permission::create(['name' => 'city.list']);
        Permission::create(['name' => 'city.create']);
        Permission::create(['name' => 'city.edit']);
        Permission::create(['name' => 'city.delete']);
        Permission::create(['name' => 'client.list']);
        Permission::create(['name' => 'client.create']);
        Permission::create(['name' => 'client.edit']);
        Permission::create(['name' => 'client.delete']);
        Permission::create(['name' => 'loan.list']);
        Permission::create(['name' => 'loan.create']);
        Permission::create(['name' => 'loan.edit']);
        Permission::create(['name' => 'loan.delete']);
        Permission::create(['name' => 'loanstype.list']);
        Permission::create(['name' => 'loanstype.create']);
        Permission::create(['name' => 'loanstype.edit']);
        Permission::create(['name' => 'loanstype.delete']);
        Permission::create(['name' => 'income.list']);
        Permission::create(['name' => 'income.create']);
        Permission::create(['name' => 'income.edit']);
        Permission::create(['name' => 'income.delete']);

        //Roles
        $adminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'Usuario']);
        $adminRole->givePermissionTo(Permission::all());
//        $adminRole->givePermissionTo([
//            'role.list',
//            'role.create',
//            'role.edit',
//            'role.delete',
//        ]);

        $userRole->givePermissionTo([
            'user.list',
            'zone.list',
            'zone.create',
            'zone.edit',
            'zone.delete',
            'collector.list',
            'collector.create',
            'collector.edit',
            'collector.delete',
            'city.list',
            'city.create',
            'city.edit',
            'city.delete',
            'client.list',
            'client.create',
            'client.edit',
            'loan.list',
            'loan.create',
            'loan.edit',
            'loanstype.list',
            'loanstype.edit',
            'income.list',
            'income.create',
            'income.edit',
        ]);

        //$admin->givePermissionTo('products.index');
        //$admin->givePermissionTo(Permission::all());

        //Guest
//        $guest = Role::create(['name' => 'Guest']);

//        $guest->givePermissionTo([
//            'roles.index',
//            'roles.show'
//        ]);

        //User Admin
        $user = User::find(1);
        $user->assignRole('Admin');
    }
}