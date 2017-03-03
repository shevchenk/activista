<?php

class PaginaFirmaController extends \BaseController
{
    public function postPaginasPendientes()
    {
        if ( Request::ajax() ) {
            $valida= PaginaFirma::PaginasPendientes($p);
            return Response::json($valida);
        }
    }
}
