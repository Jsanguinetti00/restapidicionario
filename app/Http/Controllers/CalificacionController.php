<?php

namespace App\Http\Controllers;

use App\Models\calificacion;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $calificaciones = calificacion::all();
        return response()->json($calificaciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules=[
            'puntuacion' =>'required',
            'comentario'=>'required',
            'usuario_id'=>'required'
        ];
        $this->validate($request, $rules);
        $data = $request->except(['_token']);
        calificacion::create($data);
        return response()->json([
            'message'=> 'Se ha guardado la informacion correctamente'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\calificacion  $calificacion
     * @return \Illuminate\Http\Response
     */
    public function show(calificacion $calificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\calificacion  $calificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(calificacion $calificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\calificacion  $calificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, calificacion $calificacion)
    {
        //
        $rules=[
            'puntuacion' =>'required',
            'comentario'=>'required',
            'usuario_id'=>'required'
        ];
        $this->validate($request, $rules);
        
        $data = $request->except(['_token']);
        calificacion::where('usuario_id','=', $request['usuario_id'])->update($data);
        return response()->json([
            'message'=> 'Se ha guardado la informacion correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\calificacion  $calificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(calificacion $calificacion)
    {
        //
        calificacion::where('usuario_id','=', $calificacion)->destroy();
    }
}
