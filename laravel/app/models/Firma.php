<?php

class Firma extends Base
{
    public $table = "firmas";

    public static function ValidaFicha($ficha)
    {
        $sql="  SELECT COUNT(id) cant 
                FROM firmas
                WHERE ficha=".$ficha;
        $r=DB::select($sql);

        return $r[0]->cant;
    }

    public static function ValidaFirma($dni)
    {
        $sql="  SELECT GROUP_CONCAT(id) ids 
                FROM firmas
                WHERE dni='".$dni."'";
        $r=DB::select($sql);

        return $r;
    }

    public static function CargarFichaPagina($array)
    {
        $sql="  SELECT f.fila,f.ficha,f.dni,f.paterno,f.materno,f.nombre,
                CONCAT(a.paterno,' ',a.materno,', ',a.nombres) recolector,
                f.conteo,f.pagina_firma_id pagina,f.valida,
                IF( f.estado_firma<>'',
                    MostrarExistentes(f.estado_firma),''
                ) rst
                FROM firmas f
                INNER JOIN escalafon_fichas ef ON ef.desdeh=f.pagina_firma_id
                INNER JOIN escalafon e ON e.id=ef.escalafon_id
                INNER JOIN activistas a ON a.id=e.activista_id
                WHERE f.estado=1
             ".$array['w'];
        $r=DB::select($sql);

        return $r;
    }
}
