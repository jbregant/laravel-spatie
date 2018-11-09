<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SettingsTableFeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('app_settings')->truncate();

        Schema::enableForeignKeyConstraints();

        \App\Setting::create([
            'name' => 'Cantidad maxima de creditos por cliente',
            'value' => '3',
        ]);
    }
}
