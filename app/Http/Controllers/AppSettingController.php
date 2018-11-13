<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:setting.list');
        $this->middleware('permission:setting.create', ['only' => ['create','store']]);
        $this->middleware('permission:setting.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:setting.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $settings = Setting::get();
//        $cities = City::orderBy('id','ASC');
        return view('settings.index',compact('settings'));
//            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $settings = Setting::pluck('name','name')->all();
        return view('settings.create',compact('settings'));
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
            'value' => 'required',
            'description' => 'required',
        ],
            [
                'name.required' => 'Nombre es un campo obligatorio',
                'value.required' => 'Valor es un campo obligatorio',
                'description.required' => 'Descripcion es un campo obligatorio',
            ]
        );

        $input = $request->all();

        $setting = Setting::create($input);

        return redirect()->route('settings.index')
            ->with('success','Configuracion creada correctamente');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $setting = Setting::find($id);
        return view('settings.show',compact('setting'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting = Setting::find($id);
        return view('settings.edit',compact('setting'));
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

        $zone = Setting::find($id);
        $zone->update($input);

        return redirect()->route('settings.index')
            ->with('success','Configuracion actualizada correctamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Setting::find($id)->delete();
        return redirect()->route('settings.index')
            ->with('success','Configuracion borrada correctamente');
    }
}
