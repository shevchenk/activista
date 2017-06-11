<?php

class PaginaFirmaController extends \BaseController
{
    public function postPaginaspendientes()
    {
        if ( Request::ajax() ) {
            $r=array();
            $r= PaginaFirma::PaginasPendientes($r);
            $r= PaginaFirma::PaginasPendientesDosCientos($r);
            return Response::json($r);
        }
    }
}
