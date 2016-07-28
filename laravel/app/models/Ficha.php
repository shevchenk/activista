<?php

class Ficha extends Base
{
    public $table = "fichas";

    public static function getCargarReniecCount( $array )
    {
        $sSql=" SELECT  COUNT(r.id) cant
                FROM reniec r
                LEFT JOIN fichas f ON f.id=r.ficha_id 
                WHERE r.estado=1";
        $sSql.= $array['where'];
        $oData = DB::select($sSql);
        return $oData[0]->cant;
    }

    public static function getCargarReniec( $array )
    {
        $sSql=" SELECT  CONCAT(r.id,'|',IFNULL(f.id,'')) id,
                r.paterno,r.materno,r.nombres,r.dni,
                f.paterno paternon,f.materno maternon,f.nombres nombresn,f.ficha
                FROM reniec r
                LEFT JOIN fichas f ON f.id=r.ficha_id 
                WHERE r.estado=1
                ";
        $sSql.= $array['where'].
                $array['order'].
                $array['limit'];
        $oData = DB::select($sSql);
        return $oData;
    }

    public static function getValidarFicha( $array )
    {
        $sSql=" SELECT COUNT(ef.id) cant
                FROM escalafon_fichas ef
                WHERE ef.estado=1 ";
        $sSql.= $array['where'];
        $oData = DB::select($sSql);
        return $oData[0]->cant;
    }

    public static function getValidarEstadoFicha( $ficha )
    {
        $sSql=" SELECT COUNT(IF(estado_ficha=1,id,NULL)) buenas,COUNT(IF(estado_ficha!=1,id,NULL)) malas
                FROM fichas
                WHERE ficha=$ficha
                AND estado=1
                GROUP BY ficha";
        $oData = DB::select($sSql);
        return $oData;
    }
}
