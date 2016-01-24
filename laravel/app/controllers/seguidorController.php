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

        $activista_id = DB::table("activistas")->insertGetId(array(
            'lider_padre' => $this->userID,
            'paterno' => array_key_exists('paterno', $data) ? $data['paterno']: "",
            'materno' => array_key_exists('materno', $data) ? $data['materno']: "",
            'nombres' => array_key_exists('nombres', $data) ? $data['nombres']: "",
            'dni' => array_key_exists('dni', $data) ? $data['dni']: "",
            'fecha_ingreso' => date('Y-m-d'),
            'estado' => 1,
        ));

        // @todo manejar errores
        $results = array(
            "code"=>"ok",
            "message"=>"Datos correctamente guardados"
        );

        return Response::json($results);
    }




}
