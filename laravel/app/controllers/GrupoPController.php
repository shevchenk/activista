<?php

class GrupoPController extends \BaseController
{
    public function postCargarpe() // Persona Equipo
    {
        if ( Request::ajax() ) {
            $array=array();
            $array['where']='';$array['usuario']=Auth::user()->id;
            $array['limit']='';$array['order']='';$array['escalafon']='';
            $array['group']='';

            if( Input::has("paterno") ){
                $array['where'].=" AND a.paterno LIKE '%".Input::get("paterno")."%' ";
            }

            if( Input::has("materno") ){
                $array['where'].=" AND a.materno LIKE '%".Input::get("materno")."%' ";
            }

            if( Input::has("nombres") ){
                $array['where'].=" AND a.nombres LIKE '%".Input::get("nombres")."%' ";
            }

            if( Input::has("dni") ){
                $array['where'].=" AND a.dni LIKE '%".Input::get("dni")."%' ";
            }

            if( Input::has("celular") ){
                $array['where'].=" AND a.celular LIKE '%".Input::get("celular")."%' ";
            }

            if( Input::has("cargo") ){
                $array['where'].=" AND ce.nombre LIKE '%".Input::get("cargo")."%' ";
            }

            if( Input::has("fecha_inicio") ){
                $array['where'].=" AND e.fecha_inicio='".Input::get("fecha_inicio")."' ";
            }

            if( Input::has("equipo") ){
                $array['where'].=" AND gp.nombre LIKE '%".Input::get("equipo")."%' ";
            }

            if( Input::has("departamento") ){
                $array['where'].=" AND d.nombre LIKE '%".Input::get("departamento")."%' ";
            }

            if( Input::has("provincia") ){
                $array['where'].=" AND p.nombre LIKE '%".Input::get("provincia")."%' ";
            }

            if( Input::has("distrito") ){
                $array['where'].=" AND di.nombre LIKE '%".Input::get("distrito")."%' ";
            }

            if( Input::has("localidad") ){
                $array['where'].=" AND gp.localidad LIKE '%".Input::get("localidad")."%' ";
            }

            if( Input::has("escalafon") ){
                $array['escalafon'].=" INNER JOIN escalafon_fichas ef ON ef.escalafon_id=e.id AND ef.estado=1 ";
            }

            if (Input::has('draw')) {
                if (Input::has('order')) {
                    $inorder=Input::get('order');
                    $incolumns=Input::get('columns');
                    $array['order']=  ' ORDER BY '.
                                      $incolumns[ $inorder[0]['column'] ]['name'].' '.
                                      $inorder[0]['dir'];
                }

                $array['limit']=' LIMIT '.Input::get('start').','.Input::get('length');
                $retorno["draw"]=Input::get('draw');
            }

            $array['where'].=" AND c.visible=1 ";

            $array['order']=" ORDER BY a.paterno,a.materno,a.nombres,ce.nombre ";

            $cant  = Grupo::getCargarPECount( $array );
            $aData = Grupo::getCargarPE( $array );

            $aParametro['rst'] = 1;
            $aParametro["recordsTotal"]=$cant;
            $aParametro["recordsFiltered"]=$cant;
            $aParametro['data'] = $aData;
            $aParametro['msj'] = "No hay registros aún";
            return Response::json($aParametro);
        }
    }

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
                'nombre' => $required.'|unique:tipo_grupos_personas',
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
                'nombre' => $required.'|unique:tipo_grupos_personas,nombre,'.Input::get('id'),
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
