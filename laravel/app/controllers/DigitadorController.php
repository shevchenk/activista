<?php

class DigitadorController extends BaseController
{
    public function postListar()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            $r = Digitador::getListar();
            return Response::json(array('rst'=>1,'datos'=>$r));
        }
    }

}
