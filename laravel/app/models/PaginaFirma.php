<?php

class PaginaFirma extends Base
{
    public $table = "paginafirma";

    public static function PaginasPendientes($r)
    {
        $datos=PaginaFirma::where('estado','=','2')->get();

        $r['rst']='1';
        $r['msj']='Se listaron <b>'.count($datos).'</b> página(s)';
        $r['pentot']=$datos;
        return $r;
    }
    public static function PaginasPendientesDosCientos($r)
    {
        //$set=DB::select('SET GLOBAL group_concat_max_len = 2048');
        $sql="  SELECT min(id) inicio,if(id%200=0,id-id%200,id-id%200+200) fin, 
                max(id) maximo, GROUP_CONCAT( IF(estado=2,id,NULL) ) vacios
                FROM paginafirma
                GROUP BY fin";
        $datos=DB::select($sql);

        $r['pen200']=$datos;
        return $r;
    }

    public static function LimpiarNuevamente()
    {
        $sql="DELETE FROM paginafirma_copy";
        $sql2=" SET @numero=0";
        $sql3="  INSERT INTO paginafirma_copy (id,escalafon_id,estado,created_at)
                SELECT 
                @numero:=(@numero+1),0,2,'2017-03-04 00:00:00'
                FROM paginafirma"
        $sql4=" INSERT INTO paginafirma (id,escalafon_id,estado,created_at)
                SELECT 
                pfc.id,0,2,'2017-03-04 00:00:00'
                FROM paginafirma_copy pfc
                LEFT JOIN paginafirma pf ON pf.id=pfc.id
                WHERE pf.id IS NULL";

        $dd=DB::delete($sql);
        $dd=DB::select($sql2);
        $dd=DB::insert($sql3);
        $dd=DB::insert($sql4);
    }
}
