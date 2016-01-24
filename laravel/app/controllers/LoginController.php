<?php
class LoginController extends BaseController
{
    public function postLogin()
    {
        if (Request::ajax()) {

        $userdata= array(
            'dni' => Input::get('usuario'),
            'password' => Input::get('password'),
        );

            if ( Auth::attempt($userdata, Input::get('remember', 0)) ) {
                //buscar los permisos de este usuario y guardarlos en sesion
                $query = "  SELECT m.nombre as menu, o.nombre as opcion,o.visible,
                            IF(LOCATE('.', o.ruta)>0,
                                    o.ruta,
                                    CONCAT(m.ruta,'.',o.ruta)
                            ) as ruta, m.class_icono as icon,
                            CONCAT(a.paterno, ' ', a.materno, ', ', a.nombres)
                            as persona
                            FROM activistas a
                            JOIN activista_cargo ac ON ac.activista_id=a.id AND ac.estado=1
                            JOIN cargos c ON c.id=ac.cargo_id AND c.estado=1
                            JOIN cargo_opcion co ON co.cargo_id=c.id AND co.estado=1
                            JOIN opciones o ON o.id=co.opcion_id AND o.estado=1
                            JOIN menus m ON m.id=o.menu_id AND m.estado=1
                            WHERE a.estado=1
                            AND a.id=?
                            GROUP BY m.id, o.id
                            ORDER BY m.nombre, o.nombre";
                $res = DB::select($query, array(Auth::user()->id));
                $persona=1;
                $menus = array();
                $accesos = array();
                foreach ($res as $data) {
                    $menu = $data->menu;
                    $persona = $data->persona;
                    //$accesos[] = $data->ruta;
                    array_push($accesos, $data->ruta);
                    if (isset($menus[$menu])) {
                        $menus[$menu][] = $data;
                    } else {
                        $menus[$menu] = array($data);
                    }
                }

                Session::set('language', 'Español');
                Session::set('language_id', 'es');
                Session::set('menus', $menus);
                Session::set('accesos', $accesos);
                Session::set('persona', $persona);
                Lang::setLocale(Session::get('language_id'));

                return Response::json(
                    array(
                        'rst'=>'1',
                        'estado'=>Auth::user()->estado,
                        'query'=>$query,
                        'menu'=>$menus,
                        'acceso'=>$accesos,
                    )
                );
            } else {
                $m = ' y/o la <strong>contraseña</strong> son incorrectos.';
                return Response::json(
                    array(
                    'rst'=>'2',
                    'msj'=>'El <strong>Usuario</strong>'.$m,
                    )
                );
            }

        }

    }

    public function postNuevo(){
        if (Request::ajax()) {

            $activista = new Usuario;
            $activista->paterno = Input::get('paterno');
            $activista->materno = Input::get('materno');
            $activista->nombres = Input::get('nombre');
            $activista->email = Input::get('email');
            $activista->dni = Input::get('dni');
            $activista->fecha_ingreso = date("Y-m-d");
            $activista->password =  Hash::make(Input::get('passwordn'));
            $activista->nivel_id = Input::get('rdb_check');
            $activista->save();

            $activistaCargo = new ActivistaCargo;
            $activistaCargo->activista_id=$activista->id;
            $activistaCargo->cargo_id= Input::get('rdb_check');
            $activistaCargo->usuario_created_at= $activista->id;
            $activistaCargo->save();

            return Response::json(
                array(
                    'rst'    => '1',
                    'msj'    => ''
                )
            );

        }
    }

    public function postImagen()
    {
        if (isset($_FILES['imagen']) and $_FILES['imagen']['size'] > 0) {

            $uploadFolder = 'img/user/'.md5('u'.Auth::user()->id);
            
            if ( !is_dir($uploadFolder) ) {
                mkdir($uploadFolder);
            }

            $nombreArchivo = $_FILES['imagen']['name'];
            $extArchivo = end((explode(".", $nombreArchivo)));
            $tmpArchivo = $_FILES['imagen']['tmp_name'];
            $archivoNuevo = "u".Auth::user()->id . "." . $extArchivo;
            $file = $uploadFolder . '/' . $archivoNuevo;

            @unlink($file);

            $m="Ocurrio un error al subir el archivo. No pudo guardarse.";
            if (!move_uploaded_file($tmpArchivo, $file)) {
                return Response::json(
                    array(
                        'upload' => FALSE,
                        'rst'    => '2',
                        'msj'    => $m,
                        'error'  => $_FILES['archivo'],
                    )
                );
            }

            $usuario = Usuario::find(Auth::user()->id);
            $usuario->imagen = $archivoNuevo;
            $usuario->save();

            return Response::json(
                array(
                    'rst'       => '1',
                    'msj'       => 'Imagen subida correctamente',
                    'imagen'    => $file,
                    'upload'    => TRUE, 
                    'data'      => "OK",
                )
            );
        }
    }

}
