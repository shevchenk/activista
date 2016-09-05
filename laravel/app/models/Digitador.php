<?php

class Digitador extends Base
{
    public $table = "activistas";
    /**
     * Opciones relationship
     */
    public static function getListar()
    {
        $sql="  SELECT a.id,CONCAT(a.paterno,' ',a.materno,', ',a.nombres) nombre
                FROM firmas f
                INNER JOIN activistas a ON a.id=f.usuario_created_at
                WHERE f.estado=1
                GROUP BY a.id";
        $r=DB::select($sql);
        return $r;
    }

}
