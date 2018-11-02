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

    public function getclientinfo(Request $request, $id = null)
    {
        if(!Auth::check()){
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $loansGranted = LoansGranted::where('status', 'activo')->get();

        $loansGrantedPaymens = [];

        foreach ($loansGranted as $loanGranted) {
            $loansGrantedPaymens[] = [
                'loan' => $loanGranted,
                'payments' => LoansGrantedPayments::where('loan_granted_id', '1')->where('status', 'pendiente')->get()
            ];
        }

        return response()->json($loansGrantedPaymens);
//        return view('incomes.index',compact('loansGranted'));
    }
}
