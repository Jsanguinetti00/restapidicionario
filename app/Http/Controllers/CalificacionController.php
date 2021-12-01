<?php

namespace App\Http\Controllers;

use App\Models\calificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
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
        $usuarios = User::all();
        if($usuarios->count()>0){
            foreach($usuarios as $usuario){
                $usuario['dataOpinion'] = DB::table('calificaciones')
                ->join('users','users.id','=','calificaciones.usuario_id')
                ->select('calificaciones.*')
                ->get();
            }
            if($usuario->dataOpinion->count()>0){
                return response()->json($usuarios);
            }else{
                return response()->json(null,404);
            }
            
        }else{
            return response()->json(null,404);
        }
        // if($usuarios->count()>0){
        //     foreach($usuarios as $usuario){
        //         $usuario->calificaciones = DB::table('calificaciones')
        //         ->join('users','users.id','=','calificaciones.usuario_id')
        //         ->select('calificaciones.*')
        //         ->get();
        //     }
            
        //     return response()->json($usuarios);
            
            
        // }else{
        //     return response()->json(null,404);
        // }
        
        
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
        
        $request = calificacion::create([
            'puntuacion'=> $request->puntuacion,
            'comentario'=> $request->comentario,
            'usuario_id'=> $request->usuario_id,
        ]);
        return response()->json($request,201);
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
