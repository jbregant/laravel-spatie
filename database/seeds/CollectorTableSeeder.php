<?php

use App\Collector;
use Illuminate\Database\Seeder;

class CollectorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('collectors')->truncate();

        Schema::enableForeignKeyConstraints();

        Collector::create([
            'name' => 'Nombre Cobrador',
            'lastname' => 'Apellido Cobrador',
            'phone' => '54112258578',
            'address' => 'siempre viva 742',
            'zone_id' => 1,
        ]);
    }
}
