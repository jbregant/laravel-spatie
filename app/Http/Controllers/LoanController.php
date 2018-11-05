<?php

namespace App\Http\Controllers;

use App\Client;
use App\LoansGranted;
use App\LoansGrantedPayments;
use App\LoanType;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:loan.list');
        $this->middleware('permission:loan.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:loan.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:loan.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $loansGranted = LoansGranted::where('status', 'activo')->get();
        return view('loans.index', compact('loansGranted'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientAux = DB::table('clients')->select('id', 'name', 'lastname')->get();

        $clients = [];
        foreach ($clientAux as $client) {
            $clients[$client->id] = $client->id . ' - ' . $client->name . ' ' . $client->lastname;
        }
        $loansType = LoanType::pluck('name', 'id')->all();
        $loansGranted = LoansGranted::all();
        return view('loans.create', compact('clients', 'loansType', 'loansGranted'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'client_id' => 'required',
            'loan_type_id' => 'required',
            'loan_fee' => 'required',
            'payments' => 'required',
            'payment_amount' => 'required',
            'total_amount' => 'required',
            'due_dates' => 'required',
        ],
            [
                'client_id.required' => 'Cliente es un campo obligatorio',
                'loan_type_id.required' => 'Tipo de Credito es un campo obligatorio',
                'loan_fee.required' => 'Interes es un campo obligatorio',
                'payments.required' => 'Cantidad de Cuotas es un campo obligatorio',
                'payment_amount.required' => 'El Valor de las Cuotas es un campo obligatorio',
                'total_amount.required' => 'Monto del credito es un campo obligatorio',
                'dueDates.required' => 'Fechas de vencimiento es un campo obligatorio',
            ]
        );

        $input = $request->all();

        //set the new loan
        $loanGranted = LoansGranted::create($input);
        $loanGranted->updated_amount = $loanGranted->total_amount;
        $loanGranted->save();

        //set the payments
        $dueDates = explode(',', $input['due_dates']);
        $paymentNumber = 1;
        for ($i = 0; $i < count($dueDates); $i++) {
            $dueDateFormat = DateTime::createFromFormat('d-m-Y', $dueDates[$i]);
            $dueDate = $dueDateFormat->format('Y-m-d');
            $data = [
                'loan_granted_id' => $loanGranted->id,
                'payment_number' => $paymentNumber,
                'payment_amount' => $input['payment_amount'],
                'due_date' => $dueDate,
                'status' => 'pendiente'
            ];
            LoansGrantedPayments::create($data);
            $paymentNumber += 1;
        }

        return redirect()->route('loans.index')
            ->with('success', 'Credito creado correctamente');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loanGranted = LoansGranted::find($id);
        $loanGrantedPayments = LoansGrantedPayments::where('loan_granted_id', $id)->get();
//        dd($loanGrantedPayments);
        return view('loans.show', compact('loanGranted', 'loanGrantedPayments'));
    }


//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        $cities = City::pluck('name','id')->all();
//        $client = Client::find($id);
//        $cityId = $client->city->id;
//        return view('clients.edit',compact('client', 'cities', 'cityId'));
//    }


//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, $id)
//    {
//        $this->validate($request, [
//            'name' => 'required',
//            'lastname' => 'required',
//            'address' => 'required',
//            'city_id' => 'required',
//        ],
//            [
//                'name.required' => 'Nombre es un campo obligatorio',
//                'lastname.required' => 'Nombre es un campo obligatorio',
//                'address.required' => 'Direccion es un campo obligatorio',
//                'city_id.required' => 'Localidad es un campo obligatorio',
//            ]
//        );
//
//        $input = $request->all();
//
//        $client = Client::find($id);
//        $client->update($input);
//
//        return redirect()->route('clients.index')
//            ->with('success','Cliente actualizado correctamente');
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LoansGrantedPayments::where('loan_granted_id', $id)->delete();
        LoansGranted::find($id)->delete();

        return redirect()->route('loans.index')
            ->with('success', 'Credito borrado correctamente');
    }
}
