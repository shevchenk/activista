<?php

class ValidarController extends \BaseController
{
    public function getEmail()
    {
        //si la peticion es ajax
        echo Input::get('email');
        echo "<br>";
        echo Input::get('hash');
        echo "<br>";
        $r = Validar::Verificar();
        if($r>0){
            Validar::Emailok();
            echo ".::Muy bien::.";
        }
        else{
            echo ".::Infiltrado Detectado::.";
        }
    }

}
