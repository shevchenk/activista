<?php

class CargoEstrategicoController extends \BaseController
{
    public function postCargar()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            $cargos = CargoEstrategico::get(Input::all());
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
                $cargos = DB::table('cargos_estrategicos')
                            ->select('id', 'nombre')
                            ->where('estado', '=', '1')
                            ->orderBy('nombre')
                            ->get();
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
                'nombre' => $required.'|'.$regex.'|unique:cargos_estrategicos',
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

            $cargo = new CargoEstrategico;
            $cargo->nombre = Input::get('nombre');
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
            $regex='regex:/^([a-zA-Z .,ñÑÁÉÍÓÚáéíóú]{2,60})$/i';
            $required='required';
            $reglas = array(
                'nombre' => $required.'|'.$regex.'|unique:cargos_estrategicos,nombre,'.Input::get('id'),
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

            $cargos = CargoEstrategico::find($cargoId);
            $cargos->nombre = Input::get('nombre');
            $cargos->estado = Input::get('estado');
            $cargos->usuario_updated_at = Auth::user()->id;
            $cargos->save();

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
            $cargo = CargoEstrategico::find($cargoId);
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
