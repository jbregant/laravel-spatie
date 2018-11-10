<?php

namespace App\Http\Controllers;

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
        return view('reports.daily',compact('title'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function dailyreport(Request $request)
    {
        $input = $request->all();
        $dueDateFormat = DateTime::createFromFormat('d-m-Y', $input['date']);
        $date = $dueDateFormat->format('Y-m-d');
        $tableData = DB::select("SELECT lgp.loan_granted_id as loan_id, lgp.payment_number as payment_number, lgp.due_date as due_date, lgp.payment_amount as payment_amount, lgp.payment_amount_paid as payment_amount_paid, lgp.status as status,
       lg.client_id as client_id, lg.payments as payments, lg.updated_amount as debt,
       c.name as name, c.lastname as lastname, c.address as address
      FROM loans_granted_payments as lgp
             INNER JOIN loans_granted as lg ON lgp.loan_granted_id = lg.id
             INNER JOIN clients c on lg.client_id = c.id
      WHERE lgp.due_date <= '$date' and (lgp.status = 'pendiente' or lgp.status = 'parcial')");

        return view('reports.daily-table', compact('tableData'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function dailyz()
    {
        $title = 'Reporte Diario de Pagos';
        return view('reports.daily',compact('title'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function dailyzreport(Request $request)
    {
        $input = $request->all();
        $dueDateFormat = DateTime::createFromFormat('d-m-Y', $input['date']);
        $date = $dueDateFormat->format('Y-m-d');
        $tableData = DB::select("SELECT lgp.loan_granted_id as loan_id, lgp.payment_number as payment_number, lgp.due_date as due_date, lgp.payment_date as payment_date,
       lgp.payment_amount as payment_amount, lgp.payment_amount_paid as payment_amount_paid, lgp.status as status,
       lg.client_id as client_id, lg.payments as payments, lg.updated_amount as debt,
       c.name as name, c.lastname as lastname, c.address as address
        FROM loans_granted_payments as lgp
               INNER JOIN loans_granted as lg ON lgp.loan_granted_id = lg.id
               INNER JOIN clients c on lg.client_id = c.id
        WHERE lgp.payment_date = '$date'");
        $totalAmountPaid = 0;
        foreach ($tableData as $data) {
            $totalAmountPaid += $data->payment_amount_paid;
        }

        return view('reports.dailyz-table', compact('tableData','totalAmountPaid'));
    }
}
