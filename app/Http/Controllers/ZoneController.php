<?php

namespace App\Http\Controllers;

use App\Zone;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:zone.list');
        $this->middleware('permission:zone.create', ['only' => ['create','store']]);
        $this->middleware('permission:zone.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:zone.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $zones = Zone::orderBy('id','ASC')->paginate(10);
        return view('zones.index',compact('zones'));
//            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zones = Zone::pluck('name','name')->all();
        return view('zones.create',compact('zones'));
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

        $zone = Zone::create($input);

        return redirect()->route('zones.index')
            ->with('success','Zona creada correctamente');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $zone = Zone::find($id);
        return view('zones.show',compact('zone'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zone = Zone::find($id);
        return view('zones.edit',compact('zone'));
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

        $zone = Zone::find($id);
        $zone->update($input);

        return redirect()->route('zones.index')
            ->with('success','Zona actualizada correctamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Zone::find($id)->delete();
        return redirect()->route('zones.index')
            ->with('success','Zona borrada correctamente');
    }
}
