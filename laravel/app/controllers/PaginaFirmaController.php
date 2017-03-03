<?php

class PaginaFirmaController extends \BaseController
{
    public function postPaginaspendientes()
    {
        if ( Request::ajax() ) {
            $valida= PaginaFirma::PaginasPendientes($p);
            return Response::json($valida);
        }
    }
}
