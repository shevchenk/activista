<?php

class Operador extends Base
{
    public $table = "activistas";
    /**
     * Opciones relationship
     */
    public static function getListar()
    {
        $sql="  SELECT a.id,CONCAT(a.paterno,' ',a.materno,', ',a.nombres) nombre
                FROM firmas f
                INNER JOIN escalafon_fichas ef ON ef.desdeh=f.pagina_firma_id
                INNER JOIN escalafon e ON e.id=ef.escalafon_id
                INNER JOIN activistas a ON a.id=e.activista_id
                WHERE f.estado=1
                GROUP BY a.id";
        $r=DB::select($sql);
        return $r;
    }

}
