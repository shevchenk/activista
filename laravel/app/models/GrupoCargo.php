<?php

class GrupoCargo extends Base
{
    public $table = "grupos_cargos";

    public static function getCargar()
    {
        //subconsulta
        $sql = "SELECT cg.id, g.nombre grupo, GROUP_CONCAT(c.nombre SEPARATOR '<br>') cargo,
                cg.fecha_inicio,cg.estado,CONCAT(g.nombre,' | ',c.nombre) nombre,
                cg.grupo_persona_id,GROUP_CONCAT(cg.cargo_estrategico_id) cargo_estrategico_id
                FROM grupos_cargos cg 
                INNER JOIN grupos_personas g ON g.id=cg.grupo_persona_id
                INNER JOIN cargos_estrategicos c ON c.id=cg.cargo_estrategico_id 
                WHERE cg.estado=1
                GROUP BY cg.grupo_persona_id
                ";
        $r=DB::select($sql);

        return $r;

    }

    public static function getValidar($array)
    {
        //subconsulta
        $sql = "SELECT count(id) cant
                FROM grupos_cargos 
                WHERE grupo_persona_id='".$array['grupo_persona_id']."'
                AND cargo_estrategico_id='".$array['cargo_estrategico_id']."'
                ";
        if( isset($array['id']) ){
            $sql.=" AND id!='".$array['id']."'";
        }
        $r=DB::select($sql);

        return $r[0]->cant;

    }
}
