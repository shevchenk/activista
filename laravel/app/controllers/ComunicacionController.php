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

        if (!empty($data['envioEnMasa'])) {
            // mensaje enviado por libre para muchos grupos
            $idMensaje = DB::table("mensajes")->insertGetId(array(
                'activista_id' => $this->userID,
                'asunto' => array_key_exists('asunto', $data) ? $data['asunto']: "",
                'mensaje' => array_key_exists('mensaje', $data) ? $data['mensaje']: "",
                'estado' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'reponsed_at' => date('Y-m-d H:i:s'),
            ));

            // registra la respuesta automaticamente
            $id = DB::table("respuestas")->insertGetId(array(
                'mensaje_id' => $idMensaje,
                'respondido_por' => $this->userID,
                'respondido_at' => date('Y-m-d H:i:s'),
                'respuesta' => $data['respuesta'],
                'tipo_acceso_id' => $data['acceso'],
                'estado' => 1,
            ));

            // @todo : agregar el guardar accesos cuando se haga para paginas , grupo de personas , etc

            $results = array(
                "code"=>"ok",
                "message"=>"Mensaje Enviado"
            );



        } elseif (!empty($data['editar'])) {
            DB::table("mensajes")
                ->where('id', $data['id'])
                ->update(array(
                    'estado' => 1,
                    'reponsed_at' => date('Y-m-d H:i:s'),
                ));

            $id = DB::table("respuestas")->insertGetId(array(
                'mensaje_id' => $data['id'],
                'respondido_por' => $this->userID,
                'respondido_at' => date('Y-m-d H:i:s'),
                'respuesta' => $data['respuesta'],
                'tipo_acceso_id' => $data['acceso'],
                'estado' => 1,
            ));

            $results = array(
                "code"=>"ok",
                "message"=>"Datos correctamente guardados"
            );

        } else {
            $id = DB::table("mensajes")->insertGetId(array(
                'activista_id' => $this->userID,
                'asunto' => array_key_exists('asunto', $data) ? $data['asunto']: "",
                'mensaje' => array_key_exists('descripcion', $data) ? $data['descripcion']: "",
                'estado' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ));

            if ($id) {
                // @todo manejar errores
                $results = array(
                    "code"=>"ok",
                    "message"=>"Datos correctamente guardados"
                );
            }
        }

        return Response::json($results);
    }

    public function getComunicacion($mensaje_id = 0) {
        $data = Input::all();
        $where = ' where  1 = 1 ';

        if (!empty($data['soy']) && $data['soy'] != 'liebre') {
            $where .= " activista_id = '.$this->userID.' ";
        }

        if (isset($data['estado'])) {
            $where .= " and estado = ".$data['estado'] . ' ' ;
        }

        if (!empty($mensaje_id)) {
            $where .= " and id = ".$mensaje_id . ' ' ;
        }

        if (!empty($data['soloEnviados'])) {
            $where .= " and activista_id = " . $this->userID . ' ' ;
        }

        $sql = 'select * from mensajes ' .$where. ' order by id desc ';
        $rows = DB::select($sql);

        if (!empty($mensaje_id)) {
            return Response::json($rows[0]);

        } else
            return Response::json($rows);

    }

    public function getTipoacceso($tipo_acceso_id = 0) {

        $sql = 'select * from tipo_accesos where estado = 1';

        return Response::json(DB::select($sql));
    }

    // bandeja id es em id del mensae de la bandeja
    // la bandeja devuelve todos los mensajes que pertenecen al usuario activo
    public function getBandeja($bandeja_id = 0) {
        $unico = $bandeja_id > 0;
        $where = '';

        if ($unico) {
            $where = ' where id = '.$bandeja_id . ' ';
        }

        $sql = "
        select * from
            (
            select * from
            (
            select m.*, r.respuesta, r.tipo_acceso_id, r.respondido_at
            from mensajes m
            inner join respuestas r on r.mensaje_id = m.id
            where m.estado = 1
            and r.tipo_acceso_id = 1 and activista_id = " .  $this->userID  . "
            ) q1

            union
            SELECT * from
            (
            select  m.*, r.respuesta, r.tipo_acceso_id , r.respondido_at
            from mensajes m
            inner join respuestas r on r.mensaje_id = m.id
            where m.estado = 1
            and r.tipo_acceso_id = 2
            ) q2

            ) bandeja
            ". $where . "
            order by respondido_at desc
        ";
        if ($unico)
            return Response::json(DB::select($sql)[0]);
        else
            return Response::json(DB::select($sql));

    }






}
