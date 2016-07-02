<?php

class Grupo extends Base
{
    public $table = "grupos_personas";

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
                    'g.estado'
                )
                ->get();

        return $r;
    }

    public static function getListar()
    {
        $r =DB::table('tipo_grupos_personas as t')
                ->join('grupos_personas as g',
                    't.id','=','g.tipo_grupo_id'
                )
                ->select(
                    'g.id',
                    DB::raw('CONCAT(g.nombre," => ",t.nombre) nombre'),
                    't.nombre as grupo',
                    'g.tipo_grupo_id',
                    'g.estado'
                )
                ->where('g.estado','=','1')
                ->where('t.estado','=','1')
                ->get();

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
                    DB::raw('CONCAT(g.nombre," => ",t.nombre) nombre'),
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
                    'c.nombre'
                )
                ->where('c.estado','=','1')
                ->where('gc.estado','=','1')
                ->where('gc.grupo_persona_id','=',$array['grupo_persona_id'])
                ->get();

        return $r;
    }
}
