<?php

class PaginaFirmaController extends \BaseController
{
    public function postPaginaspendientes()
    {
        if ( Request::ajax() ) {
            $r=array();
            $r= PaginaFirma::PaginasPendientes();
            $r= PaginaFirma::PaginasPendientesDosCientos();
            return Response::json($r);
        }
    }
}
