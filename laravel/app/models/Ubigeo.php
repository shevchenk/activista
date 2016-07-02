<?php

class Ubigeo extends Base
{
    public $table = "";

    public static function getCargarRegion()
    {
        $sql =" SELECT id, nombre
                FROM departamentos
                ";
        $r=DB::select($sql);
        return $r;
    }

    public static function getCargarProvincia($array)
    {
        $sql =" SELECT id, nombre
                FROM provincias
                Where 1=1  "
                .$array['w'];
        $r=DB::select($sql);
        return $r;
    }

    public static function getCargarDistrito($array)
    {
        $sql =" SELECT id, nombre
                FROM distritos
                Where 1=1  "
                .$array['w'];
        $r=DB::select($sql);
        return $r;
    }
    
}
