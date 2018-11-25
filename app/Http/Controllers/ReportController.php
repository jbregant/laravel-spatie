<?php

namespace App\Http\Controllers;

use App\Collector;
use App\LoansGranted;
use App\PaymentsHistory;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function daily()
    {
        $title = 'Reporte Diario de Vencimientos';

        $collectorsAux = Collector::all();
        $collectors = [];

        foreach ($collectorsAux as $collector) {
            $collectors[$collector->id] = $collector->id . ' - ' . $collector->name . ' ' . $collector->lastname;
        }

        $dateFlag = false;
        return view('reports.daily',compact('title','collectors', 'dateFlag'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function dailyreport(Request $request)
    {
//        $date = $request->get('inputData');
        $collector = (int) $request->get('collector');
//        $dueDateFormat = DateTime::createFromFormat('d-m-Y', $date);
//        $date = $dueDateFormat->format('Y-m-d');
        $query = "SELECT lg.payment_amount as payment_amount, lg.updated_amount as debt, lg.collector_id as collector, lg.client_id as client_id, lg.id as loan_id,
                           c.name as name, c.lastname as lastname, c.address as address
                    FROM loans_granted as lg
                           INNER JOIN clients c on lg.client_id = c.id
                    WHERE lg.status = 'activo'";
        if ($collector){
            $query = $query . "and lg.collector_id = $collector" ;
        }

        $tableData = DB::select($query);
//        dd($tableData);
        return view('reports.daily-table', compact('tableData'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function dailyz()
    {
        $title = 'Reporte Diario de Pagos';
        $collectorsAux = Collector::all();
        $collectors = [];

        foreach ($collectorsAux as $collector) {
            $collectors[$collector->id] = $collector->id . ' - ' . $collector->name . ' ' . $collector->lastname;
        }

        $dateFlag = true;
        return view('reports.daily',compact('title','collectors', 'dateFlag'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function dailyzreport(Request $request)
    {
        $input = $request->all();
        $collector = (int) $request->get('collector');
        $dueDateFormat = DateTime::createFromFormat('d-m-Y', $input['inputData']);
        $date = $dueDateFormat->format('Y-m-d');

        $query = "SELECT ph.payment_date as payment_date, ph.payment_amount_paid,
                   lg.client_id as client_id, lg.updated_amount as debt, lg.collector_id as collector_id, lg.id as loan_id, 
                   c.name as name, c.lastname as lastname, c.address as address
                    FROM payments_history as ph
                           INNER JOIN loans_granted as lg ON lg.id = ph.loan_granted_id
                           INNER JOIN clients c on lg.client_id = c.id
                    WHERE ph.payment_date = '$date'";

        if ($collector){
            $query = $query . "and lg.collector_id = $collector" ;
        }

        $tableData = DB::select($query);
        $totalAmountPaid = 0;
        foreach ($tableData as $data) {
            $totalAmountPaid += $data->payment_amount_paid;
        }

        return view('reports.dailyz-table', compact('tableData','totalAmountPaid'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function paymentschedule()
    {
        $title = 'Cronograma de pagos';
        return view('reports.payment-schedule',compact('title'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function paymentschedulereport(Request $request)
    {
        $input = $request->all();
        $loanId = $input['inputData'];

        $loanGranted = LoansGranted::find($loanId);

        $paymentsHistory = DB::select("SELECT * FROM payments_history WHERE loan_granted_id = $loanId");
//        dd($paymentsHistory);
        $tableDataAux = DB::select("SELECT lgp.loan_granted_id as loan_id, lgp.payment_number as payment_number, lgp.due_date as due_date, lgp.payment_date as payment_date,
       lgp.payment_amount as payment_amount, lgp.payment_amount_paid as payment_amount_paid, lgp.status as status,
       lg.client_id as client_id, lg.payments as payments, lg.updated_amount as debt,
       c.name as name, c.lastname as lastname, c.address as address,
       lgpp.payment_amount_paid as partial_payment_amount_paid, lgpp.payment_date as partial_payment_date
FROM loans_granted_payments as lgp
            INNER JOIN loans_granted as lg ON lgp.loan_granted_id = lg.id
            INNER JOIN clients c on lg.client_id = c.id
            LEFT JOIN loans_granted_payments_partial as lgpp ON lgp.id = lgpp.loan_granted_payments_id
WHERE lg.id = '$loanId' order by payment_number");

        $tableData = [];

        foreach ($tableDataAux as $payment) {
            $paymentHistory = $this->findPaymentHistory($payment->due_date, $payment->loan_id, $paymentsHistory);
            $tableData[] = [
                'payment_number' => $payment->payment_number,
                'due_date' => $payment->due_date,
                'payment_amount' => $payment->payment_amount,
                'payment_amount_paid' => ($paymentHistory) ? $paymentHistory[0]['payment_amount_paid'] : '0',
                'payment_date' => ($paymentHistory) ? $paymentHistory[0]['payment_date'] : null,
            ];
        }
//        dd($this->findOrphansPayments($paymentsHistory, $tableData));
        return view('reports.payment-schedule-table', compact('tableData', 'loanGranted', 'paymentsHistory'));
    }

    function findPaymentHistory($date, $paymentId, $paymentsHistory){
        $dataReturn =  [];
        foreach ($paymentsHistory as $payment) {
            if(($payment->payment_date == $date) and ($payment->loan_granted_id == $paymentId)) {
                $dataReturn[] = [
                    'payment_date' => $payment->payment_date,
                    'payment_amount_paid' => $payment->payment_amount_paid
                ];
            }
        }
        if(!empty($dataReturn))
            return $dataReturn;
        return false;
    }

    function findOrphansPayments($paymentsHistory, $tableData){
        $dataReturn =  [];

        $paymentsDate = array_map(function($x){ return $x->payment_date->forma; }, $paymentsHistory);
        dd($paymentsDate);

        foreach ($paymentsHistory as $payment) {

            foreach ($tableData as $tableDatum) {

                if($payment->payment_date == $date){
                    $dataReturn[] = [
                        'payment_date' => $payment->payment_date,
                        'payment_amount_paid' => $payment->payment_amount_paid
                    ];
                }
            }
        }
        if(!empty($dataReturn))
            return $dataReturn;
        return false;
    }
}
