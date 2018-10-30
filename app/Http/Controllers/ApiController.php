<?php

namespace App\Http\Controllers;

use App\LoanType;
use Illuminate\Http\Request;

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
}
