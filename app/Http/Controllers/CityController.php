<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:city.list');
        $this->middleware('permission:city.create', ['only' => ['create','store']]);
        $this->middleware('permission:city.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:city.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cities = City::get();
//        $cities = City::orderBy('id','ASC');
        return view('cities.index',compact('cities'));
//            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::pluck('name','name')->all();
        return view('cities.create',compact('cities'));
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
        ],
            [
                'name.required' => 'Nombre es un campo obligatorio',
            ]
        );

        $input = $request->all();

        $city = City::create($input);

        return redirect()->route('cities.index')
            ->with('success','Localidad creada correctamente');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::find($id);
        return view('cities.show',compact('city'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);
        return view('cities.edit',compact('city'));
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
        ],
            [
                'name.required' => 'Nombre es un campo obligatorio'
            ]
        );

        $input = $request->all();

        $zone = City::find($id);
        $zone->update($input);

        return redirect()->route('cities.index')
            ->with('success','Localidad actualizada correctamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        City::find($id)->delete();
        return redirect()->route('cities.index')
            ->with('success','Localidad borrada correctamente');
    }
}
