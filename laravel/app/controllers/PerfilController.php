<?php

class PerfilController extends \BaseController
{

    /**
     * Constructor de la clase
     *
     */
    public function __construct()
    {
        $this->beforeFilter('auth'); // bloqueo de acceso
    }

    public function debug($data , $kill = true) {
        var_dump($data);
        if ($kill)
            die();
    }

    /**
     * cargar modulos, mantenimiento
     * POST /perfil/test
     *
     * @return Response
     */
    public function getTest()
    {

//        $usuario = Persona::find(Auth::user()->id);
        $id = Auth::user()->id;
        return Response::json($id);
    }


    public function getApoyos() {

        $results = DB::select('select *, (select 1 from activista_apoyo aa where aa.id_activista = '.Auth::user()->id.'   and aa.id_apoyo = a.id ) selected from apoyos a');

        return Response::json($results);
    }


    public function getActivista() {
        $user_id = Auth::user()->id;
        $activista = DB::table('activistas')->where('id', '=', $user_id)->get();

        return Response::json($activista[0]);
    }

    public function getPerfilactivista() {

        $sql = "";
        $results = DB::select($sql);

        return Response::json($results);
    }

    public function postGuardarperfil() {

        $table = "activista_apoyo";

        $user_id = Auth::user()->id;
        $data = Input::all();

        // Actualizar datos de apoyo
        // borro datos del usuario
        DB::table($table)->where('id_activista','=' ,$user_id)->delete();
        foreach($data['activismo'] as $row) {
            if (array_key_exists('selected', $row) && ($row['selected'] == 'true' || $row['selected'] == '1') ) {
                DB::table($table)->insert(array('id_apoyo' => $row['id'],'id_activista' => $user_id ));
            }
        }

        try {
            // actualizacion de los demas datos
//            $this->debug($data);
            DB::table("activistas")->where('id','=' ,$user_id)
                ->update(array(
                    'dni' => array_key_exists('dni', $data) ? $data['dni']: "",
                    'paterno' => array_key_exists('paterno', $data) ? $data['paterno']: "",
                    'materno' => array_key_exists('orientacion_sexual', $data) ? $data['materno']: "",
                    'nombres' => array_key_exists('nombres', $data) ? $data['nombres']: "",
                    'sexo' => array_key_exists('sexo', $data) ? $data['sexo']: "",
                    'orientacion_sexual' => array_key_exists('orientacion_sexual', $data) ? $data['orientacion_sexual']: "",
                    'estado_civil' => array_key_exists('estado_civil', $data) ? $data['estado_civil']: "",
                    'grado_instruccion' => array_key_exists('grado_instruccion', $data) ? $data['grado_instruccion']: "",
                    'profesion' => array_key_exists('profesion', $data) ? $data['profesion']: "",
                    'celular' => array_key_exists('celular', $data) ? $data['celular']: "",
                    'twitter' => array_key_exists('twitter', $data) ? $data['twitter']: "",
                    'email' => array_key_exists('email', $data) ? $data['email']: "",
                    'fecha_nacimiento' => array_key_exists('fecha_nacimiento', $data) ? explode("T",$data['fecha_nacimiento'])[0]: "",
                    'n_departamento' => array_key_exists('n_departamento', $data) ? $data['n_departamento']: "",
                    'n_provincia' => array_key_exists('n_provincia', $data) ? $data['n_provincia']: "",
                    'n_distrito' => array_key_exists('n_distrito', $data) ? $data['n_distrito']: "",
                    'd_departamento' => array_key_exists('d_departamento', $data) ? $data['d_departamento']: "",
                    'd_provincia' => array_key_exists('d_provincia', $data) ? $data['d_provincia']: "",
                    'd_distrito' => array_key_exists('d_distrito', $data) ? $data['d_distrito']: "",
                    'd_urbanizacion' => array_key_exists('d_urbanizacion', $data) ? $data['d_urbanizacion']: "",
                    'd_avenida' => array_key_exists('d_avenida', $data) ? $data['d_avenida']: "",
                    'd_numero' => array_key_exists('d_numero', $data) ? $data['d_numero']: "",
                    'd_telefono' => array_key_exists('d_telefono', $data) ? $data['d_telefono']: "",
                    'cv_departamento' => array_key_exists('cv_departamento', $data) ? $data['cv_departamento']: "",
                    'cv_provincia' => array_key_exists('cv_provincia', $data) ? $data['cv_provincia']: "",
                    'cv_distrito' => array_key_exists('cv_distrito', $data) ? $data['cv_distrito']: "",
                    'cv_colegio' => array_key_exists('cv_colegio', $data) ? $data['cv_colegio']: "",
                    'cv_mesa' => array_key_exists('cv_mesa', $data) ? $data['cv_mesa']: "",
                    'cl_departamento' => array_key_exists('cl_departamento', $data) ? $data['cl_departamento']: "",
                    'cl_provincia' => array_key_exists('cl_provincia', $data) ? $data['cl_provincia']: "",
                    'cl_distrito' => array_key_exists('cl_distrito', $data) ? $data['cl_distrito']: "",
                    'cl_urbanizacion' => array_key_exists('cl_urbanizacion', $data) ? $data['cl_urbanizacion']: "",
                    'cl_direccion' => array_key_exists('cl_direccion', $data) ? $data['cl_direccion']: "",
                    'cl_numero' => array_key_exists('cl_numero', $data) ? $data['cl_numero']: "",
                    'cl_telefono' => array_key_exists('cl_telefono', $data) ? $data['cl_telefono']: "",
                    'cl_nombre' => array_key_exists('cl_nombre', $data) ? $data['cl_nombre']: "",
                    'soy_lider' => array_key_exists('soy_lider', $data) ? $data['soy_lider']: "",

                ));
        }catch(Exception $e) {
            $this->debug($e);
        }


        return Response::json(array("message"=>"Datos correctamente guardados"));
    }

    public  function getDepartamentos() {

        $results = DB::select('select * from departamentos ORDER by nombre');
        return Response::json($results);
    }


    public function getNiveles($nivel_id = 0) {
        if($nivel_id >0) {
            return Response::json(DB::select('select * from cargos where id = '.$nivel_id)[0]);
        } else {
            return Response::json(DB::select('select * from cargos '));

        }
    }

    public  function getProvincias() {

        $dep = Input::get('iddepartamento');

        $where = "";
        if ($dep) {
            $where  =  " where departamento_id = $dep";
        }

        $results = DB::select('select id, nombre from provincias'. $where . ' ORDER by nombre');
        return Response::json($results);

    }

    public  function getDistritos() {

        $dep = Input::get('idprovincia');
        $where = "";
        if ($dep) {
            $where  =  " where provincia_id = $dep";
        }

        $results = DB::select('select * from distritos'. $where . ' ORDER by nombre');
        return Response::json($results);

    }

    public function getLiderpadre() {

        $user_id = Auth::user()->id;
        $activista = DB::table('activistas')->where('id', '=', $user_id)->get();

        if ($activista[0]->lider_padre){

            $lider_padre = DB::table('activistas')->where('id', '=', $activista[0]->lider_padre)->get();

            $result = $lider_padre[0];
        } else {
            $result = array("message"=>"No se encontre lider ");
        }

        return Response::json($result);

    }



    public function getBuscarlider() {

        $data = Input::all();
        $where = ' ';


        if ( Input::get('texto')) {
            $where  .=  " and CONCAT(paterno,materno, nombres, dni, email) like  '%" . Input::get('texto'). "%' ";
        }

        if ( Input::get('nivel')) {
            $where  .=  " and nivel_id = ".Input::get('nivel');
        }

        $field = "  id ";
        $orderby = "  order by $field ".$data['sort_dir'];
        $ini = $data['skip'];
        $fin = $data['limit'];
        $limit = $orderby. " limit $ini,$fin ";

        $activistas = DB::select('select * from activistas where  1=1 ' . $where  . $limit);
        $count = DB::select('select count(*) count from activistas where 1=1  ' . $where );


        return Response::json(array('results'=>array("list"=>$activistas,'totalResults'=>$count[0]->count)));

    }


    public function postAsignarlider () {

        $user_id = Auth::user()->id;
        $result = array();
        if ( Input::get('id_lider')) {
            DB::table("activistas")->where('id','=' ,$user_id)
                ->update(array(
                    'lider_padre'=>Input::get('id_lider')
                ));

            $result = array("message"=>"Se asigno lider correctamente");
        } else {
            $result = array("message"=>"No se reconoció al lider");

        }

        return Response::json($result);

    }




}
