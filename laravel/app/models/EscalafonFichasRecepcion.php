<?php

class EscalafonFichasRecepcion extends Base
{
    public $table = "escalafon_fichas_recepcion";

    public static function getCargarRecepcionCount( $array )
    {
        $sSql=" SELECT COUNT(efr.id) cant
                FROM escalafon_fichas_recepcion efr
                WHERE efr.estado=1 ";
        $sSql.= $array['where'];
        $oData = DB::select($sSql);
        return $oData[0]->cant;
    }

    public static function getCargarRecepcion( $array )
    {
        $sSql=" SELECT efr.id,efr.orden,efr.fecha_recepcion,efr.desde,efr.hasta,efr.escalafon_ficha_id,
                (efr.hasta-efr.desde+1) total,IFNULL(buena,'') buena, IFNULL(mala,'') mala
                FROM escalafon_fichas_recepcion efr
                WHERE efr.estado=1 ";
        $sSql.= $array['where'].
                $array['order'].
                $array['limit'];
        $oData = DB::select($sSql);
        return $oData;
    }
}
