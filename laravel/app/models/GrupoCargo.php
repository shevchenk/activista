<?php

class GrupoCargo extends Base
{
    public $table = "grupos_cargos";

    public static function getCargar()
    {
        //subconsulta
        $sql = "SELECT cg.id, g.nombre grupo, c.nombre cargo,
                cg.fecha_inicio,cg.estado,CONCAT(g.nombre,' | ',c.nombre) nombre
                FROM grupos_cargos cg 
                INNER JOIN grupos_personas g ON g.id=cg.grupo_persona_id
                INNER JOIN cargos_estrategicos c ON c.id=cg.cargo_estrategico_id
                ";
        $r=DB::select($sql);

        return $r;

    }
}
