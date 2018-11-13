<?php

use App\Frecuency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FrecuencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('frecuency_types')->truncate();

        Schema::enableForeignKeyConstraints();

        $frecuencies = [
            'semanal',
            'mensual'
        ];

        foreach ($frecuencies as $frecuency) {
            Frecuency::create([
                'name' => $frecuency
            ]);
        }
    }
}
