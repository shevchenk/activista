<?php

class TipoGrupoPersonaController extends \BaseController
{
    public function postListar()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            $estado = Input::get('estado');
            $r = DB::table('tipo_grupos_personas')
                    ->select(
                        'nombre','id'
                    )
                    ->where('estado', '=', 1)
                    ->orderBy('nombre')
                    ->get();
            
            return Response::json(array('rst'=>1,'datos'=>$r));
        }
    }

    public function postListargrupo(){
        if ( Request::ajax() ) {
            $estado = Input::get('estado');
            $r = DB::table('grupos_personas')
                    ->select(
                        'nombre','id'
                    )
                    ->where('estado', '=', 1)
                    ->orderBy('nombre')
                    ->get();
            return Response::json(array('rst'=>1,'datos'=>$r));
        }
    }
}
