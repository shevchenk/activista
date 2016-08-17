<?php

class EscalafonFichas extends Base
{
    public $table = "escalafon_fichas";

    public static function getCargarEntregasCount( $array )
    {
        $sSql=" SELECT COUNT(ef.id) cant
                FROM escalafon_fichas ef
                WHERE ef.estado=1 ";
        $sSql.= $array['where'];
        $oData = DB::select($sSql);
        return $oData[0]->cant;
    }

    public static function getCargarEntregas( $array )
    {
        $sSql=" SELECT ef.id,ef.orden,ef.fecha_entrega,ef.desde,ef.hasta,ef.escalafon_id,
                (ef.hasta-ef.desde+1) total,ef.desdeh,ef.hastah,
                (   SELECT COUNT(efr.id) 
                    FROM escalafon_fichas_recepcion efr
                    WHERE efr.escalafon_ficha_id=ef.id
                    AND efr.estado=1
                ) validar
                FROM escalafon_fichas ef
                WHERE ef.estado=1 ";
        $sSql.= $array['where'].
                $array['order'].
                $array['limit'];
        $oData = DB::select($sSql);
        return $oData;
    }

    public static function getEFIdporFicha( $nro )
    {   
        if( $nro==''){
            $nro=0;
        }
        
        $sSql=" SELECT id
                FROM escalafon_fichas
                WHERE desde<=$nro AND hasta>=$nro
                AND estado=1 ";
        $oData = DB::select($sSql);
        return $oData;
    }

    public static function getEFRIdporFicha( $nro )
    {   
        if( $nro==''){
            $nro=0;
        }
        
        $sSql=" SELECT id
                FROM escalafon_fichas_recepcion
                WHERE desde<=$nro AND hasta>=$nro
                AND estado=1 ";
        $oData = DB::select($sSql);
        return $oData;
    }
}
