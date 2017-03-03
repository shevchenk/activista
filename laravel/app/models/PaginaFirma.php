<?php

class PaginaFirma extends Base
{
    public $table = "paginafirma";

    public static function PaginasPendientes()
    {
        $datos=PaginaFirma::where('estado','=','2');

        $r['rst']='1';
        $r['data']=$datos;
        return $r;
    }
}
