<?php

class OperadorController extends BaseController
{
    public function postListar()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            $r = Operador::getListar();
            return Response::json(array('rst'=>1,'datos'=>$r));
        }
    }

}
