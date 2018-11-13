<?php

use App\Zone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('zones')->truncate();

        Schema::enableForeignKeyConstraints();

        $zones = [
          'Morón',
          'González catán',
          'Laferrere',
          'Paso del rey',
          'Cascallares',
          'Castelar',
          'Ituzaingó',
          'Merlo',
          'San Miguel',
          'Isidro casanova',
          'San justo',
          'Moreno',
        ];

        foreach ($zones as $zone) {
            Zone::create([
                'name' => $zone
            ]);
        }
    }
}
