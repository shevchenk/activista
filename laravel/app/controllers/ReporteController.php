<?php

class ReporteController extends BaseController
{
    public function postPornivel()
    {
        $id= Input::get('persona');
        $nivel= Input::get('nivel');
        $niveles= array(0,0,0,0,0,0,0,0,0,0);
        $paginas= array(0,0,0,0,0,0,0,0,0,0);
        $cargos=array();
        $cargos[0]="";
        $cargos[1]="Lider Nacional";
        $cargos[2]="Lider Regional";
        $cargos[3]="Lider Provincial";
        $cargos[4]="Lider Distrital";
        $cargos[5]="Lider Zonal";
        $cargos[6]="Lider Operativo";
        $cargos[7]="Activista";
        $cargos[8]="Seguidor";
        $cargos[9]="Simpatizante";

        $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                        c.nombre, count(g.id) cant,a.nivel_id
                FROM activistas a
                INNER JOIN cargos c ON a.nivel_id=c.id
                LEFT JOIN grupos g ON a.id= g.activista_id
                WHERE a.lider_padre = $id
                GROUP BY a.id ";

        $r=DB::select($sql);
        $ids=array();
        $html="";
            foreach ($r as $key => $value) {
                $html.="<tr>";
                    $html.="<td>".$value->nombre."</td>";
                    $html.="<td>".$value->paterno."</td>";
                    $html.="<td>".$value->materno."</td>";
                    $html.="<td>".$value->nombres."</td>";
                    $html.="<td>".$value->cant."</td>";
                $html.="</tr>";
                $niveles[$value->nivel_id]++;
                $paginas[$value->nivel_id]+=$value->cant;
                array_push($ids,$value->id);
            }

        $nivel++;
            while($nivel<10 and count($ids)>0 ){
                $idsd= implode(',',$ids);
                $ids=array();
                $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                c.nombre, count(g.id) cant,a.nivel_id
                        FROM activistas a
                        INNER JOIN cargos c ON a.nivel_id=c.id
                        LEFT JOIN grupos g ON a.id= g.activista_id
                        WHERE a.lider_padre IN ($idsd) 
                        GROUP BY a.id ";
                $r=DB::select($sql);

                foreach ($r as $key => $value) {
                    $html.="<tr>";
                        $html.="<td>".$value->nombre."</td>";
                        $html.="<td>".$value->paterno."</td>";
                        $html.="<td>".$value->materno."</td>";
                        $html.="<td>".$value->nombres."</td>";
                        $html.="<td>".$value->cant."</td>";
                    $html.="</tr>";
                    $niveles[$value->nivel_id]++;
                    $paginas[$value->nivel_id]+=$value->cant;
                    array_push($ids,$value->id);
                }
                $nivel++;
            }

        return Response::json(
            array(  'datos'=> $html,
                    'niveles' => $niveles,
                    'paginas'=> $paginas,
                    'cargos' => $cargos
            )
        );
    }
}
