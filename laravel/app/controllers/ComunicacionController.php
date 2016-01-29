<?php

class ComunicacionController extends \BaseController
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

    public function errorMessage($message) {

        header('HTTP/1.1 401 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => $message, 'code' => 'error')));
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

    public function postComunicacion() {
        $data = Input::all();

        $grupo_id = DB::table("mensajes")->insertGetId(array(
            'activista_id' => $this->userID,
            'asunto' => array_key_exists('asunto', $data) ? $data['asunto']: "",
            'mensaje' => array_key_exists('descripcion', $data) ? $data['descripcion']: "",
            'estado' => 0,
            'created_at' => date('Y-m-d H:i:s'),
        ));

        if ($grupo_id) {
            // @todo manejar errores
            $results = array(
                "code"=>"ok",
                "message"=>"Datos correctamente guardados"
            );
        }


        return Response::json($results);

    }

    public function getComunicacion() {


        $rows = DB::select('select * from mensajes where activista_id = '.$this->userID.' order by id desc ');
//        $count = DB::select('select count(*) count from activistas where lider_padre = '.$this->userID.' and  estado = 1 ' );


        return Response::json($rows);

    }






}
