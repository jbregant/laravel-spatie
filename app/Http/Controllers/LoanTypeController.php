<?php

namespace App\Http\Controllers;

use App\LoanType;
use Illuminate\Http\Request;

class LoanTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:loanstype.list');
        $this->middleware('permission:loanstype.create', ['only' => ['create','store']]);
        $this->middleware('permission:loanstype.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:loanstype.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $loansType = LoanType::all();
//        dd($loansType);
        return view('loanstype.index',compact('loansType'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loansType = LoanType::pluck('name','id')->all();
        return view('loanstype.create',compact('loansType'));
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
        $loansType = LoanType::find($id);
        return view('loanstype.show',compact('loansType'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loanType = LoanType::find($id);
        return view('loanstype.edit',compact('loanType'));
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
}
