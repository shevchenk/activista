<?php

class Grupo extends Base
{
    public $table = "grupos_personas";

    public static function getCargarPECount( $array )
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

    public static function getCargarPE( $array )
    {
        $sSql=" SELECT  e.id,a.paterno,a.materno,a.nombres,a.dni,a.celular,ce.nombre cargo,e.fecha_inicio,
                gp.nombre equipo, d.nombre departamento, p.nombre provincia, di.nombre distrito,gp.localidad
                FROM activistas a
                INNER JOIN escalafon e ON e.activista_id=a.id AND e.fecha_final IS NULL 
                INNER JOIN grupos_personas gp ON gp.id=e.grupo_persona_id
                INNER JOIN cargos_estrategicos ce ON ce.id=e.cargo_estrategico_id
                LEFT JOIN departamentos d ON d.id=gp.departamento_id
                LEFT JOIN provincias p ON d.id=p.departamento_id AND p.id=gp.provincia_id
                LEFT JOIN distritos di ON p.id=di.provincia_id AND di.id=gp.distrito_id
                WHERE a.estado=1
                ";
        $sSql.= $array['where'].
                $array['order'].
                $array['limit'];
        $oData = DB::select($sSql);
        return $oData;
    }

    public static function getCargar()
    {
        $r =DB::table('tipo_grupos_personas as t')
                ->join('grupos_personas as g',
                    't.id','=','g.tipo_grupo_id'
                )
                ->leftJoin('departamentos as d',
                    'd.id','=','g.departamento_id'
                )
                ->leftJoin('provincias as p',
                    'p.id','=','g.provincia_id'
                )
                ->leftJoin('distritos as di',
                    'di.id','=','g.distrito_id'
                )
                ->select(
                    'g.id',
                    'g.nombre',
                    't.nombre as grupo',
                    'g.tipo_grupo_id',
                    'di.nombre as distrito',
                    'd.nombre as departamento',
                    'p.nombre as provincia',
                    'g.distrito_id',
                    'g.departamento_id',
                    'g.provincia_id',
                    'g.localidad',
                    'g.direccion',
                    'g.telefono',
                    'g.estado'
                )
                ->get();

        return $r;
    }

    public static function getListar()
    {
        $and="";
        if( Input::has('nuevo') ){
            $and=" AND gc.id IS NULL ";
        }
        $sql="  SELECT g.id, CONCAT(t.nombre,' => ',g.nombre) nombre, 
                t.nombre as grupo, g.tipo_grupo_id, g.estado 
                FROM tipo_grupos_personas as t 
                INNER JOIN grupos_personas as g on t.id = g.tipo_grupo_id 
                LEFT JOIN grupos_cargos as gc on gc.grupo_persona_id = g.id 
                WHERE g.estado = 1 
                AND t.estado = 1
                $and
                GROUP BY g.id";
        
        $r= DB::select($sql);

        return $r;
    }

    public static function getListarGrupoEscalafon()
    {
        $r =DB::table('tipo_grupos_personas as t')
                ->join('grupos_personas as g',
                    't.id','=','g.tipo_grupo_id'
                )
                ->join('grupos_cargos as gc',
                    'gc.grupo_persona_id','=','g.id'
                )
                ->select(
                    'g.id',
                    DB::raw('CONCAT(t.nombre," => ",g.nombre) nombre'),
                    't.nombre as grupo',
                    'g.tipo_grupo_id',
                    'g.estado'
                )
                ->where('g.estado','=','1')
                ->where('t.estado','=','1')
                ->where('gc.estado','=','1')
                ->groupBy('g.id')
                ->get();

        return $r;
    }

    public static function getListarCargoEscalafon($array)
    {
        $r =DB::table('cargos_estrategicos as c')
                ->join('grupos_cargos as gc',
                    'gc.cargo_estrategico_id','=','c.id'
                )
                ->select(
                    'c.id',
                    'c.nombre',
                    DB::raw('IF(c.nombre like "%Afiliado%",1,0) as dat')
                )
                ->where('c.estado','=','1')
                ->where('gc.estado','=','1')
                ->where('gc.grupo_persona_id','=',$array['grupo_persona_id'])
                ->get();

        return $r;
    }
}
