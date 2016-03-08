<?php

class SeguidorController extends \BaseController
{

    private $userID;

    /**
     * Constructor de la clase
     *
     */
    public function __construct()
    {
        $this->beforeFilter('auth'); // bloqueo de acceso
        $this->userID = Auth::user()->id;
    }

    public function debug($data , $kill = true) {
        var_dump($data);
        if ($kill)
            die();
    }

    /**
     * cargar modulos, mantenimiento
     * GET /perfil/test
     *
     * @return Response
     */
    public function getTest()
    {
//        $usuario = Persona::find(Auth::user()->id);
        return Response::json($this->userID);
    }

    public function getSeguidores() {


        $rows = DB::select('select * from activistas where lider_padre = '.$this->userID.' and  estado = 1 order by id desc ');
        $count = DB::select('select count(*) count from activistas where lider_padre = '.$this->userID.' and  estado = 1 ' );


        return Response::json(array('results'=>array("list"=>$rows,'totalResults'=>$count[0]->count)));
    }

    public function postSeguidorguardar() {
        $data = Input::all();

        if( !Input::has('nombres') || trim($data['nombres'])=='' ){
            $results = array(
                "code"=>"error",
                "message"=>"Se requiere registro de su Nombre"
            );
        }
        elseif( (!Input::has('paterno') AND !Input::has('materno')) || ( trim($data['paterno'])=='' AND trim($data['materno'])=='' ) ){
            $results = array(
                "code"=>"error",
                "message"=>"Se requiere que almenos se registre en Paterno o Materno"
            );
        }
        elseif( !Input::has('dni') || trim($data['dni'])=='' ){
            $results = array(
                "code"=>"error",
                "message"=>"Se requiere registro de su Dni"
            );
        }
        else{
            $results = DB::select("SELECT * FROM activistas WHERE dni = '" . $data['dni']."'");
    //        $this->debug(count($results) );
            if (count($results) ==  0) {
                $activista_id = DB::table("activistas")->insertGetId(array(
                    'lider_padre' => $this->userID,
                    'paterno' => array_key_exists('paterno', $data) ? $data['paterno']: "",
                    'materno' => array_key_exists('materno', $data) ? $data['materno']: "",
                    'nombres' => array_key_exists('nombres', $data) ? $data['nombres']: "",
                    'celular' => array_key_exists('celular', $data) ? $data['celular']: "",
                    'email' => array_key_exists('email', $data) ? $data['email']: "",
                    'dni' => array_key_exists('dni', $data) ? $data['dni']: "",
                    'password' => array_key_exists('dni', $data) ? Hash::make($data['dni']): "",
                    'nivel_id' => array_key_exists('nivel', $data) ? $data['nivel']: "",
                    'fecha_ingreso' => date('Y-m-d'),
                    'usuario_created_at' => Auth::user()->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'estado' => 1,
                ));

                $activistaCargo = new ActivistaCargo;
                $activistaCargo->activista_id=$activista_id;
                $activistaCargo->cargo_id= array_key_exists('nivel', $data) ? $data['nivel']: "";
                $activistaCargo->usuario_created_at= Auth::user()->id;
                $activistaCargo->save();

                $results = array(
                    "code"=>"ok",
                    "message"=>"Datos correctamente guardados"
                );

            } else {
                $results = array(
                    "code"=>"error",
                    "message"=>"El DNI ya fue registrado, no puede volverse a regsitrar."
                );
            }
        }

        return Response::json($results);
    }




}
