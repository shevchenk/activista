<?php

class UbigeoController extends \BaseController
{
    private $userID;

    public function __construct()
    {
        $this->beforeFilter('auth'); // bloqueo de acceso
        $this->userID = Auth::user()->id;
    }

    public function postCargarregion()
    {
        if ( Request::ajax() ) {
            $r= Ubigeo::getCargarRegion();

            return Response::json(
                    array(
                        'rst'=>1,
                        'datos'=>$r
                        )
            );
        }
    }

    public function postCargarprovincia()
    {
        if ( Request::ajax() ) {
            $array['w']='';
            if( Input::has('departamento_id') ){
                $array['w']=" AND departamento_id=".Input::get('departamento_id')." ";
            }
            
            $r= Ubigeo::getCargarProvincia($array);

            return Response::json(
                    array(
                        'rst'=>1,
                        'datos'=>$r
                        )
            );
        }
    }

    public function postCargardistrito()
    {
        if ( Request::ajax() ) {
            $array['w']='';
            if( Input::has('provincia_id') ){
                $array['w']=" AND provincia_id=".Input::get('provincia_id')." ";
            }
            
            $r= Ubigeo::getCargarDistrito($array);

            return Response::json(
                    array(
                        'rst'=>1,
                        'datos'=>$r
                        )
            );
        }
    }
}
