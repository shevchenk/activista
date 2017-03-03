<?php

class PaginaFirmaController extends \BaseController
{
    public function postPaginaspendientes()
    {
        if ( Request::ajax() ) {
            $valida= PaginaFirma::PaginasPendientes();
            return Response::json($valida);
        }
    }
}
