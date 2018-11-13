<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        User::create([
            'name' => 'Guillermo',
            'email' => 'admin@financiera.com',
            'password' => bcrypt('financiera'),
        ]);

        User::create([
            'name' => 'Sofia',
            'email' => 'sofia@financiera.com',
            'password' => bcrypt('financiera'),
        ]);
    }
}
