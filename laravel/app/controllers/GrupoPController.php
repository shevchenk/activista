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

    public function postListargrupoe()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            $cargos = Grupo::getListarGrupoEscalafon();
            return Response::json(array('rst'=>1,'datos'=>$cargos));
        }
    }

    public function postListarcargoe()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            $array['grupo_persona_id']=Input::get('grupo_persona_id');
            $cargos = Grupo::getListarCargoEscalafon($array);
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

            $tpgrupo= TipoGrupoPersona::find(Input::get('grupo'));

            $tgrupo = new Grupo;
            $tgrupo->nombre = Input::get('nombre');
            $tgrupo->tipo_grupo_id = Input::get('grupo');
            if( $tpgrupo->ubigeo=='1' ){
                $tgrupo->departamento_id = Input::get('region');
                $tgrupo->provincia_id = Input::get('provincia');
                $tgrupo->distrito_id = Input::get('distrito');
                $tgrupo->localidad = Input::get('localidad');
                $tgrupo->direccion = Input::get('direccion');
                $tgrupo->telefono = Input::get('telefono');
            }
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

            $tpgrupo= TipoGrupoPersona::find(Input::get('grupo'));

            $tgrupo = Grupo::find($cargoId);
            $tgrupo->nombre = Input::get('nombre');
            $tgrupo->tipo_grupo_id = Input::get('grupo');
            if( $tpgrupo->ubigeo=='0' ){
                $tgrupo->departamento_id = NULL;
                $tgrupo->provincia_id = NULL;
                $tgrupo->distrito_id = NULL;
                $tgrupo->localidad = NULL;
            }
            else{
                $tgrupo->departamento_id = Input::get('region');
                $tgrupo->provincia_id = Input::get('provincia');
                $tgrupo->distrito_id = Input::get('distrito');
                $tgrupo->localidad = Input::get('localidad');
                $tgrupo->direccion = Input::get('direccion');
                $tgrupo->telefono = Input::get('telefono');
            }
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
