<?php

class ValidarController extends \BaseController
{
    public function getEmail()
    {
        $r = Validar::Verificar();
        if($r>0){
            Validar::Emailok();
        }
        $valores=".::Muchas gracias, no te defraudaré::.";
        return View::make('login')->with($valores);
    }

}
