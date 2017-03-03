<?php

class PaginaFirma extends Base
{
    public $table = "paginafirma";

    public static function PaginasPendientes()
    {
        $datos=PaginaFirma::where('estado','=','2')->get();

        $r['rst']='1';
        $r['msj']='Se listaron <b>'.count($datos).'</b> página(s)';
        $r['data']=$datos;
        return $r;
    }
}
