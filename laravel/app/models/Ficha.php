<?php

class EscalafonFichas extends Base
{
    public $table = "fichas";

    public static function getCargarReniecCount( $array )
    {
        $sSql=" SELECT  COUNT(e.id) cant
                FROM activistas a
                INNER JOIN escalafon e ON e.activista_id=a.id AND e.fecha_final IS NULL 
                INNER JOIN grupos_personas gp ON gp.id=e.grupo_persona_id
                INNER JOIN cargos_estrategicos ce ON ce.id=e.cargo_estrategico_id
                LEFT JOIN departamentos d ON d.id=gp.departamento_id
                LEFT JOIN provincias p ON d.id=p.departamento_id AND p.id=gp.provincia_id
                LEFT JOIN distritos di ON p.id=di.provincia_id AND di.id=gp.distrito_id
                WHERE a.estado=1";
        $sSql.= $array['where'];
        $oData = DB::select($sSql);
        return $oData[0]->cant;
    }

    public static function getCargarReniec( $array )
    {
        $sSql=" SELECT  r.id,r.paterno,r.materno,r.nombres,r.dni,
                f.paterno paternon,f.materno maternon,f.nombres nombresn
                FROM reniec r
                LEFT JOIN ficha di ON p.id=di.provincia_id AND di.id=gp.distrito_id
                WHERE a.estado=1
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
}
