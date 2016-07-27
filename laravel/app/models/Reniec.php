<?php

class Reniec extends Base
{
    public $table = "reniec";

    public static function getPersona( $dni )
    {
        $sSql=" SELECT  id, paterno, materno, nombres, ficha_id, dni
                FROM reniec 
                WHERE estado=1
                AND dni='".$dni."'";
        $oData = DB::select($sSql);
        return $oData;
    }
}
