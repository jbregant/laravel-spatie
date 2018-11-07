<?php

use App\LoanType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LoanTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('loan_types')->truncate();

        Schema::enableForeignKeyConstraints();

        $loansType = [
            [
                'name' => 'Diario26',
                'min_loan_payments' => '1',
                'max_loan_payments' => '26',
                'loan_fee' => '26',
                'frecuency_type_id' => '1',
            ],
            [
                'name' => 'Diario28',
                'min_loan_payments' => '1',
                'max_loan_payments' => '28',
                'loan_fee' => '26',
                'frecuency_type_id' => '2',
            ],
            [
                'name' => 'Semanal',
                'min_loan_payments' => '1',
                'max_loan_payments' => '4',
                'loan_fee' => '26',
                'frecuency_type_id' => '1',
            ],
            [
                'name' => 'Quincenal',
                'min_loan_payments' => '1',
                'max_loan_payments' => '2',
                'loan_fee' => '26',
                'frecuency_type_id' => '1',
            ],
            [
                'name' => 'Mensual',
                'min_loan_payments' => '1',
                'max_loan_payments' => '1',
                'loan_fee' => '26',
                'frecuency_type_id' => '2',
            ],
        ];

        foreach ($loansType as $loanType) {
            LoanType::create([
                'name' => $loanType['name'],
                'min_loan_payments' => $loanType['min_loan_payments'],
                'max_loan_payments' => $loanType['max_loan_payments'],
                'loan_fee' => $loanType['loan_fee'],
                'frecuency_type_id' => $loanType['frecuency_type_id']
            ]);
        }
    }
}
