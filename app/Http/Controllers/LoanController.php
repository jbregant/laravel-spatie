<?php

namespace App\Http\Controllers;

use App\Client;
use App\LoanType;
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
        $this->middleware('permission:loan.create', ['only' => ['create','store']]);
        $this->middleware('permission:loan.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:loan.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $clients = Client::orderBy('id','ASC')->paginate(10);
//        $clients = Client::pluck('name','id')->all();
        $clientAux = DB::table('clients')->select('id', 'name', 'lastname')->get();

        $clients = [];
        foreach ($clientAux as $client) {
            $clients[$client->id] = $client->id.' - '. $client->name . ' ' . $client->lastname;
        }
        $loansType = LoanType::pluck('name','id')->all();
        return view('loans.index',compact('clients', 'loansType'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::pluck('name','id')->all();
        return view('clients.create',compact('cities'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'city_id' => 'required',
        ],
            [
                'name.required' => 'Nombre es un campo obligatorio',
                'lastname.required' => 'Apellido es un campo obligatorio',
                'address.required' => 'Direccion es un campo obligatorio',
                'city_id.required' => 'Localidad es un campo obligatorio',
            ]
        );

        $input = $request->all();

        $client = Client::create($input);

        return redirect()->route('clients.index')
            ->with('success','Cliente creado correctamente');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        return view('clients.show',compact('client'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = City::pluck('name','id')->all();
        $client = Client::find($id);
        $cityId = $client->city->id;
        return view('clients.edit',compact('client', 'cities', 'cityId'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'city_id' => 'required',
        ],
            [
                'name.required' => 'Nombre es un campo obligatorio',
                'lastname.required' => 'Nombre es un campo obligatorio',
                'address.required' => 'Direccion es un campo obligatorio',
                'city_id.required' => 'Localidad es un campo obligatorio',
            ]
        );

        $input = $request->all();

        $client = Client::find($id);
        $client->update($input);

        return redirect()->route('clients.index')
            ->with('success','Cliente actualizado correctamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::find($id)->delete();
        return redirect()->route('clients.index')
            ->with('success','Cliente borrado correctamente');
    }

    /**
     * Return the fee rate for the selected loan type
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function feecheck($id)
    {
        dd('GG');
//        Client::find($id)->delete();
//        return redirect()->route('clients.index')
//            ->with('success','Cliente borrado correctamente');
    }
}
