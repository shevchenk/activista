<?php

class GrupoCargoController extends \BaseController
{
    public function postCargar()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            $cargos = GrupoCargo::getCargar();
            return Response::json(array('rst'=>1,'datos'=>$cargos));
        }
    }
    /**
     * Store a newly created resource in storage.
     * POST /cargo/listar
     *
     * @return Response
     */
    public function postListar()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
                $cargos = GrupoCargo::getCargar();
            return Response::json(array('rst'=>1,'datos'=>$cargos));
        }
    }

    public function postCrear()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            $cargo = new GrupoCargo;
            $cargo->grupo_persona_id = Input::get('grupop');
            $cargo->cargo_estrategico_id = Input::get('cargo');
            $cargo->fecha_inicio = Input::get('fecha_inicio');
            $cargo->estado = Input::get('estado');
            $cargo->usuario_created_at = Auth::user()->id;
            $cargo->save();

            return Response::json(
                array(
                'rst'=>1,
                'msj'=>'Registro realizado correctamente',
                )
            );
        }
    }

    /**
     * Update the specified resource in storage.
     * POST /cargo/editar
     *
     * @return Response
     */
    public function postEditar()
    {
        if ( Request::ajax() ) {
            $sql="";
            $cargoId = Input::get('id');

            $cargo = GrupoCargo::find($cargoId);
            $cargo->grupo_persona_id = Input::get('grupop');
            $cargo->cargo_estrategico_id = Input::get('cargo');
            $cargo->fecha_inicio = Input::get('fecha_inicio');
            $cargo->estado = Input::get('estado');
            $cargo->usuario_updated_at = Auth::user()->id;
            $cargo->save();

            return Response::json(
                array(
                'rst'=>1,
                'msj'=>'Registro actualizado correctamente',
                )
            );
        }
    }

    /**
     * Changed the specified resource from storage.
     * POST /cargo/cambiarestado
     *
     * @return Response
     */
    public function postCambiarestado()
    {

        if ( Request::ajax() ) {
            $estado = Input::get('estado');
            $cargoId = Input::get('id');
            $cargo = GrupoCargo::find($cargoId);
            $cargo->usuario_updated_at = Auth::user()->id;
            $cargo->estado = Input::get('estado');
            $cargo->save();

            return Response::json(
                array(
                'rst'=>1,
                'msj'=>'Registro actualizado correctamente',
                )
            );    

        }
    }

}
