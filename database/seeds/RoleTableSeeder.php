<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use \Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('roles')->truncate();

        Schema::enableForeignKeyConstraints();

        Role::create([
            'name' => 'Administrador',
            'guard_name' => 'admin_panel'
        ]);

        Role::create([
            'name' => 'Usuario',
            'guard_name' => 'web'
        ]);
    }
}
