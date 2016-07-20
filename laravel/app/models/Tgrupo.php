<?php

class Tgrupo extends Base
{
    public $table = "tipo_grupos_personas";

    public static function getTgrupo()
    {
        $r =DB::table('tipo_grupos_personas')
                ->select(
                    'id',
                    'nombre',
                    'ubigeo',
                    'estado'
                )
                ->get();

        return $r;
    }

    public static function getListar()
    {
        $r =DB::table('tipo_grupos_personas')
                ->select(
                    'id',
                    'nombre',
                    'ubigeo',
                    'ubigeo as dat',
                    'estado'
                )
                ->where('estado','=',1)
                ->get();

        return $r;
    }

    
}
