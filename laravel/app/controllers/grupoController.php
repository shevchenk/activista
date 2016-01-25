<?php

class GrupoController extends \BaseController
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

    public function getPreguntas() {

        $results = DB::select('select * from preguntas where estado = 1');

        return Response::json($results);
    }

    public function postGuardargrupo() {
        $data = Input::all();
        $grupo_id = DB::table("grupos")->insertGetId(array(
            'activista_id' => $this->userID,
            'nombre' => array_key_exists('titulo', $data) ? $data['titulo']: "",
            'descripcion' => array_key_exists('descripcion', $data) ? $data['descripcion']: "",
            'fb_url' => array_key_exists('fb_url', $data) ? $data['fb_url']: "",
            'region' => array_key_exists('departamento', $data) ? $data['departamento']: "",
            'provincia' => array_key_exists('provincia', $data) ? $data['provincia']: "",
            'distrito' => array_key_exists('distrito', $data) ? $data['distrito']: "",
            'edad_desde' => array_key_exists('edad_desde', $data) ? $data['edad_desde']: "",
            'edad_hasta' => array_key_exists('edad_hasta', $data) ? $data['edad_hasta']: "",
            'sexo' => array_key_exists('sexo', $data) ? $data['sexo']: "",
            'estado' => 1,
        ));
        foreach($data['preguntas'] as $pre) {
            DB::table("grupo_pregunta")->insert(array(
                "pregunta_id"=>$pre['id'],
                "grupo_id"=>$grupo_id,
                "respuesta"=>array_key_exists('respuesta', $pre) ? $pre["respuesta"]: "",
                "estado"=>(array_key_exists('estado', $pre) && $pre['estado'] == "true") ? 1 : ""
            ));
        }

        // @todo manejar errores
        $results = array(
            "code"=>"ok",
            "message"=>"Datos correctamente guardados"
        );

        return Response::json($results);
    }

    public function getGrupos() {

        $data = Input::all();
        $where = ' activista_id = '.$this->userID;

        $rows = DB::select('select * from grupos where ' . $where  . ' order by id desc');
        $count = DB::select('select count(*) count from grupos where  ' . $where );


        return Response::json(array('results'=>array("list"=>$rows,'totalResults'=>$count[0]->count)));
    }

    public function getGruposbyid() {

        $where = " where 1 = 1 and estado = 1 ";
        $where  .= ' and activista_id = '.Input::get('activista_id');

        $rows = DB::select('select * from grupos  ' . $where );
        $count = DB::select('select count(*) count from grupos   ' . $where );


        return Response::json(array('results'=>array("list"=>$rows,'totalResults'=>$count[0]->count)));
    }

    public function getListargrupos() {
        $rows = DB::select('select * from grupos where estado = 1' );
        return Response::json(array('results'=>array("list"=>$rows)));
    }


    public function getGrupo() {

        $data = Input::all();
        $grupo_id = Input::get('grupo_id');
        $where = ' activista_id = '.$this->userID;

        if ( $grupo_id) {
            $where  .=  " and id = ".$grupo_id;
        }

        $rows = DB::select('select *, nombre as titulo from grupos where ' . $where );

        $preguntas = DB::select('select p.id, p.pregunta , gp.respuesta, gp.estado
                                    from grupo_pregunta gp
                                    right join preguntas p on p.id = gp.pregunta_id
                                    where gp.grupo_id = '.$grupo_id);
        $response = $rows[0];
        $response->preguntas = $preguntas;

        return Response::json($response);
    }

    public function postActualizargrupo() {
        $data = Input::all();
        $grupo_id = $data["id"];

        DB::table("grupos")
            ->where('id', $grupo_id)
            ->update(array(
                'nombre' => array_key_exists('titulo', $data) ? $data['titulo']: "",
                'descripcion' => array_key_exists('descripcion', $data) ? $data['descripcion']: "",
                'fb_url' => array_key_exists('fb_url', $data) ? $data['fb_url']: "",
                'region' => array_key_exists('departamento', $data) ? $data['departamento']: "",
                'provincia' => array_key_exists('provincia', $data) ? $data['provincia']: "",
                'distrito' => array_key_exists('distrito', $data) ? $data['distrito']: "",
                'edad_desde' => array_key_exists('edad_desde', $data) ? $data['edad_desde']: "",
                'edad_hasta' => array_key_exists('edad_hasta', $data) ? $data['edad_hasta']: "",
                'sexo' => array_key_exists('sexo', $data) ? $data['sexo']: "",
            ));

        DB::table("grupo_pregunta")->where('grupo_id','=' ,$grupo_id)->delete();

        foreach($data['preguntas'] as $pre) {
            DB::table("grupo_pregunta")->insert(array(
                "pregunta_id"=>$pre['id'],
                "grupo_id"=>$grupo_id,
                "respuesta"=>array_key_exists('respuesta', $pre) ? $pre['respuesta']: "",
                "estado"=>array_key_exists('estado', $pre) && $pre['estado'] == "true"? 1 : ""
            ));
        }

        // @todo manejar errores
        $results = array(
            "code"=>"ok",
            "message"=>"Datos correctamente guardados"
        );

        return Response::json($results);
    }

    public function postCambiarestado() {
        $data = Input::all();
        $grupo_id = $data["id"];
        $nuevo_estado = $data["estado"] == 1 ? 0 : 1;
        if ($grupo_id) {
            DB::table("grupos")
                ->where('id', $grupo_id)
                ->update(array(
                    "estado"=>$nuevo_estado
                ));

            // @todo manejar errores
            $results = array(
                "code"=>"ok",
                "message"=>"Datos correctamente guardados"
            );

            return Response::json($results);
        }

    }


    public function getUnirgrupo () {

        if (Input::get('grupo_id')) {
            DB::table("activista_grupo")
                ->insert(array(
                    "grupo_id"=>Input::get('grupo_id'),
                    "activista_id"=>$this->userID,
                    "estado"=>1,
                    "fecha_ingreso"=>date("dd-mm-yyyy")
                ));
            // @todo manejar errores
            $results = array(
                "code"=>"ok",
                "message"=>"Datos correctamente guardados"
            );
        }

        return Response::json($results);
    }

    public function getSalirgrupo () {

        $data = Input::all();
        $grupo_id = $data["grupo_id"];


        if ($grupo_id) {
            DB::delete('delete from activista_grupo where activista_id = '.$this->userID.'  and grupo_id = '.$grupo_id);
        }
        // @todo manejar errores
        $results = array(
            "code"=>"ok",
            "message"=>"Datos correctamente guardados"
        );

        return Response::json($results);
    }


    public function getActivistagrupo () {

        $list = DB::select('select * from activista_grupo where activista_id = '.$this->userID);

        // @todo manejar errores
        $results = array(
            "code"=>"ok",
            "message"=>"Datos correctamente guardados"
        );

        return Response::json($list);
    }


}
