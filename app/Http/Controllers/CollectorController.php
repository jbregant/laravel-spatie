<?php

namespace App\Http\Controllers;

use App\Collector;
use App\Zone;
use Illuminate\Http\Request;

class CollectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:collector.list');
        $this->middleware('permission:collector.create', ['only' => ['create','store']]);
        $this->middleware('permission:collector.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:collector.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $collectors = Collector::orderBy('id','ASC')->paginate(10);
        return view('collectors.index',compact('collectors'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zones = Zone::pluck('name','id')->all();
        return view('collectors.create',compact('zones'));
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
            'phone' => 'required',
            'zone_id' => 'required',
        ],
            [
                'name.required' => 'Nombre es un campo obligatorio',
                'phone.required' => 'Telefono es un campo obligatorio',
                'zone_id.required' => 'Zona es un campo obligatorio',
            ]
        );

        $input = $request->all();

        $collector = Collector::create($input);

        return redirect()->route('collectors.index')
            ->with('success','Cobrador creado correctamente');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $collector = Collector::find($id);
        return view('collectors.show',compact('collector'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zones = Zone::pluck('name','id')->all();
        $collector = Collector::find($id);
        $zoneId = $collector->zone->id;
        return view('collectors.edit',compact('collector', 'zones', 'zoneId'));
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
            'phone' => 'required',
            'zone_id' => 'required',
        ],
            [
                'name.required' => 'Nombre es un campo obligatorio',
                'phone.required' => 'Telefono es un campo obligatorio',
                'zone_id.required' => 'Zona es un campo obligatorio',
            ]
        );

        $input = $request->all();

        $collector = Collector::find($id);
        $collector->update($input);

        return redirect()->route('collectors.index')
            ->with('success','Cobrador actualizado correctamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Collector::find($id)->delete();
        return redirect()->route('collectors.index')
            ->with('success','Cobrador borrado correctamente');
    }
}
