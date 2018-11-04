<?php

namespace App\Http\Controllers;

use App\LoansGranted;
use App\LoansGrantedPayments;
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
        if (!$request->ajax()){
            return response(null,403);
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

        if(!Auth::check()){
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        $request = $request->request->all();

        if(!isset($request['clientId']) && empty($request['clientId'])){
            return response()->json(['status' => 'BAD', 'message' => 'Faltan datos']);
        }

        $loansGrantedObj = LoansGranted::where('status', 'activo')->where('client_id', $request['clientId'])->get();

        $loansGranted = [];
        if(!$loansGrantedObj->isEmpty()) {

            foreach ($loansGrantedObj as $loanGranted) {
                $loansGranted[] = [
                    'loan' => $loanGranted,
                    'payments' => LoansGrantedPayments::where('loan_granted_id', $loanGranted->id)->where('status', 'pendiente')->orWhere('status', 'parcial')->get()
                ];
            }
        }
//        } else {
////            return redirect()->back()->withErrors(['token' => 'This is the error message.']);
////            return response()->json(['status' => 201, 'message' => 'No se encontraron datos para el codigo de cliente']);
//            $data = '';
//        }
        return response()->json([
            'status' => 200,
            'message'=> '',
            'data' => view('incomes.table',compact('loansGranted'))->render()
        ]);
    }

    /**
     * Display update the payment.
     *
     * @return \Illuminate\Http\Response
     */

    public function dopayment(Request $request)
    {
        dd('GG');

//        if(!Auth::check()){
//            return response()->json(['error' => 'Unauthenticated.'], 401);
//        }
//        $request = $request->request->all();
//
////        if(!isset($request['clientId']) && empty($request['clientId'])){
////            return response()->json(['status' => 'BAD', 'message' => 'Faltan datos']);
////        }
//
//
//
//        $loansGrantedObj = LoansGranted::where('status', 'activo')->where('client_id', $request['clientId'])->get();
//
//        $loansGranted = [];
//        if(!$loansGrantedObj->isEmpty()) {
//
//            foreach ($loansGrantedObj as $loanGranted) {
//                $loansGranted[] = [
//                    'loan' => $loanGranted,
//                    'payments' => LoansGrantedPayments::where('loan_granted_id', $loanGranted->id)->where('status', 'pendiente')->orWhere('status', 'parcial')->get()
//                ];
//            }
//        }
////        } else {
//////            return redirect()->back()->withErrors(['token' => 'This is the error message.']);
//////            return response()->json(['status' => 201, 'message' => 'No se encontraron datos para el codigo de cliente']);
////            $data = '';
////        }
//        return response()->json([
//            'status' => 200,
//            'message'=> '',
//            'data' => view('incomes.table',compact('loansGranted'))->render()
//        ]);
    }
}
