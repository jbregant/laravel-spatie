<?php


use App\RoleHasPermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class RoleHasPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('role_has_permissions')->truncate();

        Schema::enableForeignKeyConstraints();

        //Admin
        DB::table('role_has_permissions')->insert([
            'permission_id' => '1',
            'role_id' => '1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => '2',
            'role_id' => '1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => '3',
            'role_id' => '1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => '4',
            'role_id' => '1'
        ]);
//        DB::table('role_has_permissions')->insert([
//            'permission_id' => '5',
//            'role_id' => '1'
//        ]);
//        DB::table('role_has_permissions')->insert([
//            'permission_id' => '6',
//            'role_id' => '1'
//        ]);
//        DB::table('role_has_permissions')->insert([
//            'permission_id' => '7',
//            'role_id' => '1'
//        ]);
//        DB::table('role_has_permissions')->insert([
//            'permission_id' => '8',
//            'role_id' => '1'
//        ]);
//
//        //User
//        DB::table('role_has_permissions')->insert([
//            'permission_id' => '1',
//            'role_id' => '2'
//        ]);
//        DB::table('role_has_permissions')->insert([
//            'permission_id' => '2',
//            'role_id' => '2'
//        ]);
//        DB::table('role_has_permissions')->insert([
//            'permission_id' => '3',
//            'role_id' => '2'
//        ]);
//        DB::table('role_has_permissions')->insert([
//            'permission_id' => '4',
//            'role_id' => '2'
//        ]);
//        DB::table('role_has_permissions')->insert([
//            'permission_id' => '5',
//            'role_id' => '2'
//        ]);
//        DB::table('role_has_permissions')->insert([
//            'permission_id' => '6',
//            'role_id' => '2'
//        ]);
//        DB::table('role_has_permissions')->insert([
//            'permission_id' => '7',
//            'role_id' => '2'
//        ]);
//        DB::table('role_has_permissions')->insert([
//            'permission_id' => '8',
//            'role_id' => '2'
//        ]);
    }
}
