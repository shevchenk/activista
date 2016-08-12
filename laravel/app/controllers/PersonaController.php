<?php

class PersonaController extends BaseController
{

    public function postEditmultiple()
    {
        set_time_limit(3000);
        ini_set('memory_limit','512M');
        if ( Request::ajax() ) {
            $regex='regex:/^([a-zA-Z .,ñÑÁÉÍÓÚáéíóú]{2,60})$/i';
            $required='required';

            $mensaje= array(
                'required'    => ':attribute Es requerido',
                'regex'        => ':attribute Solo debe ser Texto',
            );

            $error=false;
            $mensajes=array();
            $personas=Input::get('persona');
            $personaError=0;

            DB::beginTransaction();
            for($i=0;$i<count($personas);$i++){
                $reglas = array(
                'email' => 'email|unique:activistas,email,'.$personas[$i],
                'celular' => 'numeric',
                );

                $datos=array(
                    'email'=> Input::get('email_'.$personas[$i]),
                    'celular'=>Input::get('celular_'.$personas[$i])
                );

                $validator = Validator::make($datos, $reglas, $mensaje);

                if ( $validator->fails() ) {
                    $error=true;
                    $mensajes=$validator->messages();
                    $personaError=$personas[$i];
                    break;
                }

                $activista = Usuario::find($personas[$i]);
                $activista->celular = Input::get('celular_'.$personas[$i]);
                $activista->email = Input::get('email_'.$personas[$i]);
                $activista->save();
            }

            if($error){
                DB::rollback();
                return Response::json(
                    array(
                    'rst'=>2,
                    'msj'=>$mensajes,
                    'personaError'=>$personaError
                    )
                );
            }

            DB::commit();
            return Response::json(
                array(
                'rst'=>1,
                'msj'=>'Registro actualizado correctamente',
                )
            );
        }
    }

    public function postNivel()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            
            if (Input::has('estado')) {
                $nivel = Input::get('nivel_id');
                $r = DB::table('activistas')
                        ->select(
                            DB::raw('CONCAT(paterno," ",materno,", ",nombres) as nombre'),
                            'id'
                        )
                        ->where('estado', '=', 1)
                        ->where('nivel_id','=',$nivel)
                        ->orderBy('paterno')
                        ->orderBy('materno')
                        ->orderBy('nombre')
                        ->get();
            } 
            
            return Response::json(array('rst'=>1,'datos'=>$r));
        }
    }
    /**
     * cargar personas
     * POST /persona/cargar
     *
     * @return Response
     */
    public function postCargar()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            $array=array();
            $array['where']='';$array['usuario']=Auth::user()->id;
            $array['limit']='';$array['order']='';

            if( Input::has('nivel') ){
                $array['where'].=" AND c2.nombre LIKE '%".Input::get('nivel')."%' ";
            }

            if( Input::has("nombres") ){
                $array['where'].=" AND a.nombres LIKE '%".Input::get("nombres")."%' ";
            }

            if( Input::has("paterno") ){
                $array['where'].=" AND a.paterno LIKE '%".Input::get("paterno")."%' ";
            }

            if( Input::has("materno") ){
                $array['where'].=" AND a.materno LIKE '%".Input::get("materno")."%' ";
            }

            if( Input::has("dni") ){
                $array['where'].=" AND a.dni LIKE '%".Input::get("dni")."%' ";
            }

            if( Input::has("email") ){
                $array['where'].=" AND a.email LIKE '%".Input::get("email")."%' ";
            }

            if( Input::has("estado") ){
                $array['where'].=" AND a.estado='".Input::get("estado")."' ";
            }

            if( Input::has("cargo_id") ){
                $array['where'].=" AND c.id='".Input::get("cargo_id")."' ";
            }

            $array['where'].=" AND c.visible=1 ";

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

            $cant  = Persona::getCargarCount( $array );
            $aData = Persona::getCargar( $array );

            $aParametro['rst'] = 1;
            $aParametro["recordsTotal"]=$cant;
            $aParametro["recordsFiltered"]=$cant;
            $aParametro['data'] = $aData;
            $aParametro['msj'] = "No hay personas aún";
            return Response::json($aParametro);
        }
    }
    /**
     * cargar personas, mantenimiento
     * POST /persona/listar
     *
     * @return Response
     */
    public function postListar()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            $personas = Persona::getCargoSede();
            return Response::json(array('rst'=>1,'datos'=>$personas));
        }
    }

    public function postCargarsedes()
    {
        $personaId = Input::get('persona_id');
        $sedes = Persona::getSedes($personaId);
        return Response::json(array('rst'=>1,'datos'=>$sedes));
    }
    /**
     * Store a newly created resource in storage.
     * POST /persona/crear
     *
     * @return Response
     */
    public function postCrear()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            $regex='regex:/^([a-zA-Z .,ñÑÁÉÍÓÚáéíóú]{2,60})$/i';
            $required='required';
            $reglas = array(
                'nombres' => $required.'|'.$regex,
                'paterno' => $required.'|'.$regex,
                'materno' => $required.'|'.$regex,
                'email' => 'required|email|unique:activistas,email',
                //'password'      => 'required|min:6',
                'dni'      => 'required|min:8|unique:activistas,dni',
            );

            $mensaje= array(
                'required'    => ':attribute Es requerido',
                'regex'        => ':attribute Solo debe ser Texto',
                'exists'       => ':attribute ya existe',
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
            
            DB::beginTransaction();
            $activista = new Persona;
            $activista->paterno = Input::get('paterno');
            $activista->materno = Input::get('materno');
            $activista->nombres = Input::get('nombres');
            $activista->email = Input::get('email');
            $activista->dni = Input::get('dni');
            $activista->sexo = Input::get('sexo');
            $activista->fecha_ingreso = date("Y-m-d");
            $activista->password =  Hash::make(Input::get('dni'));
            $activista->nivel_id = Input::get('cargos');
            if( Input::has('grupo') ){
                $activista->grupo_persona_id = Input::get('grupo')[0];
            }
            $activista->usuario_created_at = Auth::user()->id;
            $activista->save();

            $activistaCargo = new ActivistaCargo;
            $activistaCargo->activista_id=$activista->id;
            $activistaCargo->cargo_id= Input::get('cargos');
            $activistaCargo->usuario_created_at= $activista->id;
            $activistaCargo->save();

            $escalafonId=Input::get('escalafon_id');
            $cargo=Input::get('cargo');
            $grupo=Input::get('grupo');
            $fechaInicio=Input::get('fecha_inicio');
            $documentoInicio=Input::get('documento_inicio');
            for ($i=0; $i<count($escalafonId) ; $i++) { 
                $escalafon=new Escalafon;
                $escalafon->activista_id=$activista->id;
                $escalafon->usuario_created_at=Auth::user()->id;
                $escalafon->cargo_estrategico_id=$cargo[$i];
                $escalafon->grupo_persona_id=$grupo[$i];
                $escalafon->fecha_inicio=$fechaInicio[$i];
                $escalafon->documento_inicio=$documentoInicio[$i];
                $escalafon->estado=1;
                $escalafon->save();
            }

            DB::commit();

            /*$parametros=array(
                            'email'      => Input::get('email'),
                            'persona'   => $activista->paterno." ".$activista->materno.", ".$activista->nombres,
                        );

            try{
                Mail::send('emails', $parametros , 
                    function($message) {
                    $message
                        ->to(Input::get('email'))
                        ->subject('.::Bienvenido PPKausa::.');
                    }
                );
            }
            catch(Exception $e){
                //echo $qem[$k]->email."<br>";
            }*/

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
     * POST /persona/editar
     *
     * @return Response
     */
    public function postEditar()
    {
        if ( Request::ajax() ) {
            $regex='regex:/^([a-zA-Z .,ñÑÁÉÍÓÚáéíóú]{2,60})$/i';
            $required='required';
            $reglas = array(
                'nombres' => $required.'|'.$regex,
                'paterno' => $required.'|'.$regex,
                'materno' => $required.'|'.$regex,
                'email' => 'required|email|unique:activistas,email,'.Input::get('id'),
                'dni'      => 'required|min:8|unique:activistas,dni,'.Input::get('id'),
                //'password'      => 'required|min:6',
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
            $personaId = Input::get('id');

            $activista = Usuario::find($personaId);
            $activista->paterno = Input::get('paterno');
            $activista->materno = Input::get('materno');
            $activista->nombres = Input::get('nombres');
            $activista->email = Input::get('email');
            $activista->sexo = Input::get('sexo');
            $activista->dni = Input::get('dni');
            $activista->fecha_ingreso = date("Y-m-d");
            $activista->fecha_nacimiento = Input::get('fecha_nac');
            $activista->estado = Input::get('estado');
            if (Input::get('password')<>'') 
                $activista->password =  Hash::make(Input::get('password'));
            $activista->nivel_id = Input::get('cargos');
            if( Input::has('grupo') ){
                $activista->grupo_persona_id = Input::get('grupo');
            }
            $activista->usuario_updated_at = Auth::user()->id;
            $activista->save();

            if( ActivistaCargo::where('activista_id',$personaId)
                              ->where('estado','1')
                              ->where('cargo_id',Input::get('cargos'))
                              ->count()<1 
            ){
                DB::table('activista_cargo')
                ->where('activista_id', $personaId)
                ->update(array('estado' => 0,
                                'usuario_updated_at'=>Auth::user()->id
                        )
                );

                $activistaCargo = new ActivistaCargo;
                $activistaCargo->activista_id=$activista->id;
                $activistaCargo->cargo_id= Input::get('cargos');
                $activistaCargo->usuario_created_at= $activista->id;
                $activistaCargo->save();
            }


            /*$parametros=array(
                            'email'      => Input::get('email'),
                            'persona'   => $activista->paterno." ".$activista->materno.", ".$activista->nombres,
                        );

            try{
                Mail::send('emails', $parametros , 
                    function($message) {
                    $message
                        ->to(Input::get('email'))
                        ->subject('.::Bienvenido PPKausa::.');
                    }
                );
            }
            catch(Exception $e){
                //echo $qem[$k]->email."<br>";
            }*/


            
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
     * POST /persona/cambiarestado
     *
     * @return Response
     */
    public function postCambiarestado()
    {

        if ( Request::ajax() ) {
            $persona = Persona::find(Input::get('id'));
            $persona->estado = Input::get('estado');
            $persona->usuario_updated_at = Auth::user()->id;
            $persona->save();

            return Response::json(
                array(
                'rst'=>1,
                'msj'=>'Registro actualizado correctamente',
                )
            );    

        }
    }

    public function postEscalafon()
    {
        if ( Request::ajax() ) {
            $personaId = Input::get('id');

                DB::table('escalafon')
                ->where('activista_id', $personaId)
                ->where('estado', 1)
                ->update(array('estado' => 0,
                                'usuario_updated_at'=>Auth::user()->id
                        )
                );

                $escalafonId=Input::get('escalafon_id');
                $cargo=Input::get('cargo');
                $grupo=Input::get('grupo');
                $fechaInicio=Input::get('fecha_inicio');
                $fechaFinal=Input::get('fecha_final');
                $documentoInicio=Input::get('documento_inicio');
                $documentoFinal=Input::get('documento_final');
                for ($i=0; $i<count($escalafonId) ; $i++) { 
                    if( $escalafonId[$i]!=0 ){
                        $escalafon=Escalafon::find($escalafonId[$i]);
                        $escalafon->usuario_updated_at=Auth::user()->id;
                    }
                    else{
                        $escalafon=new Escalafon;
                        $escalafon->activista_id=$personaId;
                        $escalafon->usuario_created_at=Auth::user()->id;
                    }

                    $escalafon->cargo_estrategico_id=$cargo[$i];
                    $escalafon->grupo_persona_id=$grupo[$i];
                    $escalafon->fecha_inicio=$fechaInicio[$i];
                    if( trim( $fechaFinal[$i] )!='' )
                        $escalafon->fecha_final=$fechaFinal[$i];

                    $escalafon->documento_inicio=$documentoInicio[$i];
                    if( trim( $documentoFinal[$i] )!='' )
                        $escalafon->documento_final=$documentoFinal[$i];
                    $escalafon->estado=1;
                    $escalafon->save();

                    if( ($i+1)==count($escalafonId) ){
                        $pers= Persona::find($personaId);
                        $pers->grupo_persona_id=$grupo[$i];
                        $pers->save();
                    }
                }
            return Response::json(
                array(
                'rst'=>1,
                'msj'=>'Registro actualizado correctamente',
                )
            );
        }
    }

    public function postCargarescalafon()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            $array['activista_id']=Input::get('persona_id');
            $personas = Persona::getCargarEscalafon($array);
            return Response::json(array('rst'=>1,'datos'=>$personas));
        }
    }

}
