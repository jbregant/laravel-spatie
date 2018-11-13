<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserTableSeeder::class);
         $this->call(PermissionTableSeeder::class);
         $this->call(ZoneTableSeeder::class);
         $this->call(CollectorTableSeeder::class);
         $this->call(CityTableSeeder::class);
         $this->call(FrecuencyTableSeeder::class);
         $this->call(LoanTypeTableSeeder::class);
         $this->call(SettingsTableFeeder::class);
    }
}
