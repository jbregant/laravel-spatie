<?php

namespace App\Http\Controllers;

use App\LoansGranted;
use App\LoansGrantedPayments;
use App\LoansGrantedPaymentsPartials;
use App\LoanType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    /**
     * Show the application dashboard.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function feecheck(Request $request, $id)
    {
        if (!$request->ajax()) {
            return response(null, 403);
        }

        $loanType = LoanType::find($id);
        return response()->json($loanType);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getclientinfo(Request $request)
    {

        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        $request = $request->request->all();

        if (!isset($request['clientId']) && empty($request['clientId'])) {
            return response()->json(['status' => 'BAD', 'message' => 'Faltan datos']);
        }

        $loansGranted = LoansGranted::where('status', 'activo')->where('client_id', $request['clientId'])->get();
//        $loansGranted = [];
//        if (!$loansGrantedObj->isEmpty()) {
//            foreach ($loansGrantedObj as $key => $loanGranted) {
//                $loansGranted[] = [
//                    'loan' => $loanGranted,
//                    'payments' => LoansGrantedPayments::where('loan_granted_id', $loanGranted->id)->where('status', '!=', 'completo')->get()
//                ];
//            }
//        }
//        } else {
////            return redirect()->back()->withErrors(['token' => 'This is the error message.']);
////            return response()->json(['status' => 201, 'message' => 'No se encontraron datos para el codigo de cliente']);
//            $data = '';
//        }
        return response()->json([
            'status' => 200,
            'message' => '',
            'data' => view('incomes.table', compact('loansGranted'))->render()
        ]);
    }

    /**
     * update a payment.
     *
     * @return \Illuminate\Http\Response
     */

    public function dopayment(Request $request)
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $httpCode = 200;
        $request = $request->request->all();

        $paymentDateAux = strtotime($request['paymentDate']);
        $paymentDate = date('Y-m-d',$paymentDateAux);

        //        if(!isset($request['clientId']) && empty($request['clientId'])){
//            return response()->json(['status' => 'BAD', 'message' => 'Faltan datos']);
//        }
        //busco el pago
//        $payment = LoansGrantedPayments::find($request['paymentId']);
        $loanGranted = LoansGranted::find($request['loanGrantedId']);
        $paymentAmount = $request['paymentAmountPaid'];

        $message = '';
        if($loanGranted){
            //grabo el pago
            $payment = new LoansGrantedPayments();
            $payment->loan_granted_id = $request['loanGrantedId'];
            $payment->payment_amount = $request['paymentAmountPaid'];
            $payment->payment_date = $paymentDate;
            //descuento del total
            $loanGranted->updated_amount = $loanGranted->updated_amount - $request['paymentAmountPaid'];
            //si se completo el credito lo marco como completado para que no aparezca en el listado de creditos
            if($loanGranted->updated_amount <= 0){
                $loanGranted->status = "completo";
            }

        } else {
            //error
            $httpCode = 500;
            $message = 'Credito no encontrado';
        }
        if ($payment->status == 'pendiente') { //check if payment amount is partial or total
            if ($paymentAmount < $payment->payment_amount) { // partial payment
                //new partial payment
                $message = $this->partialPayment($payment, $paymentAmount, $paymentDate, $loanGranted);
            } else { // normal payment
                $message = $this->normalPayment($request, $payment, $paymentDate, $loanGranted);
            }
        } elseif ($payment->status == 'parcial') {
            //obtener los parciales, sumarlos y ver si completa la cuota
            $paymentPartial = LoansGrantedPaymentsPartials::where(['loan_granted_payments_id' => $payment->id])->get();
            $paymentPartialSum = LoansGrantedPaymentsPartials::where(['loan_granted_payments_id' => $payment->id])->where('status', 'activo')->sum('payment_amount_paid');
            $paymentPartialUpdated = $paymentPartialSum + $paymentAmount;

            if ($paymentPartialUpdated < $payment->payment_amount) {//update - generate a new partial
                //new partial payment
                $message = $this->partialPayment($payment, $paymentAmount, $paymentDate, $loanGranted, $paymentPartialUpdated);
            } else {
                $message = $this->normalPayment($request, $payment, $paymentDate, $loanGranted);
                foreach ($paymentPartial as $item) {
                    $item->status = 'completo';
                    $item->save();
                }
            }
        } else {
            //error
            $httpCode = 500;
        }
        return response()->json([
            'status' => $httpCode,
            'message' => $message,
        ]);
    }

    /**
     * @param $payment
     * @param $paymentAmount
     * @param $paymentDate
     * @param $loanGranted
     * @param $paymentPartialUpdated
     * @return string
     */
    private function partialPayment($payment, $paymentAmount, $paymentDate,  $loanGranted, $paymentPartialUpdated = null): string
    {
        $today = new \DateTime();
        $paymentPartial = new LoansGrantedPaymentsPartials();
        $paymentPartial->loan_granted_id = $loanGranted->id;
        $paymentPartial->loan_granted_payments_id = $payment->id;
        $paymentPartial->payment_amount_paid = $paymentAmount;
        $paymentPartial->payment_date = $paymentDate;
        $paymentPartial->save();
        //set payment to partial - update the payment_amount_paid
        $payment->payment_amount_paid = ($paymentPartialUpdated) ? $paymentPartialUpdated : $paymentAmount;
//        $payment->payment_date = $today->format('Y-m-d');
        $payment->status = 'parcial';
        $payment->save();
        $loanGranted->updated_amount = $loanGranted->updated_amount - $paymentAmount;
        $loanGranted->save();
        $message = 'Pago parcial realizado correctamente.';
        return $message;
    }

    /**
     * @param $request
     * @param $payment
     * @param $paymentDate
     * @param $loanGranted
     * @return string
     */
    private function normalPayment($request, $payment, $paymentDate, $loanGranted): string
    {
        //update the payment and the loan debt
//        $today = new \DateTime();
        $payment->payment_amount_paid = $request['paymentAmountPaid'];
        $payment->payment_date = $paymentDate;
        $payment->status = "completo";
        $loanGranted->updated_amount = $loanGranted->updated_amount - $payment->payment_amount_paid;

        //si es la ultima cuota marco el credito como completado
        if ($payment->payment_number == $loanGranted->payments) {
            $loanGranted->status = 'completo';
        }
        $loanGranted->save();
        $payment->save();
        $message = 'Pago realizado correctamente.';
        return $message;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function loanPrinter(Request $request)
    {
        $input = $request->all();
        $loanGranted = LoansGranted::find($input['id']);
        $loanGrantedPayments = LoansGrantedPayments::where('loan_granted_id', $input['id'])->get();
        return view('loans.table-print', compact('loanGranted', 'loanGrantedPayments'));
    }
}
