<?php

class GrupoPController extends \BaseController
{

    public function postCargar()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            $cargos = Grupo::getCargar();
            return Response::json(array('rst'=>1,'datos'=>$cargos));
        }
    }

    public function postListar()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            $cargos = Grupo::getListar();
            return Response::json(array('rst'=>1,'datos'=>$cargos));
        }
    }

    public function postCrear()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            $regex='regex:/^([a-zA-Z .,ñÑÁÉÍÓÚáéíóú]{2,60})$/i';
            $required='required';
            $reglas = array(
                'nombre' => $required.'|'.$regex.'|unique:tipo_grupos_personas',
                //'path' =>$regex.'|unique:modulos,path,',
            );

            $mensaje= array(
                'required'    => ':attribute Es requerido',
                'regex'        => ':attribute Solo debe ser Texto',
            );

            $validator = Validator::make(Input::all(), $reglas, $mensaje);

            if ( $validator->fails() ) {
                return Response::json(
                    array(
                    'rst'=>2,
                    'msj'=>$validator->messages(),
                    )
                );
            }

            $tgrupo = new Grupo;
            $tgrupo->nombre = Input::get('nombre');
            $tgrupo->tipo_grupo_id = Input::get('grupo');
            $tgrupo->estado = Input::get('estado');
            $tgrupo->usuario_created_at = Auth::user()->id;
            $tgrupo->save();

            return Response::json(
                array(
                'rst'=>1,
                'msj'=>'Registro realizado correctamente',
                )
            );
        }
    }

    public function postEditar()
    {
        if ( Request::ajax() ) {
            $regex='regex:/^([a-zA-Z .,ñÑÁÉÍÓÚáéíóú]{2,60})$/i';
            $required='required';
            $reglas = array(
                'nombre' => $required.'|'.$regex.'|unique:tipo_grupos_personas,nombre,'.Input::get('id'),
            );

            $mensaje= array(
                'required'    => ':attribute Es requerido',
                'regex'        => ':attribute Solo debe ser Texto',
            );

            $validator = Validator::make(Input::all(), $reglas, $mensaje);

            if ( $validator->fails() ) {
                return Response::json(
                    array(
                    'rst'=>2,
                    'msj'=>$validator->messages(),
                    )
                );
            }
            $cargoId = Input::get('id');

            $tgrupo = Grupo::find($cargoId);
            $tgrupo->nombre = Input::get('nombre');
            $tgrupo->tipo_grupo_id = Input::get('grupo');
            $tgrupo->estado = Input::get('estado');
            $tgrupo->usuario_updated_at = Auth::user()->id;
            $tgrupo->save();

            return Response::json(
                array(
                'rst'=>1,
                'msj'=>'Registro actualizado correctamente',
                )
            );
        }
    }

    public function postCambiarestado()
    {

        if ( Request::ajax() ) {
            $estado = Input::get('estado');
            $id = Input::get('id');
            $tgrupo = Grupo::find($id);
            $tgrupo->usuario_updated_at = Auth::user()->id;
            $tgrupo->estado = $estado;
            $tgrupo->save();

            return Response::json(
                array(
                'rst'=>1,
                'msj'=>'Registro actualizado correctamente',
                )
            );    

        }
    }

}
