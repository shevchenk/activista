<?php

class ReporteController extends BaseController
{
    public function postPornivel()
    {
        $id= Input::get('persona');
        $nivel= Input::get('nivel');
        $niveles= array(0,0,0,0,0,0,0,0,0,0);
        $paginas= array(0,0,0,0,0,0,0,0,0,0);
        $color=array('','#A4A4A4','#4BD1E0','#9B1E31','#45298F','#EFEFA2','#D3FFFF','#FF99FF','#D7F336','#8DB4E2');
        $colort=array('','#F0F0F0','#F0F0F0','#F0F0F0','#F0F0F0','#000000','#000000','#000000','#000000','#F0F0F0');
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
                AND a.estado=1
                GROUP BY a.id ";

        $r=DB::select($sql);
        $ids=array();
        $html="";
        $nivelanidado="N".$id;
            foreach ($r as $key => $value) {
                $html.="<tr style='background-color: ".$color[$value->nivel_id].";color: ".$colort[$value->nivel_id].";'>";
                    $html.="<td>".$value->nombre."</td>";
                    $html.="<td>".$value->paterno."</td>";
                    $html.="<td>".$value->materno."</td>";
                    $html.="<td>".$value->nombres."</td>";
                    $html.="<td>".$value->cant."</td>";
                $html.="</tr>";
                $niveles[$value->nivel_id]++;
                $paginas[$value->nivel_id]+=$value->cant;
                //array_push($ids,$value->id);
                $id=$value->id;
                $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                c.nombre, count(g.id) cant,a.nivel_id
                        FROM activistas a
                        INNER JOIN cargos c ON a.nivel_id=c.id
                        LEFT JOIN grupos g ON a.id= g.activista_id
                        WHERE a.lider_padre = $id 
                        AND a.estado=1
                        GROUP BY a.id ";
                $r2=DB::select($sql);

                foreach ($r2 as $key2 => $value2) {
                    $html.="<tr style='background-color: ".$color[$value2->nivel_id].";color: ".$colort[$value2->nivel_id].";'>";
                        $html.="<td>".$value2->nombre."</td>";
                        $html.="<td>".$value2->paterno."</td>";
                        $html.="<td>".$value2->materno."</td>";
                        $html.="<td>".$value2->nombres."</td>";
                        $html.="<td>".$value2->cant."</td>";
                    $html.="</tr>";
                    $niveles[$value2->nivel_id]++;
                    $paginas[$value2->nivel_id]+=$value2->cant;

                    $id=$value2->id;
                    $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                    c.nombre, count(g.id) cant,a.nivel_id
                            FROM activistas a
                            INNER JOIN cargos c ON a.nivel_id=c.id
                            LEFT JOIN grupos g ON a.id= g.activista_id
                            WHERE a.lider_padre = $id 
                            AND a.estado=1
                            GROUP BY a.id ";
                    $r3=DB::select($sql);

                    foreach ($r3 as $key3 => $value3) {
                        $html.="<tr style='background-color: ".$color[$value3->nivel_id].";color: ".$colort[$value3->nivel_id].";'>";
                            $html.="<td>".$value3->nombre."</td>";
                            $html.="<td>".$value3->paterno."</td>";
                            $html.="<td>".$value3->materno."</td>";
                            $html.="<td>".$value3->nombres."</td>";
                            $html.="<td>".$value3->cant."</td>";
                        $html.="</tr>";
                        $niveles[$value3->nivel_id]++;
                        $paginas[$value3->nivel_id]+=$value3->cant;

                        $id=$value3->id;
                        $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                        c.nombre, count(g.id) cant,a.nivel_id
                                FROM activistas a
                                INNER JOIN cargos c ON a.nivel_id=c.id
                                LEFT JOIN grupos g ON a.id= g.activista_id
                                WHERE a.lider_padre = $id 
                                AND a.estado=1
                                GROUP BY a.id ";
                        $r4=DB::select($sql);

                        foreach ($r4 as $key4 => $value4) {
                            $html.="<tr style='background-color: ".$color[$value4->nivel_id].";color: ".$colort[$value4->nivel_id].";'>";
                                $html.="<td>".$value4->nombre."</td>";
                                $html.="<td>".$value4->paterno."</td>";
                                $html.="<td>".$value4->materno."</td>";
                                $html.="<td>".$value4->nombres."</td>";
                                $html.="<td>".$value4->cant."</td>";
                            $html.="</tr>";
                            $niveles[$value4->nivel_id]++;
                            $paginas[$value4->nivel_id]+=$value4->cant;

                            $id=$value4->id;
                            $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                            c.nombre, count(g.id) cant,a.nivel_id
                                    FROM activistas a
                                    INNER JOIN cargos c ON a.nivel_id=c.id
                                    LEFT JOIN grupos g ON a.id= g.activista_id
                                    WHERE a.lider_padre = $id 
                                    AND a.estado=1
                                    GROUP BY a.id ";
                            $r5=DB::select($sql);

                            foreach ($r5 as $key5 => $value5) {
                                $html.="<tr style='background-color: ".$color[$value5->nivel_id].";color: ".$colort[$value5->nivel_id].";'>";
                                    $html.="<td>".$value5->nombre."</td>";
                                    $html.="<td>".$value5->paterno."</td>";
                                    $html.="<td>".$value5->materno."</td>";
                                    $html.="<td>".$value5->nombres."</td>";
                                    $html.="<td>".$value5->cant."</td>";
                                $html.="</tr>";
                                $niveles[$value5->nivel_id]++;
                                $paginas[$value5->nivel_id]+=$value5->cant;

                                $id=$value5->id;
                                $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                                c.nombre, count(g.id) cant,a.nivel_id
                                        FROM activistas a
                                        INNER JOIN cargos c ON a.nivel_id=c.id
                                        LEFT JOIN grupos g ON a.id= g.activista_id
                                        WHERE a.lider_padre = $id 
                                        AND a.estado=1
                                        GROUP BY a.id ";
                                $r6=DB::select($sql);

                                foreach ($r6 as $key6 => $value6) {
                                    $html.="<tr style='background-color: ".$color[$value6->nivel_id].";color: ".$colort[$value6->nivel_id].";'>";
                                        $html.="<td>".$value6->nombre."</td>";
                                        $html.="<td>".$value6->paterno."</td>";
                                        $html.="<td>".$value6->materno."</td>";
                                        $html.="<td>".$value6->nombres."</td>";
                                        $html.="<td>".$value6->cant."</td>";
                                    $html.="</tr>";
                                    $niveles[$value6->nivel_id]++;
                                    $paginas[$value6->nivel_id]+=$value6->cant;

                                    $id=$value6->id;
                                    $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                                    c.nombre, count(g.id) cant,a.nivel_id
                                            FROM activistas a
                                            INNER JOIN cargos c ON a.nivel_id=c.id
                                            LEFT JOIN grupos g ON a.id= g.activista_id
                                            WHERE a.lider_padre = $id 
                                            AND a.estado=1
                                            GROUP BY a.id ";
                                    $r7=DB::select($sql);

                                    foreach ($r7 as $key7 => $value7) {
                                        $html.="<tr style='background-color: ".$color[$value7->nivel_id].";color: ".$colort[$value7->nivel_id].";'>";
                                            $html.="<td>".$value7->nombre."</td>";
                                            $html.="<td>".$value7->paterno."</td>";
                                            $html.="<td>".$value7->materno."</td>";
                                            $html.="<td>".$value7->nombres."</td>";
                                            $html.="<td>".$value7->cant."</td>";
                                        $html.="</tr>";
                                        $niveles[$value7->nivel_id]++;
                                        $paginas[$value7->nivel_id]+=$value7->cant;

                                        $id=$value7->id;
                                        $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                                        c.nombre, count(g.id) cant,a.nivel_id
                                                FROM activistas a
                                                INNER JOIN cargos c ON a.nivel_id=c.id
                                                LEFT JOIN grupos g ON a.id= g.activista_id
                                                WHERE a.lider_padre = $id 
                                                AND a.estado=1
                                                GROUP BY a.id ";
                                        $r8=DB::select($sql);

                                        foreach ($r8 as $key8 => $value8) {
                                            $html.="<tr style='background-color: ".$color[$value8->nivel_id].";color: ".$colort[$value8->nivel_id].";'>";
                                                $html.="<td>".$value8->nombre."</td>";
                                                $html.="<td>".$value8->paterno."</td>";
                                                $html.="<td>".$value8->materno."</td>";
                                                $html.="<td>".$value8->nombres."</td>";
                                                $html.="<td>".$value8->cant."</td>";
                                            $html.="</tr>";
                                            $niveles[$value8->nivel_id]++;
                                            $paginas[$value8->nivel_id]+=$value8->cant;

                                            $id=$value8->id;
                                            $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                                            c.nombre, count(g.id) cant,a.nivel_id
                                                    FROM activistas a
                                                    INNER JOIN cargos c ON a.nivel_id=c.id
                                                    LEFT JOIN grupos g ON a.id= g.activista_id
                                                    WHERE a.lider_padre = $id 
                                                    AND a.estado=1
                                                    GROUP BY a.id ";
                                            $r9=DB::select($sql);

                                            foreach ($r9 as $key9 => $value9) {
                                                $html.="<tr style='background-color: ".$color[$value9->nivel_id].";color: ".$colort[$value9->nivel_id].";'>";
                                                    $html.="<td>".$value9->nombre."</td>";
                                                    $html.="<td>".$value9->paterno."</td>";
                                                    $html.="<td>".$value9->materno."</td>";
                                                    $html.="<td>".$value9->nombres."</td>";
                                                    $html.="<td>".$value9->cant."</td>";
                                                $html.="</tr>";
                                                $niveles[$value9->nivel_id]++;
                                                $paginas[$value9->nivel_id]+=$value9->cant;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

        /*$nivel++;
            while($nivel<10 and count($ids)>0 ){
                $idsd= implode(',',$ids);
                $ids=array();
                $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                c.nombre, count(g.id) cant,a.nivel_id
                        FROM activistas a
                        INNER JOIN cargos c ON a.nivel_id=c.id
                        LEFT JOIN grupos g ON a.id= g.activista_id
                        WHERE a.lider_padre IN ($idsd) 
                        AND a.estado=1
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
            }*/

        return Response::json(
            array(  'datos'=> $html,
                    'niveles' => $niveles,
                    'paginas'=> $paginas,
                    'cargos' => $cargos,
                    'fondo'=>$color,
                    'texto'=>$colort
            )
        );
    }
}
