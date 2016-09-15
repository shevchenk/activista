<?php
Route::get(
    'email/{email}', function($email){
        $i=4;
        $parametros=array(
            'paso'      => ($i+1),
            'persona'   => 'Salcedo Franco Jorge Luis',
            'area'      => 'Area GMGM',
            'procesoe'  => 'Proceso Nuevo',
            'personae'  => 'Juan Luna Galvez',
            'areae'     => 'Gerente de la Calidad'
        );

            Mail::send('prueba', $parametros ,
                function($message) use($email){
                $message
                ->to($email)
                ->subject('.::Se ha involucrado en nuevo proceso::.');
                }
            );

            echo 'Se realizó con éxito su registro, <strong>valide su email.</strong>';

    }
);

Route::get(
    '/', function () {
        if (Session::has('accesos')) {
            return Redirect::to('/admin.proceso.perfilView');
        } else {
            return View::make('login');
        }
    }
);

Route::get(
    'salir', function () {
        Auth::logout();
        Session::flush();
        return Redirect::to('/');
    }
);

Route::get(
    '/validadni', function () {
            return View::make('/admin.proceso.validadni');
    }
);

Route::controller('validar', 'ValidarController');

Route::get("search", function () {
    return Response::json(array("saldo"=>232));
});



Route::controller('check', 'LoginController');

Route::get(
    '/{ruta}', array('before' => 'auth', function ($ruta) {
        if (Session::has('accesos')) {
            $accesos = Session::get('accesos');
            $menus = Session::get('menus');

            $val = explode("_", $ruta);
            $valores = array( 
                'valida_ruta_url' => $ruta,
                'menus' => $menus
            );
            if (count($val) == 2) {
                $dv = explode("=", $val[1]);
                $valores[$dv[0]] = $dv[1];
            }
            $rutaBD = substr($ruta, 6);
            //si tiene accesoo si accede al inicio o a misdatos
            /*if (in_array($rutaBD, $accesos) or 
                $rutaBD == 'inicio' or $rutaBD=='mantenimiento.misdatos'
                or $rutaBD=='proceso.perfil'
                or $rutaBD=='proceso.perfilView') {*/
                return View::make($ruta)->with($valores);
            //} else
            //    return Redirect::to('/');
        } else
            return Redirect::to('/');
    })
);


Route::controller('usuario', 'UsuarioController');
Route::controller('persona', 'PersonaController');
Route::controller('cargo', 'CargoController');
Route::controller('menu', 'MenuController');
Route::controller('opcion', 'OpcionController');
Route::controller('perfil', 'PerfilController');
Route::controller('grupo', 'grupoController');
Route::controller('seguidor', 'seguidorController');
Route::controller('comunicacion', 'ComunicacionController');
Route::controller('reporte', 'ReporteController');
Route::controller('tgrupo', 'TGrupoController');
Route::controller('grupop', 'GrupoPController');
Route::controller('mensajeria', 'MensajeriaController');
Route::controller('cargar', 'CargarController');
Route::controller('cargo_estrategico', 'CargoEstrategicoController');
Route::controller('grupo_cargo', 'GrupoCargoController');
Route::controller('ubigeo', 'UbigeoController');
Route::controller('escalafonficha', 'EscalafonFichasController');
Route::controller('ficha', 'FichaController');
Route::controller('firma', 'FirmaController');
Route::controller('operador', 'OperadorController');
Route::controller('digitador', 'DigitadorController');
