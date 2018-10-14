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

        //Admin
        $admin = Role::create(['name' => 'Admin']);

        $admin->givePermissionTo([
            'role.list',
            'role.create',
            'role.edit',
            'role.delete',
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