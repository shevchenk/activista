<?php

class ReporteController extends BaseController
{
    private $userID;
    private $userNivelId;

    /**
     * Constructor de la clase
     *
     */
    public function __construct()
    {
        $this->beforeFilter('auth'); // bloqueo de acceso
        $this->userID = Auth::user()->id;
        $this->userNivelId = Auth::user()->nivel_id;
    }

    public function postExportaemail()
    {
        $data=Input::all();

        $az=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ');
        $azcount=array(5,17,17,17,12,12,23,12,12,15,17,18,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15);

        $styleThinBlackBorderAllborders = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
            ),
        );
        $styleAlignmentBold= array(
            'font'    => array(
                'bold'      => true
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
        );
        $styleAlignment= array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
        );

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Jorge Salcedo")
                                     ->setLastModifiedBy("Jorge Salcedo")
                                     ->setTitle("Office 2007 XLSX Test Document")
                                     ->setSubject("Office 2007 XLSX Test Document")
                                     ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                                     ->setKeywords("office 2007 openxml php")
                                     ->setCategory("Test result file");

        $objPHPExcel->getDefaultStyle()->getFont()->setName('Bookman Old Style');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(8);

        $objPHPExcel->getActiveSheet()->setCellValue("A2","Listado de Emails");
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(20);

        $cabecera=array('N°','NIVEL','PATERNO','MATERNO','NOMBRE','DNI','TELEFONO','EMAIL','ESTADO EMAIL','ESTADO CEL');

        $objPHPExcel->getActiveSheet()->mergeCells('A2:'.$az[(count($cabecera)-1)].'2');
        $objPHPExcel->getActiveSheet()->getStyle('A2:'.$az[(count($cabecera)-1)].'2')->applyFromArray($styleAlignmentBold);

            for($i=0;$i<count($cabecera);$i++){
            $objPHPExcel->getActiveSheet()->setCellValue($az[$i]."3",$cabecera[$i]);
            $objPHPExcel->getActiveSheet()->getStyle($az[$i]."3")->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension($az[$i])->setWidth($azcount[$i]);
            }
        $objPHPExcel->getActiveSheet()->getStyle('A3:'.$az[($i-1)].'3')->applyFromArray($styleAlignmentBold);
        $objPHPExcel->getActiveSheet()->getStyle("A3:".$az[($i-1)]."3")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFCCCCCC');

        $activistaids= implode(",",$data['idpersonas']);
        $sql="  SELECT a.id,a.paterno,a.materno,a.nombres,a.dni,a.email,a.celular,c.nombre nivel, ifnull(m.email,'') memail,ifnull(m.nrollamada,'') mcel
                FROM activistas a
                INNER JOIN cargos c ON c.id=a.nivel_id
                LEFT JOIN mensajerias m ON m.activista_id=a.id 
                WHERE a.id IN (".$activistaids.")";
        $control=DB::select($sql);
        $cont=0;
        $valorinicial=3;
        $azcant=0;

        foreach($control as $r){ 
        $cont++;
        $valorinicial++;
        $azcant=0;
        $objPHPExcel->getActiveSheet()->setCellValue($az[$azcant].$valorinicial,$cont);$azcant++;
        $objPHPExcel->getActiveSheet()->setCellValue($az[$azcant].$valorinicial,$r->nivel);$azcant++;
        $objPHPExcel->getActiveSheet()->setCellValue($az[$azcant].$valorinicial,$r->paterno);$azcant++;
        $objPHPExcel->getActiveSheet()->setCellValue($az[$azcant].$valorinicial,$r->materno);$azcant++;
        $objPHPExcel->getActiveSheet()->setCellValue($az[$azcant].$valorinicial,$r->nombres);$azcant++;
        $objPHPExcel->getActiveSheet()->setCellValue($az[$azcant].$valorinicial,$r->dni);$azcant++;
        $objPHPExcel->getActiveSheet()->setCellValue($az[$azcant].$valorinicial,$r->celular);$azcant++;
        $objPHPExcel->getActiveSheet()->setCellValue($az[$azcant].$valorinicial,$r->email);$azcant++;
            if( $r->memail!='' ){
                $objPHPExcel->getActiveSheet()->setCellValue($az[$azcant].$valorinicial,"Enviado");
            }
            elseif( isset( $data['personas'] ) AND in_array('email_'.$r->id.'_1', $data['personas']) ){
                $objPHPExcel->getActiveSheet()->setCellValue($az[$azcant].$valorinicial,"Seleccionado");
            }
            $azcant++;

            if( $r->mcel!='' ){
                $objPHPExcel->getActiveSheet()->setCellValue($az[$azcant].$valorinicial,"Enviado");
            }
            elseif( isset( $data['personas'] ) AND (
                    in_array('celular_'.$r->id.'_1', $data['personas']) OR in_array('celular_'.$r->id.'_2', $data['personas']) OR
                    in_array('celular_'.$r->id.'_3', $data['personas']) OR in_array('celular_'.$r->id.'_4', $data['personas']) OR
                    in_array('celular_'.$r->id.'_5', $data['personas']) OR in_array('celular_'.$r->id.'_6', $data['personas'])
                    )
            ){
                $objPHPExcel->getActiveSheet()->setCellValue($az[$azcant].$valorinicial,"Seleccionado");
            }
        }
        $objPHPExcel->getActiveSheet()->getStyle('A2:'.$az[$azcant].$valorinicial)->applyFromArray($styleThinBlackBorderAllborders);
        $objPHPExcel->getActiveSheet()->setTitle('Listado');
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Listado_'.date("Y-m-d_H-i-s").'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;

    }

    public function postPornivelgrupo()
    {
        $grupo_persona_id= Input::get('grupo');
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
                        c.nombre, count(g.id) cant,a.nivel_id,
                        a.dni,a.celular,a.email
                FROM activistas a
                INNER JOIN cargos c ON a.nivel_id=c.id
                INNER JOIN escalafon e ON e.activista_id=a.id AND e.fecha_final IS NULL AND e.grupo_persona_id = $grupo_persona_id
                LEFT JOIN grupos g ON a.id= g.activista_id
                WHERE a.estado=1
                GROUP BY a.id ";

        $r=DB::select($sql);
        $ids=array();
        $html="";
        //$nivelanidado="N".$id;
            foreach ($r as $key => $value) {
                $html.="<tr style='background-color: ".$color[$value->nivel_id].";color: ".$colort[$value->nivel_id].";'>";
                    $html.="<td>".$value->nombre."</td>";
                    $html.="<td>".$value->paterno."</td>";
                    $html.="<td>".$value->materno."</td>";
                    $html.="<td>".$value->nombres."</td>";
                    $html.="<td>".$value->dni."</td>";
                    $html.="<td>".$value->email."</td>";
                    $html.="<td>".$value->celular."</td>";
                    $html.="<td>".$value->cant."</td>";
                $html.="</tr>";
                $niveles[$value->nivel_id]++;
                $paginas[$value->nivel_id]+=$value->cant;
                //array_push($ids,$value->id);
                $id=$value->id;
                $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                c.nombre, count(g.id) cant,a.nivel_id,
                                a.dni,a.celular,a.email
                        FROM activistas a
                        INNER JOIN cargos c ON a.nivel_id=c.id
                        INNER JOIN escalafon e ON e.activista_id=a.id AND e.fecha_final IS NULL AND e.grupo_persona_id = $grupo_persona_id
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
                        $html.="<td>".$value2->dni."</td>";
                        $html.="<td>".$value2->email."</td>";
                        $html.="<td>".$value2->celular."</td>";
                        $html.="<td>".$value2->cant."</td>";
                    $html.="</tr>";
                    $niveles[$value2->nivel_id]++;
                    $paginas[$value2->nivel_id]+=$value2->cant;

                    $id=$value2->id;
                    $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                    c.nombre, count(g.id) cant,a.nivel_id,
                                    a.dni,a.celular,a.email
                            FROM activistas a
                            INNER JOIN cargos c ON a.nivel_id=c.id
                            INNER JOIN escalafon e ON e.activista_id=a.id AND e.fecha_final IS NULL AND e.grupo_persona_id = $grupo_persona_id
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
                            $html.="<td>".$value3->dni."</td>";
                            $html.="<td>".$value3->email."</td>";
                            $html.="<td>".$value3->celular."</td>";
                            $html.="<td>".$value3->cant."</td>";
                        $html.="</tr>";
                        $niveles[$value3->nivel_id]++;
                        $paginas[$value3->nivel_id]+=$value3->cant;

                        $id=$value3->id;
                        $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                        c.nombre, count(g.id) cant,a.nivel_id,
                                        a.dni,a.celular,a.email
                                FROM activistas a
                                INNER JOIN cargos c ON a.nivel_id=c.id
                                INNER JOIN escalafon e ON e.activista_id=a.id AND e.fecha_final IS NULL AND e.grupo_persona_id = $grupo_persona_id
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
                                $html.="<td>".$value4->dni."</td>";
                                $html.="<td>".$value4->email."</td>";
                                $html.="<td>".$value4->celular."</td>";
                                $html.="<td>".$value4->cant."</td>";
                            $html.="</tr>";
                            $niveles[$value4->nivel_id]++;
                            $paginas[$value4->nivel_id]+=$value4->cant;

                            $id=$value4->id;
                            $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                            c.nombre, count(g.id) cant,a.nivel_id,
                                            a.dni,a.celular,a.email
                                    FROM activistas a
                                    INNER JOIN cargos c ON a.nivel_id=c.id
                                    INNER JOIN escalafon e ON e.activista_id=a.id AND e.fecha_final IS NULL AND e.grupo_persona_id = $grupo_persona_id
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
                                    $html.="<td>".$value5->dni."</td>";
                                    $html.="<td>".$value5->email."</td>";
                                    $html.="<td>".$value5->celular."</td>";
                                    $html.="<td>".$value5->cant."</td>";
                                $html.="</tr>";
                                $niveles[$value5->nivel_id]++;
                                $paginas[$value5->nivel_id]+=$value5->cant;

                                $id=$value5->id;
                                $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                                c.nombre, count(g.id) cant,a.nivel_id,
                                                a.dni,a.celular,a.email
                                        FROM activistas a
                                        INNER JOIN cargos c ON a.nivel_id=c.id
                                        INNER JOIN escalafon e ON e.activista_id=a.id AND e.fecha_final IS NULL AND e.grupo_persona_id = $grupo_persona_id
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
                                        $html.="<td>".$value6->dni."</td>";
                                        $html.="<td>".$value6->email."</td>";
                                        $html.="<td>".$value6->celular."</td>";
                                        $html.="<td>".$value6->cant."</td>";
                                    $html.="</tr>";
                                    $niveles[$value6->nivel_id]++;
                                    $paginas[$value6->nivel_id]+=$value6->cant;

                                    $id=$value6->id;
                                    $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                                    c.nombre, count(g.id) cant,a.nivel_id,
                                                    a.dni,a.celular,a.email
                                            FROM activistas a
                                            INNER JOIN cargos c ON a.nivel_id=c.id
                                            INNER JOIN escalafon e ON e.activista_id=a.id AND e.fecha_final IS NULL AND e.grupo_persona_id = $grupo_persona_id
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
                                            $html.="<td>".$value7->dni."</td>";
                                            $html.="<td>".$value7->email."</td>";
                                            $html.="<td>".$value7->celular."</td>";
                                            $html.="<td>".$value7->cant."</td>";
                                        $html.="</tr>";
                                        $niveles[$value7->nivel_id]++;
                                        $paginas[$value7->nivel_id]+=$value7->cant;

                                        $id=$value7->id;
                                        $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                                        c.nombre, count(g.id) cant,a.nivel_id,
                                                        a.dni,a.celular,a.email
                                                FROM activistas a
                                                INNER JOIN cargos c ON a.nivel_id=c.id
                                                INNER JOIN escalafon e ON e.activista_id=a.id AND e.fecha_final IS NULL AND e.grupo_persona_id = $grupo_persona_id
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
                                                $html.="<td>".$value8->dni."</td>";
                                                $html.="<td>".$value8->email."</td>";
                                                $html.="<td>".$value8->celular."</td>";
                                                $html.="<td>".$value8->cant."</td>";
                                            $html.="</tr>";
                                            $niveles[$value8->nivel_id]++;
                                            $paginas[$value8->nivel_id]+=$value8->cant;

                                            $id=$value8->id;
                                            $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                                            c.nombre, count(g.id) cant,a.nivel_id,
                                                            a.dni,a.celular,a.email
                                                    FROM activistas a
                                                    INNER JOIN cargos c ON a.nivel_id=c.id
                                                    INNER JOIN escalafon e ON e.activista_id=a.id AND e.fecha_final IS NULL AND e.grupo_persona_id = $grupo_persona_id
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
                                                    $html.="<td>".$value9->dni."</td>";
                                                    $html.="<td>".$value9->email."</td>";
                                                    $html.="<td>".$value9->celular."</td>";
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

    public function postPornivel()
    {
        $id= $this->userID;
        $nivel= $this->userNivelId;
        if( Input::has('persona') ){
            $id= Input::get('persona');
            $nivel= Input::get('nivel');
        }
        $niveles= array(0,0,0,0,0,0,0,0,0,0);
        $paginas= array(0,0,0,0,0,0,0,0,0,0);
        $color=array('','#A4A4A4','#4BD1E0','#9B1E31','#45298F','#EFEFA2','#D3FFFF','#FF99FF','#D7F336','#8DB4E2','#A4A4A4','#A4A4A4','#A4A4A4');
        $colort=array('','#F0F0F0','#F0F0F0','#F0F0F0','#F0F0F0','#000000','#000000','#000000','#000000','#F0F0F0','#F0F0F0','#F0F0F0','#F0F0F0');
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
                        c.nombre, count(g.id) cant,a.nivel_id,
                        a.dni,a.celular,a.email
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
                if( Input::has('persona') ){
                    $html.="<tr style='background-color: ".$color[$value->nivel_id].";color: ".$colort[$value->nivel_id].";'>";
                }
                else{
                    $html.="<tr id='tr_".$value->id."'>";
                }
                    $html.="<td>".$value->nombre."</td>";
                    $html.="<td>".$value->paterno."</td>";
                    $html.="<td>".$value->materno."</td>";
                    $html.="<td>".$value->nombres."</td>";
                    $html.="<td>".$value->dni."</td>";
                    if( Input::has('persona') ){
                        $html.="<td>".$value->email."</td>";
                        $html.="<td>".$value->celular."</td>";
                    }
                    else{
                        $html.="<td><input type='text' class='form-control' onKeyPress='AutoCheck(".$value->id.");' value='".$value->email."' name='txt_email_".$value->id."' id='txt_email_".$value->id."'></td>";
                        $html.="<td><input type='text' class='form-control' onKeyPress='AutoCheck(".$value->id.");' value='".$value->celular."' name='txt_celular_".$value->id."' id='txt_celular_".$value->id."'></td>";
                    }

                    if( Input::has('persona') ){
                        $html.="<td>".$value->cant."</td>";
                    }
                    else{
                        $html.="<td><input type='checkbox' name='persona[]' value='".$value->id."'></td>";
                    }
                    
                $html.="</tr>";
                $niveles[$value->nivel_id]++;
                $paginas[$value->nivel_id]+=$value->cant;
                //array_push($ids,$value->id);
                $id=$value->id;
                $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                c.nombre, count(g.id) cant,a.nivel_id,
                                a.dni,a.celular,a.email
                        FROM activistas a
                        INNER JOIN cargos c ON a.nivel_id=c.id
                        LEFT JOIN grupos g ON a.id= g.activista_id
                        WHERE a.lider_padre = $id 
                        AND a.estado=1
                        GROUP BY a.id ";
                $r2=DB::select($sql);

                foreach ($r2 as $key2 => $value2) {
                    if( Input::has('persona') ){
                        $html.="<tr style='background-color: ".$color[$value2->nivel_id].";color: ".$colort[$value2->nivel_id].";'>";
                    }
                    else{
                        $html.="<tr id='tr_".$value2->id."'>";
                    }
                        $html.="<td>".$value2->nombre."</td>";
                        $html.="<td>".$value2->paterno."</td>";
                        $html.="<td>".$value2->materno."</td>";
                        $html.="<td>".$value2->nombres."</td>";
                        $html.="<td>".$value2->dni."</td>";
                        if( Input::has('persona') ){
                            $html.="<td>".$value2->email."</td>";
                            $html.="<td>".$value2->celular."</td>";
                        }
                        else{
                            $html.="<td><input type='text' class='form-control' onKeyPress='AutoCheck(".$value2->id.");' value='".$value2->email."' name='txt_email_".$value2->id."' id='txt_email_".$value2->id."'></td>";
                            $html.="<td><input type='text' class='form-control' onKeyPress='AutoCheck(".$value2->id.");' value='".$value2->celular."' name='txt_celular_".$value2->id."' id='txt_celular_".$value2->id."'></td>";
                        }

                        if( Input::has('persona') ){
                            $html.="<td>".$value2->cant."</td>";
                        }
                        else{
                            $html.="<td><input type='checkbox' name='persona[]' value='".$value2->id."'></td>";
                        }
                    $html.="</tr>";
                    $niveles[$value2->nivel_id]++;
                    $paginas[$value2->nivel_id]+=$value2->cant;

                    $id=$value2->id;
                    $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                    c.nombre, count(g.id) cant,a.nivel_id,
                                    a.dni,a.celular,a.email
                            FROM activistas a
                            INNER JOIN cargos c ON a.nivel_id=c.id
                            LEFT JOIN grupos g ON a.id= g.activista_id
                            WHERE a.lider_padre = $id 
                            AND a.estado=1
                            GROUP BY a.id ";
                    $r3=DB::select($sql);

                    foreach ($r3 as $key3 => $value3) {
                        if( Input::has('persona') ){
                            $html.="<tr style='background-color: ".$color[$value3->nivel_id].";color: ".$colort[$value3->nivel_id].";'>";
                        }
                        else{
                            $html.="<tr id='tr_".$value3->id."'>";
                        }
                            $html.="<td>".$value3->nombre."</td>";
                            $html.="<td>".$value3->paterno."</td>";
                            $html.="<td>".$value3->materno."</td>";
                            $html.="<td>".$value3->nombres."</td>";
                            $html.="<td>".$value3->dni."</td>";
                            if( Input::has('persona') ){
                                $html.="<td>".$value3->email."</td>";
                                $html.="<td>".$value3->celular."</td>";
                            }
                            else{
                                $html.="<td><input type='text' class='form-control' onKeyPress='AutoCheck(".$value3->id.");' value='".$value3->email."' name='txt_email_".$value3->id."' id='txt_email_".$value3->id."'></td>";
                                $html.="<td><input type='text' class='form-control' onKeyPress='AutoCheck(".$value3->id.");' value='".$value3->celular."' name='txt_celular_".$value3->id."' id='txt_celular_".$value3->id."'></td>";
                            }
                        
                            if( Input::has('persona') ){
                                $html.="<td>".$value3->cant."</td>";
                            }
                            else{
                                $html.="<td><input type='checkbox' name='persona[]' value='".$value3->id."'></td>";
                            }
                        $html.="</tr>";
                        $niveles[$value3->nivel_id]++;
                        $paginas[$value3->nivel_id]+=$value3->cant;

                        $id=$value3->id;
                        $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                        c.nombre, count(g.id) cant,a.nivel_id,
                                        a.dni,a.celular,a.email
                                FROM activistas a
                                INNER JOIN cargos c ON a.nivel_id=c.id
                                LEFT JOIN grupos g ON a.id= g.activista_id
                                WHERE a.lider_padre = $id 
                                AND a.estado=1
                                GROUP BY a.id ";
                        $r4=DB::select($sql);

                        foreach ($r4 as $key4 => $value4) {
                            if( Input::has('persona') ){
                                $html.="<tr style='background-color: ".$color[$value4->nivel_id].";color: ".$colort[$value4->nivel_id].";'>";
                            }
                            else{
                                $html.="<tr id='tr_".$value4->id."'>";
                            }
                                $html.="<td>".$value4->nombre."</td>";
                                $html.="<td>".$value4->paterno."</td>";
                                $html.="<td>".$value4->materno."</td>";
                                $html.="<td>".$value4->nombres."</td>";
                                $html.="<td>".$value4->dni."</td>";
                                if( Input::has('persona') ){
                                    $html.="<td>".$value4->email."</td>";
                                    $html.="<td>".$value4->celular."</td>";
                                }
                                else{
                                    $html.="<td><input type='text' class='form-control' onKeyPress='AutoCheck(".$value4->id.");' value='".$value4->email."' name='txt_email_".$value4->id."' id='txt_email_".$value4->id."'></td>";
                                    $html.="<td><input type='text' class='form-control' onKeyPress='AutoCheck(".$value4->id.");' value='".$value4->celular."' name='txt_celular_".$value4->id."' id='txt_celular_".$value4->id."'></td>";
                                }

                                if( Input::has('persona') ){
                                    $html.="<td>".$value4->cant."</td>";
                                }
                                else{
                                    $html.="<td><input type='checkbox' name='persona[]' value='".$value4->id."'></td>";
                                }
                            $html.="</tr>";
                            $niveles[$value4->nivel_id]++;
                            $paginas[$value4->nivel_id]+=$value4->cant;

                            $id=$value4->id;
                            $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                            c.nombre, count(g.id) cant,a.nivel_id,
                                            a.dni,a.celular,a.email
                                    FROM activistas a
                                    INNER JOIN cargos c ON a.nivel_id=c.id
                                    LEFT JOIN grupos g ON a.id= g.activista_id
                                    WHERE a.lider_padre = $id 
                                    AND a.estado=1
                                    GROUP BY a.id ";
                            $r5=DB::select($sql);

                            foreach ($r5 as $key5 => $value5) {
                                if( Input::has('persona') ){
                                    $html.="<tr style='background-color: ".$color[$value5->nivel_id].";color: ".$colort[$value5->nivel_id].";'>";
                                }
                                else{
                                    $html.="<tr id='tr_".$value5->id."'>";
                                }
                                    $html.="<td>".$value5->nombre."</td>";
                                    $html.="<td>".$value5->paterno."</td>";
                                    $html.="<td>".$value5->materno."</td>";
                                    $html.="<td>".$value5->nombres."</td>";
                                    $html.="<td>".$value5->dni."</td>";
                                    if( Input::has('persona') ){
                                        $html.="<td>".$value5->email."</td>";
                                        $html.="<td>".$value5->celular."</td>";
                                    }
                                    else{
                                        $html.="<td><input type='text' class='form-control' onKeyPress='AutoCheck(".$value5->id.");' value='".$value5->email."' name='txt_email_".$value5->id."' id='txt_email_".$value5->id."'></td>";
                                        $html.="<td><input type='text' class='form-control' onKeyPress='AutoCheck(".$value5->id.");' value='".$value5->celular."' name='txt_celular_".$value5->id."' id='txt_celular_".$value5->id."'></td>";
                                    }

                                    if( Input::has('persona') ){
                                        $html.="<td>".$value5->cant."</td>";
                                    }
                                    else{
                                        $html.="<td><input type='checkbox' name='persona[]' value='".$value5->id."'></td>";
                                    }
                                $html.="</tr>";
                                $niveles[$value5->nivel_id]++;
                                $paginas[$value5->nivel_id]+=$value5->cant;

                                $id=$value5->id;
                                $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                                c.nombre, count(g.id) cant,a.nivel_id,
                                                a.dni,a.celular,a.email
                                        FROM activistas a
                                        INNER JOIN cargos c ON a.nivel_id=c.id
                                        LEFT JOIN grupos g ON a.id= g.activista_id
                                        WHERE a.lider_padre = $id 
                                        AND a.estado=1
                                        GROUP BY a.id ";
                                $r6=DB::select($sql);

                                foreach ($r6 as $key6 => $value6) {
                                    if( Input::has('persona') ){
                                        $html.="<tr style='background-color: ".$color[$value6->nivel_id].";color: ".$colort[$value6->nivel_id].";'>";
                                    }
                                    else{
                                        $html.="<tr id='tr_".$value6->id."'>";
                                    }
                                        $html.="<td>".$value6->nombre."</td>";
                                        $html.="<td>".$value6->paterno."</td>";
                                        $html.="<td>".$value6->materno."</td>";
                                        $html.="<td>".$value6->nombres."</td>";
                                        $html.="<td>".$value6->dni."</td>";
                                        if( Input::has('persona') ){
                                            $html.="<td>".$value6->email."</td>";
                                            $html.="<td>".$value6->celular."</td>";
                                        }
                                        else{
                                            $html.="<td><input type='text' class='form-control' onKeyPress='AutoCheck(".$value6->id.");' value='".$value6->email."' name='txt_email_".$value6->id."' id='txt_email_".$value6->id."'></td>";
                                            $html.="<td><input type='text' class='form-control' onKeyPress='AutoCheck(".$value6->id.");' value='".$value6->celular."' name='txt_celular_".$value6->id."' id='txt_celular_".$value6->id."'></td>";
                                        }
                                        
                                        if( Input::has('persona') ){
                                            $html.="<td>".$value6->cant."</td>";
                                        }
                                        else{
                                            $html.="<td><input type='checkbox' name='persona[]' value='".$value6->id."'></td>";
                                        }
                                    $html.="</tr>";
                                    $niveles[$value6->nivel_id]++;
                                    $paginas[$value6->nivel_id]+=$value6->cant;

                                    $id=$value6->id;
                                    $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                                    c.nombre, count(g.id) cant,a.nivel_id,
                                                    a.dni,a.celular,a.email
                                            FROM activistas a
                                            INNER JOIN cargos c ON a.nivel_id=c.id
                                            LEFT JOIN grupos g ON a.id= g.activista_id
                                            WHERE a.lider_padre = $id 
                                            AND a.estado=1
                                            GROUP BY a.id ";
                                    $r7=DB::select($sql);

                                    foreach ($r7 as $key7 => $value7) {
                                        if( Input::has('persona') ){
                                            $html.="<tr style='background-color: ".$color[$value7->nivel_id].";color: ".$colort[$value7->nivel_id].";'>";
                                        }
                                        else{
                                            $html.="<tr id='tr_".$value7->id."'>";
                                        }
                                            $html.="<td>".$value7->nombre."</td>";
                                            $html.="<td>".$value7->paterno."</td>";
                                            $html.="<td>".$value7->materno."</td>";
                                            $html.="<td>".$value7->nombres."</td>";
                                            $html.="<td>".$value7->dni."</td>";
                                            if( Input::has('persona') ){
                                                $html.="<td>".$value7->email."</td>";
                                                $html.="<td>".$value7->celular."</td>";
                                            }
                                            else{
                                                $html.="<td><input type='text' class='form-control' onKeyPress='AutoCheck(".$value7->id.");' value='".$value7->email."' name='txt_email_".$value7->id."' id='txt_email_".$value7->id."'></td>";
                                                $html.="<td><input type='text' class='form-control' onKeyPress='AutoCheck(".$value7->id.");' value='".$value7->celular."' name='txt_celular_".$value7->id."' id='txt_celular_".$value7->id."'></td>";
                                            }
                                        
                                            if( Input::has('persona') ){
                                                $html.="<td>".$value7->cant."</td>";
                                            }
                                            else{
                                                $html.="<td><input type='checkbox' name='persona[]' value='".$value7->id."'></td>";
                                            }
                                        $html.="</tr>";
                                        $niveles[$value7->nivel_id]++;
                                        $paginas[$value7->nivel_id]+=$value7->cant;

                                        $id=$value7->id;
                                        $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                                        c.nombre, count(g.id) cant,a.nivel_id,
                                                        a.dni,a.celular,a.email
                                                FROM activistas a
                                                INNER JOIN cargos c ON a.nivel_id=c.id
                                                LEFT JOIN grupos g ON a.id= g.activista_id
                                                WHERE a.lider_padre = $id 
                                                AND a.estado=1
                                                GROUP BY a.id ";
                                        $r8=DB::select($sql);

                                        foreach ($r8 as $key8 => $value8) {
                                            if( Input::has('persona') ){
                                                $html.="<tr style='background-color: ".$color[$value8->nivel_id].";color: ".$colort[$value8->nivel_id].";'>";
                                            }
                                            else{
                                                $html.="<tr id='tr_".$value8->id."'>";
                                            }
                                                $html.="<td>".$value8->nombre."</td>";
                                                $html.="<td>".$value8->paterno."</td>";
                                                $html.="<td>".$value8->materno."</td>";
                                                $html.="<td>".$value8->nombres."</td>";
                                                $html.="<td>".$value8->dni."</td>";
                                                if( Input::has('persona') ){
                                                    $html.="<td>".$value8->email."</td>";
                                                    $html.="<td>".$value8->celular."</td>";
                                                }
                                                else{
                                                    $html.="<td><input type='text' class='form-control' onKeyPress='AutoCheck(".$value8->id.");' value='".$value8->email."' name='txt_email_".$value8->id."' id='txt_email_".$value8->id."'></td>";
                                                    $html.="<td><input type='text' class='form-control' onKeyPress='AutoCheck(".$value8->id.");' value='".$value8->celular."' name='txt_celular_".$value8->id."' id='txt_celular_".$value8->id."'></td>";
                                                }
                                            
                                                if( Input::has('persona') ){
                                                    $html.="<td>".$value8->cant."</td>";
                                                }
                                                else{
                                                    $html.="<td><input type='checkbox' name='persona[]' value='".$value8->id."'></td>";
                                                }
                                            $html.="</tr>";
                                            $niveles[$value8->nivel_id]++;
                                            $paginas[$value8->nivel_id]+=$value8->cant;

                                            $id=$value8->id;
                                            $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                                            c.nombre, count(g.id) cant,a.nivel_id,
                                                            a.dni,a.celular,a.email
                                                    FROM activistas a
                                                    INNER JOIN cargos c ON a.nivel_id=c.id
                                                    LEFT JOIN grupos g ON a.id= g.activista_id
                                                    WHERE a.lider_padre = $id 
                                                    AND a.estado=1
                                                    GROUP BY a.id ";
                                            $r9=DB::select($sql);

                                            foreach ($r9 as $key9 => $value9) {
                                                if( Input::has('persona') ){
                                                    $html.="<tr style='background-color: ".$color[$value9->nivel_id].";color: ".$colort[$value9->nivel_id].";'>";
                                                }
                                                else{
                                                    $html.="<tr id='tr_".$value9->id."'>";
                                                }
                                                    $html.="<td>".$value9->nombre."</td>";
                                                    $html.="<td>".$value9->paterno."</td>";
                                                    $html.="<td>".$value9->materno."</td>";
                                                    $html.="<td>".$value9->nombres."</td>";
                                                    $html.="<td>".$value9->dni."</td>";
                                                    if( Input::has('persona') ){
                                                        $html.="<td>".$value9->email."</td>";
                                                        $html.="<td>".$value9->celular."</td>";
                                                    }
                                                    else{
                                                        $html.="<td><input type='text' class='form-control' onKeyPress='AutoCheck(".$value9->id.");' value='".$value9->email."' name='txt_email_".$value9->id."' id='txt_email_".$value9->id."'></td>";
                                                        $html.="<td><input type='text' class='form-control' onKeyPress='AutoCheck(".$value9->id.");' value='".$value9->celular."' name='txt_celular_".$value9->id."' id='txt_celular_".$value9->id."'></td>";
                                                    }
                                                
                                                    if( Input::has('persona') ){
                                                        $html.="<td>".$value9->cant."</td>";
                                                    }
                                                    else{
                                                        $html.="<td><input type='checkbox' name='persona[]' value='".$value9->id."'></td>";
                                                    }
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

    public function postPornivelvalida()
    {
        $id= $this->userID;
        $nivel= $this->userNivelId;
        if( Input::has('persona') ){
            $id= Input::get('persona');
            $nivel= Input::get('nivel');
        }
        
        $niveles= array(0,0,0,0,0,0,0,0,0,0);
        $paginas= array(0,0,0,0,0,0,0,0,0,0);
        $color=array('','#A4A4A4','#4BD1E0','#9B1E31','#45298F','#EFEFA2','#D3FFFF','#FF99FF','#D7F336','#8DB4E2','#A4A4A4','#A4A4A4','#A4A4A4');
        $colort=array('','#F0F0F0','#F0F0F0','#F0F0F0','#F0F0F0','#000000','#000000','#000000','#000000','#F0F0F0','#F0F0F0','#F0F0F0','#F0F0F0');
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
        $contadorValida=0;

        $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                        c.nombre,a.nivel_id,
                        a.dni,a.celular,a.email,
                        IF( IFNULL(m.email,0)=0,'No','Si' ) memail,IFNULL(m.cel,0) mcel,
                        IFNULL(m.nrollamada,0) llamada,
                        IF( IFNULL(m.validado,0)=0,'No','Si' ) mvalidado,
                        IF( IFNULL(m.aceptado,0)=0,'No','Si' ) maceptado
                FROM activistas a
                INNER JOIN cargos c ON a.nivel_id=c.id
                LEFT JOIN mensajerias m ON a.id= m.activista_id
                WHERE a.lider_padre = $id
                AND a.estado=1
                GROUP BY a.id ";

        $r=DB::select($sql);
        $ids=array();
        $html="";
        $nivelanidado="N".$id;
        $opcionescel=   "<option value='0'>.::Seleccione::.</option>
                        <option value='1'>Ocupado</option>
                        <option value='2'>No Responde</option>
                        <option value='3'>Fuera de Servicio</option>
                        <option value='4'>Equivocado</option>
                        <option value='5'>No Coordinado</option>
                        <option value='6'>Acepta</option>";

            foreach ($r as $key => $value) {
                $cssemail='checkbox-td';
                $cssemailr="checkbox-td-uncheck";
                if( $value->memail=='Si' ){
                    $cssemail="checkbox-td-check-g";
                }
                
                $csscel="checkbox-td";
                $disablede="";
                $disabled="";

                if( trim($value->email)=='' ){
                    $cssemail="";
                }
                if( trim($value->celular)=='' ){
                    $disabled="disabled";
                    $csscel="";
                }
                $html.="<tr id='tr_".$value->id."'>";
                    $contadorValida++;
                    $html.="<td>".$contadorValida."</td>";
                    $html.="<td><input type='hidden' name='idpersonas[]' value='".$value->id."'>".$value->nombre."</td>";
                    $html.="<td>".$value->paterno."</td>";
                    $html.="<td>".$value->materno."</td>";
                    $html.="<td>".$value->nombres."</td>";
                    $html.="<td>".$value->dni."</td>";
                    $html.="<td id='td_email_".$value->id."' onClick='ActivaCheck(this.id)' class='".$cssemail."'>".$value->email."</td>";
                    $html.="<td>".$value->memail."</td>";
                    $html.="<td>".$value->mvalidado."</td>";
                    $html.="<td>".$value->maceptado."</td>";
                    $html.="<td id='td_celular_".$value->id."' class='".$csscel."'>".$value->celular."</td>";
                    $html.="<td>".$value->llamada."</td>";
                    $html.="<td>
                                <select ".$disabled." onChange='ActivaCheck(".'"'."td_celular_".$value->id.'",this.value'.")'>
                                ".str_replace("value='".$value->mcel."'", "value='".$value->mcel."' selected", $opcionescel)."
                                <select>
                            </td>";
                $html.="</tr>";
                $niveles[$value->nivel_id]++;
                //array_push($ids,$value->id);
                $id=$value->id;
                $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                c.nombre, a.nivel_id,
                                a.dni,a.celular,a.email,
                                IF( IFNULL(m.email,0)=0,'No','Si' ) memail,IFNULL(m.cel,0) mcel,
                                IFNULL(m.nrollamada,0) llamada,
                                IF( IFNULL(m.validado,0)=0,'No','Si' ) mvalidado,
                                IF( IFNULL(m.aceptado,0)=0,'No','Si' ) maceptado
                        FROM activistas a
                        INNER JOIN cargos c ON a.nivel_id=c.id
                        LEFT JOIN mensajerias m ON a.id= m.activista_id
                        WHERE a.lider_padre = $id 
                        AND a.estado=1
                        GROUP BY a.id ";
                $r2=DB::select($sql);

                foreach ($r2 as $key2 => $value2) {
                    $cssemail='checkbox-td';
                    $cssemailr="checkbox-td-uncheck";
                    if( $value2->memail=='Si' ){
                        $cssemail="checkbox-td-check-g";
                    }
                    
                    $csscel="checkbox-td";
                    $disablede="";
                    $disabled="";

                    if( trim($value2->email)=='' ){
                        $cssemail="";
                    }
                    if( trim($value2->celular)=='' ){
                        $disabled="disabled";
                        $csscel="";
                    }
                    $html.="<tr id='tr_".$value2->id."'>";
                        $contadorValida++;
                        $html.="<td>".$contadorValida."</td>";
                        $html.="<td><input type='hidden' name='idpersonas[]' value='".$value2->id."'>".$value2->nombre."</td>";
                        $html.="<td>".$value2->paterno."</td>";
                        $html.="<td>".$value2->materno."</td>";
                        $html.="<td>".$value2->nombres."</td>";
                        $html.="<td>".$value2->dni."</td>";
                        $html.="<td id='td_email_".$value2->id."' onClick='ActivaCheck(this.id)' class='".$cssemail."'>".$value2->email."</td>";
                        $html.="<td>".$value2->memail."</td>";
                        $html.="<td>".$value2->mvalidado."</td>";
                        $html.="<td>".$value2->maceptado."</td>";
                        $html.="<td id='td_celular_".$value2->id."' class='".$csscel."'>".$value2->celular."</td>";
                        $html.="<td>".$value2->llamada."</td>";
                        $html.="<td>
                                    <select ".$disabled." onChange='ActivaCheck(".'"'."td_celular_".$value2->id.'",this.value'.")'>
                                    ".str_replace("value='".$value2->mcel."'", "value='".$value2->mcel."' selected", $opcionescel)."
                                    <select>
                                </td>";
                    $html.="</tr>";
                    $niveles[$value2->nivel_id]++;

                    $id=$value2->id;
                    $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                    c.nombre, a.nivel_id,
                                    a.dni,a.celular,a.email,
                                    IF( IFNULL(m.email,0)=0,'No','Si' ) memail,IFNULL(m.cel,0) mcel,
                                    IFNULL(m.nrollamada,0) llamada,
                                    IF( IFNULL(m.validado,0)=0,'No','Si' ) mvalidado,
                                    IF( IFNULL(m.aceptado,0)=0,'No','Si' ) maceptado
                            FROM activistas a
                            INNER JOIN cargos c ON a.nivel_id=c.id
                            LEFT JOIN mensajerias m ON a.id= m.activista_id
                            WHERE a.lider_padre = $id 
                            AND a.estado=1
                            GROUP BY a.id ";
                    $r3=DB::select($sql);

                    foreach ($r3 as $key3 => $value3) {
                        $cssemail='checkbox-td';
                        $cssemailr="checkbox-td-uncheck";
                        if( $value3->memail=='Si' ){
                            $cssemail="checkbox-td-check-g";
                        }
                        
                        $csscel="checkbox-td";
                        $disablede="";
                        $disabled="";

                        if( trim($value3->email)=='' ){
                            $cssemail="";
                        }
                        if( trim($value3->celular)=='' ){
                            $disabled="disabled";
                            $csscel="";
                        }
                        $html.="<tr id='tr_".$value3->id."'>";
                            $contadorValida++;
                            $html.="<td>".$contadorValida."</td>";
                            $html.="<td><input type='hidden' name='idpersonas[]' value='".$value3->id."'>".$value3->nombre."</td>";
                            $html.="<td>".$value3->paterno."</td>";
                            $html.="<td>".$value3->materno."</td>";
                            $html.="<td>".$value3->nombres."</td>";
                            $html.="<td>".$value3->dni."</td>";
                            $html.="<td id='td_email_".$value3->id."' onClick='ActivaCheck(this.id)' class='".$cssemail."'>".$value3->email."</td>";
                            $html.="<td>".$value3->memail."</td>";
                            $html.="<td>".$value3->mvalidado."</td>";
                            $html.="<td>".$value3->maceptado."</td>";
                            $html.="<td id='td_celular_".$value3->id."' class='".$csscel."'>".$value3->celular."</td>";
                            $html.="<td>".$value3->llamada."</td>";
                            $html.="<td>
                                        <select ".$disabled." onChange='ActivaCheck(".'"'."td_celular_".$value3->id.'",this.value'.")'>
                                        ".str_replace("value='".$value3->mcel."'", "value='".$value3->mcel."' selected", $opcionescel)."
                                        <select>
                                    </td>";
                        $html.="</tr>";
                        $niveles[$value3->nivel_id]++;

                        $id=$value3->id;
                        $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                        c.nombre, a.nivel_id,
                                        a.dni,a.celular,a.email,
                                        IF( IFNULL(m.email,0)=0,'No','Si' ) memail,IFNULL(m.cel,0) mcel,
                                        IFNULL(m.nrollamada,0) llamada,
                                        IF( IFNULL(m.validado,0)=0,'No','Si' ) mvalidado,
                                        IF( IFNULL(m.aceptado,0)=0,'No','Si' ) maceptado
                                FROM activistas a
                                INNER JOIN cargos c ON a.nivel_id=c.id
                                LEFT JOIN mensajerias m ON a.id= m.activista_id
                                WHERE a.lider_padre = $id 
                                AND a.estado=1
                                GROUP BY a.id ";
                        $r4=DB::select($sql);

                        foreach ($r4 as $key4 => $value4) {
                            $cssemail='checkbox-td';
                            $cssemailr="checkbox-td-uncheck";
                            if( $value4->memail=='Si' ){
                                $cssemail="checkbox-td-check-g";
                            }
                            
                            $csscel="checkbox-td";
                            $disablede="";
                            $disabled="";

                            if( trim($value4->email)=='' ){
                                $cssemail="";
                            }
                            if( trim($value4->celular)=='' ){
                                $disabled="disabled";
                                $csscel="";
                            }
                            $html.="<tr id='tr_".$value4->id."'>";
                                $contadorValida++;
                                $html.="<td>".$contadorValida."</td>";
                                $html.="<td><input type='hidden' name='idpersonas[]' value='".$value4->id."'>".$value4->nombre."</td>";
                                $html.="<td>".$value4->paterno."</td>";
                                $html.="<td>".$value4->materno."</td>";
                                $html.="<td>".$value4->nombres."</td>";
                                $html.="<td>".$value4->dni."</td>";
                                $html.="<td id='td_email_".$value4->id."' onClick='ActivaCheck(this.id)' class='".$cssemail."'>".$value4->email."</td>";
                                $html.="<td>".$value4->memail."</td>";
                                $html.="<td>".$value4->mvalidado."</td>";
                                $html.="<td>".$value4->maceptado."</td>";
                                $html.="<td id='td_celular_".$value4->id."' class='".$csscel."'>".$value4->celular."</td>";
                                $html.="<td>".$value4->llamada."</td>";
                                $html.="<td>
                                            <select ".$disabled." onChange='ActivaCheck(".'"'."td_celular_".$value4->id.'",this.value'.")'>
                                            ".str_replace("value='".$value4->mcel."'", "value='".$value4->mcel."' selected", $opcionescel)."
                                            <select>
                                        </td>";
                            $html.="</tr>";
                            $niveles[$value4->nivel_id]++;

                            $id=$value4->id;
                            $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                            c.nombre, a.nivel_id,
                                            a.dni,a.celular,a.email,
                                            IF( IFNULL(m.email,0)=0,'No','Si' ) memail,IFNULL(m.cel,0) mcel,
                                            IFNULL(m.nrollamada,0) llamada,
                                            IF( IFNULL(m.validado,0)=0,'No','Si' ) mvalidado,
                                            IF( IFNULL(m.aceptado,0)=0,'No','Si' ) maceptado
                                    FROM activistas a
                                    INNER JOIN cargos c ON a.nivel_id=c.id
                                    LEFT JOIN mensajerias m ON a.id= m.activista_id
                                    WHERE a.lider_padre = $id 
                                    AND a.estado=1
                                    GROUP BY a.id ";
                            $r5=DB::select($sql);

                            foreach ($r5 as $key5 => $value5) {
                                $cssemail='checkbox-td';
                                $cssemailr="checkbox-td-uncheck";
                                if( $value5->memail=='Si' ){
                                    $cssemail="checkbox-td-check-g";
                                }
                                
                                $csscel="checkbox-td";
                                $disablede="";
                                $disabled="";

                                if( trim($value5->email)=='' ){
                                    $cssemail="";
                                }
                                if( trim($value5->celular)=='' ){
                                    $disabled="disabled";
                                    $csscel="";
                                }
                                $html.="<tr id='tr_".$value5->id."'>";
                                    $contadorValida++;
                                    $html.="<td>".$contadorValida."</td>";
                                    $html.="<td><input type='hidden' name='idpersonas[]' value='".$value5->id."'>".$value5->nombre."</td>";
                                    $html.="<td>".$value5->paterno."</td>";
                                    $html.="<td>".$value5->materno."</td>";
                                    $html.="<td>".$value5->nombres."</td>";
                                    $html.="<td>".$value5->dni."</td>";
                                    $html.="<td id='td_email_".$value5->id."' onClick='ActivaCheck(this.id)' class='".$cssemail."'>".$value5->email."</td>";
                                    $html.="<td>".$value5->memail."</td>";
                                    $html.="<td>".$value5->mvalidado."</td>";
                                    $html.="<td>".$value5->maceptado."</td>";
                                    $html.="<td id='td_celular_".$value5->id."' class='".$csscel."'>".$value5->celular."</td>";
                                    $html.="<td>".$value5->llamada."</td>";
                                    $html.="<td>
                                                <select ".$disabled." onChange='ActivaCheck(".'"'."td_celular_".$value5->id.'",this.value'.")'>
                                                ".str_replace("value='".$value5->mcel."'", "value='".$value5->mcel."' selected", $opcionescel)."
                                                <select>
                                            </td>";
                                $html.="</tr>";
                                $niveles[$value5->nivel_id]++;

                                $id=$value5->id;
                                $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                                c.nombre, a.nivel_id,
                                                a.dni,a.celular,a.email,
                                                IF( IFNULL(m.email,0)=0,'No','Si' ) memail,IFNULL(m.cel,0) mcel,
                                                IFNULL(m.nrollamada,0) llamada,
                                                IF( IFNULL(m.validado,0)=0,'No','Si' ) mvalidado,
                                                IF( IFNULL(m.aceptado,0)=0,'No','Si' ) maceptado
                                        FROM activistas a
                                        INNER JOIN cargos c ON a.nivel_id=c.id
                                        LEFT JOIN mensajerias m ON a.id= m.activista_id
                                        WHERE a.lider_padre = $id 
                                        AND a.estado=1
                                        GROUP BY a.id ";
                                $r6=DB::select($sql);

                                foreach ($r6 as $key6 => $value6) {
                                    $cssemail='checkbox-td';
                                    $cssemailr="checkbox-td-uncheck";
                                    if( $value6->memail=='Si' ){
                                        $cssemail="checkbox-td-check-g";
                                    }
                                    
                                    $csscel="checkbox-td";
                                    $disablede="";
                                    $disabled="";

                                    if( trim($value6->email)=='' ){
                                        $cssemail="";
                                    }
                                    if( trim($value6->celular)=='' ){
                                        $disabled="disabled";
                                        $csscel="";
                                    }
                                    $html.="<tr id='tr_".$value6->id."'>";
                                        $contadorValida++;
                                        $html.="<td>".$contadorValida."</td>";
                                        $html.="<td><input type='hidden' name='idpersonas[]' value='".$value6->id."'>".$value6->nombre."</td>";
                                        $html.="<td>".$value6->paterno."</td>";
                                        $html.="<td>".$value6->materno."</td>";
                                        $html.="<td>".$value6->nombres."</td>";
                                        $html.="<td>".$value6->dni."</td>";
                                        $html.="<td id='td_email_".$value6->id."' onClick='ActivaCheck(this.id)' class='".$cssemail."'>".$value6->email."</td>";
                                        $html.="<td>".$value6->memail."</td>";
                                        $html.="<td>".$value6->mvalidado."</td>";
                                        $html.="<td>".$value6->maceptado."</td>";
                                        $html.="<td id='td_celular_".$value6->id."' class='".$csscel."'>".$value6->celular."</td>";
                                        $html.="<td>".$value6->llamada."</td>";
                                        $html.="<td>
                                                    <select ".$disabled." onChange='ActivaCheck(".'"'."td_celular_".$value6->id.'",this.value'.")'>
                                                    ".str_replace("value='".$value6->mcel."'", "value='".$value6->mcel."' selected", $opcionescel)."
                                                    <select>
                                                </td>";
                                    $html.="</tr>";
                                    $niveles[$value6->nivel_id]++;

                                    $id=$value6->id;
                                    $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                                    c.nombre, a.nivel_id,
                                                    a.dni,a.celular,a.email,
                                                    IF( IFNULL(m.email,0)=0,'No','Si' ) memail,IFNULL(m.cel,0) mcel,
                                                    IFNULL(m.nrollamada,0) llamada,
                                                    IF( IFNULL(m.validado,0)=0,'No','Si' ) mvalidado,
                                                    IF( IFNULL(m.aceptado,0)=0,'No','Si' ) maceptado
                                            FROM activistas a
                                            INNER JOIN cargos c ON a.nivel_id=c.id
                                            LEFT JOIN mensajerias m ON a.id= m.activista_id
                                            WHERE a.lider_padre = $id 
                                            AND a.estado=1
                                            GROUP BY a.id ";
                                    $r7=DB::select($sql);

                                    foreach ($r7 as $key7 => $value7) {
                                        $cssemail='checkbox-td';
                                        $cssemailr="checkbox-td-uncheck";
                                        if( $value7->memail=='Si' ){
                                            $cssemail="checkbox-td-check-g";
                                        }
                                        
                                        $csscel="checkbox-td";
                                        $disablede="";
                                        $disabled="";

                                        if( trim($value7->email)=='' ){
                                            $cssemail="";
                                        }
                                        if( trim($value7->celular)=='' ){
                                            $disabled="disabled";
                                            $csscel="";
                                        }
                                        $html.="<tr id='tr_".$value7->id."'>";
                                            $contadorValida++;
                                            $html.="<td>".$contadorValida."</td>";
                                            $html.="<td><input type='hidden' name='idpersonas[]' value='".$value7->id."'>".$value7->nombre."</td>";
                                            $html.="<td>".$value7->paterno."</td>";
                                            $html.="<td>".$value7->materno."</td>";
                                            $html.="<td>".$value7->nombres."</td>";
                                            $html.="<td>".$value7->dni."</td>";
                                            $html.="<td id='td_email_".$value7->id."' onClick='ActivaCheck(this.id)' class='".$cssemail."'>".$value7->email."</td>";
                                            $html.="<td>".$value7->memail."</td>";
                                            $html.="<td>".$value7->mvalidado."</td>";
                                            $html.="<td>".$value7->maceptado."</td>";
                                            $html.="<td id='td_celular_".$value7->id."' class='".$csscel."'>".$value7->celular."</td>";
                                            $html.="<td>".$value7->llamada."</td>";
                                            $html.="<td>
                                                        <select ".$disabled." onChange='ActivaCheck(".'"'."td_celular_".$value7->id.'",this.value'.")'>
                                                        ".str_replace("value='".$value7->mcel."'", "value='".$value7->mcel."' selected", $opcionescel)."
                                                        <select>
                                                    </td>";
                                        $html.="</tr>";
                                        $niveles[$value7->nivel_id]++;

                                        $id=$value7->id;
                                        $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                                        c.nombre, a.nivel_id,
                                                        a.dni,a.celular,a.email,
                                                        IF( IFNULL(m.email,0)=0,'No','Si' ) memail,IFNULL(m.cel,0) mcel,
                                                        IFNULL(m.nrollamada,0) llamada,
                                                        IF( IFNULL(m.validado,0)=0,'No','Si' ) mvalidado,
                                                        IF( IFNULL(m.aceptado,0)=0,'No','Si' ) maceptado
                                                FROM activistas a
                                                INNER JOIN cargos c ON a.nivel_id=c.id
                                                LEFT JOIN mensajerias m ON a.id= m.activista_id
                                                WHERE a.lider_padre = $id 
                                                AND a.estado=1
                                                GROUP BY a.id ";
                                        $r8=DB::select($sql);

                                        foreach ($r8 as $key8 => $value8) {
                                            $cssemail='checkbox-td';
                                            $cssemailr="checkbox-td-uncheck";
                                            if( $value8->memail=='Si' ){
                                                $cssemail="checkbox-td-check-g";
                                            }
                                            
                                            $csscel="checkbox-td";
                                            $disablede="";
                                            $disabled="";

                                            if( trim($value8->email)=='' ){
                                                $cssemail="";
                                            }
                                            if( trim($value8->celular)=='' ){
                                                $disabled="disabled";
                                                $csscel="";
                                            }
                                            $html.="<tr id='tr_".$value8->id."'>";
                                                $contadorValida++;
                                                $html.="<td>".$contadorValida."</td>";
                                                $html.="<td><input type='hidden' name='idpersonas[]' value='".$value8->id."'>".$value8->nombre."</td>";
                                                $html.="<td>".$value8->paterno."</td>";
                                                $html.="<td>".$value8->materno."</td>";
                                                $html.="<td>".$value8->nombres."</td>";
                                                $html.="<td>".$value8->dni."</td>";
                                                $html.="<td id='td_email_".$value8->id."' onClick='ActivaCheck(this.id)' class='".$cssemail."'>".$value8->email."</td>";
                                                $html.="<td>".$value8->memail."</td>";
                                                $html.="<td>".$value8->mvalidado."</td>";
                                                $html.="<td>".$value8->maceptado."</td>";
                                                $html.="<td id='td_celular_".$value8->id."' class='".$csscel."'>".$value8->celular."</td>";
                                                $html.="<td>".$value8->llamada."</td>";
                                                $html.="<td>
                                                            <select ".$disabled." onChange='ActivaCheck(".'"'."td_celular_".$value8->id.'",this.value'.")'>
                                                            ".str_replace("value='".$value8->mcel."'", "value='".$value8->mcel."' selected", $opcionescel)."
                                                            <select>
                                                        </td>";
                                            $html.="</tr>";
                                            $niveles[$value8->nivel_id]++;

                                            $id=$value8->id;
                                            $sql= " SELECT  a.id,a.paterno,a.materno,a.nombres,
                                                            c.nombre, a.nivel_id,
                                                            a.dni,a.celular,a.email,
                                                            IF( IFNULL(m.email,0)=0,'No','Si' ) memail,IFNULL(m.cel,0) mcel,
                                                            IFNULL(m.nrollamada,0) llamada,
                                                            IF( IFNULL(m.validado,0)=0,'No','Si' ) mvalidado,
                                                            IF( IFNULL(m.aceptado,0)=0,'No','Si' ) maceptado
                                                    FROM activistas a
                                                    INNER JOIN cargos c ON a.nivel_id=c.id
                                                    LEFT JOIN mensajerias m ON a.id= m.activista_id
                                                    WHERE a.lider_padre = $id 
                                                    AND a.estado=1
                                                    GROUP BY a.id ";
                                            $r9=DB::select($sql);

                                            foreach ($r9 as $key9 => $value9) {
                                                $cssemail='checkbox-td';
                                                $cssemailr="checkbox-td-uncheck";
                                                if( $value9->memail=='Si' ){
                                                    $cssemail="checkbox-td-check-g";
                                                }
                                                
                                                $csscel="checkbox-td";
                                                $disablede="";
                                                $disabled="";

                                                if( trim($value9->email)=='' ){
                                                    $cssemail="";
                                                }
                                                if( trim($value9->celular)=='' ){
                                                    $disabled="disabled";
                                                    $csscel="";
                                                }
                                                $html.="<tr id='tr_".$value9->id."'>";
                                                    $contadorValida++;
                                                    $html.="<td>".$contadorValida."</td>";
                                                    $html.="<td><input type='hidden' name='idpersonas[]' value='".$value9->id."'>".$value9->nombre."</td>";
                                                    $html.="<td>".$value9->paterno."</td>";
                                                    $html.="<td>".$value9->materno."</td>";
                                                    $html.="<td>".$value9->nombres."</td>";
                                                    $html.="<td>".$value9->dni."</td>";
                                                    $html.="<td id='td_email_".$value9->id."' onClick='ActivaCheck(this.id)' class='".$cssemail."'>".$value9->email."</td>";
                                                    $html.="<td>".$value9->memail."</td>";
                                                    $html.="<td>".$value9->mvalidado."</td>";
                                                    $html.="<td>".$value9->maceptado."</td>";
                                                    $html.="<td id='td_celular_".$value9->id."' class='".$csscel."'>".$value9->celular."</td>";
                                                    $html.="<td>".$value9->llamada."</td>";
                                                    $html.="<td>
                                                                <select ".$disabled." onChange='ActivaCheck(".'"'."td_celular_".$value9->id.'",this.value'.")'>
                                                                ".str_replace("value='".$value9->mcel."'", "value='".$value9->mcel."' selected", $opcionescel)."
                                                                <select>
                                                            </td>";
                                                $html.="</tr>";
                                                $niveles[$value9->nivel_id]++;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

        return Response::json(
            array(  'datos'=> $html
            )
        );
    }

    public function postConsolidadonivel()
    {
        $data= Input::all();
        $cargos=  DB::table('cargos')
                    ->whereBetween('id', array(($data['nivel_id']+1), 9))->get();

        $sum=array(); //inicializa array
        $left="";
        $campos="";
        $cabecera="<tr>";
        $cabecera.="<th>Paterno</th>";
        $cabecera.="<th>Materno</th>";
        $cabecera.="<th>Nombres</th>";
        $datos="";
        $cont=0;
        foreach ($cargos as $key => $value) {
            array_push($sum,0);
            $cont++;
            $cabecera.="<th style='text-align:center'> Nro <br>".$value->nombre."</th>";
            $campos.=", COUNT(DISTINCT(a$cont.id)) id$cont";
            $contant=($cont-1);
                if($contant==0){
                    $contant="";
                }
            $left.=" 
                    LEFT JOIN activistas a$cont ON a$cont.lider_padre=a$contant.id AND a$cont.estado=1 ";
        }
        $cabecera.="<th>Total</th>";
        $cabecera.="</tr>";
        array_push($sum,0);

        $sql="  SELECT a.paterno,a.materno,a.nombres $campos
                FROM activistas a
                $left
                WHERE a.nivel_id=".$data['nivel_id']."
                AND a.estado=1
                GROUP BY a.id";

        $r = DB::select($sql);

        $inicio=0;
            foreach ($r as $key => $value) {
                $datos.="<tr>";
                $total=0;
                $inicio=0;
                foreach ($value as $k => $v) {
                    $datos.="<td>".$v."</td>";
                    if(is_numeric($v)){
                        $total+=$v;
                        $sum[$inicio]+=$v;
                        $inicio++;
                    }
                }
                $datos.="<td>".$total."</td>";
                $sum[$inicio]+=$total;
                $datos.="</tr>";
            }
            $datos.="<tr>";
                $datos.="<td>&nbsp;</td>";
                $datos.="<td>&nbsp;</td>";
                $datos.="<td style='text-align:right'><b>Totales:</b></td>";
            for ($i=0; $i < count($sum); $i++) { 
                $datos.="<td>".$sum[$i]."</td>";
            }
            $datos.="</tr>";

        return Response::json(
            array(  'datos'=> $datos,
                    'cabecera'=>$cabecera,
                    'nro'=>($inicio+3),
                    'rst' => 1
            )
        );
    }

    public function postConsolidadogrupo()
    {
        $data= Input::all();
        $cargos=  DB::table('cargos')
                    ->whereBetween('id', array((6+1), 9))->get();

        $sum=array(); //inicializa array
        $left="";
        $campos="";
        $cabecera="<tr>";
        $cabecera.="<th>Paterno</th>";
        $cabecera.="<th>Materno</th>";
        $cabecera.="<th>Nombres</th>";
        $datos="";
        $cont=0;
        foreach ($cargos as $key => $value) {
            array_push($sum,0);
            $cont++;
            $cabecera.="<th style='text-align:center'> Nro <br>".$value->nombre."</th>";
            $campos.=", COUNT(DISTINCT(a$cont.id)) id$cont";
            $contant=($cont-1);
                if($contant==0){
                    $contant="";
                }
            $left.=" 
                    LEFT JOIN activistas a$cont ON a$cont.lider_padre=a$contant.id AND a$cont.estado=1 ";
        }
        $cabecera.="<th>Total</th>";
        $cabecera.="</tr>";
        array_push($sum,0);

        $sql="  SELECT a.paterno,a.materno,a.nombres $campos
                FROM activistas a
                $left
                WHERE a.grupo_persona_id=".$data['nivel_id']."
                AND a.estado=1
                GROUP BY a.id";

        $r = DB::select($sql);

        $inicio=0;
            foreach ($r as $key => $value) {
                $datos.="<tr>";
                $total=0;
                $inicio=0;
                foreach ($value as $k => $v) {
                    $datos.="<td>".$v."</td>";
                    if(is_numeric($v)){
                        $total+=$v;
                        $sum[$inicio]+=$v;
                        $inicio++;
                    }
                }
                $datos.="<td>".$total."</td>";
                $sum[$inicio]+=$total;
                $datos.="</tr>";
            }
            $datos.="<tr>";
                $datos.="<td>&nbsp;</td>";
                $datos.="<td>&nbsp;</td>";
                $datos.="<td style='text-align:right'><b>Totales:</b></td>";
            for ($i=0; $i < count($sum); $i++) { 
                $datos.="<td>".$sum[$i]."</td>";
            }
            $datos.="</tr>";

        return Response::json(
            array(  'datos'=> $datos,
                    'cabecera'=>$cabecera,
                    'nro'=>($inicio+3),
                    'rst' => 1
            )
        );
    }

    public function postFanpage()
    {
        $nivel=implode(',',Input::get('nivel_id'));
        $cabecera="";

        if( Input::get('consolidado')==0 ){

        $sql="  SELECT c.nombre cargo, CONCAT(a.paterno,' ',a.materno,', ',a.nombres) persona, g.nombre, g.fb_url url, 
                    IF(g.estado=1,'Activo','Inactivo') estado,g.inactividad,g.id,
                    g.estado estado_id
                FROM grupos g 
                INNER JOIN activistas a ON a.id=g.activista_id 
                INNER JOIN cargos c ON c.id=a.nivel_id
                WHERE nivel_id IN ($nivel)
                ORDER BY a.id,g.estado DESC,g.inactividad DESC";

            $r=DB::select($sql);

            $cabecera.="<tr>";
            $cabecera.="<th>Cargo</th>";
            $cabecera.="<th>Persona</th>";
            $cabecera.="<th>Nombre</th>";
            $cabecera.="<th>Fb Url</th>";
            $cabecera.="<th>Inactividad</th>";
            $cabecera.="<th>Estado</th>";
            $cabecera.="</tr>";

            $datos="";
            foreach ($r as $key => $value) {
                $datos.="<tr>";
                $datos.="<td>".$value->cargo."</td>";
                $datos.="<td>".$value->persona."</td>";
                $datos.="<td>".$value->nombre."</td>";
                $datos.="<td><a href='".$value->url."' target='_blank'>".$value->url."</td>";
                $datos.="<td>".$value->inactividad."</td>";
                if($value->estado_id==1){
                    $datos.="<td><a class='btn btn-success btn-sm' onClick='ActualizaEstado(".$value->id.")'>".$value->estado."</a></td>";
                }
                else{
                    $datos.="<td><a class='btn btn-danger btn-sm' onClick='ActualizaEstado(".$value->id.")'>".$value->estado."</a></td>";
                }
                $datos.="</tr>";
            }

        }
        else{
            $sql="  SELECT c.nombre cargo, CONCAT(a.paterno,' ',a.materno,', ',a.nombres) persona, g.nombre, 
                    COUNT(g.id) tf, COUNT( IF(g.estado=1,g.id,NULL) ) tfa, COUNT( IF(g.estado=0,g.id,NULL) ) tfi,
                    SUM( IF(g.estado=1,g.inactividad,NULL) ) tia, SUM( IF(g.estado=0,g.inactividad,NULL) ) tii
                    FROM grupos g 
                    INNER JOIN activistas a ON a.id=g.activista_id 
                    INNER JOIN cargos c ON c.id=a.nivel_id
                    WHERE nivel_id IN ($nivel)
                    GROUP BY a.id
                    ORDER BY a.id";

            $r=DB::select($sql);

            $cabecera.="<tr>";
            $cabecera.="<th>Cargo</th>";
            $cabecera.="<th>Persona</th>";
            $cabecera.="<th>Total FP</th>";
            $cabecera.="<th>T. FP Activo</th>";
            $cabecera.="<th>T. FP Inactivo</th>";
            $cabecera.="<th>T. Inactividad <br> Activo</th>";
            $cabecera.="<th>T. Inactividad <br> Inactivo</th>";
            $cabecera.="</tr>";
            $datos="";
            foreach ($r as $key => $value) {
                $datos.="<tr>";
                $datos.="<td>".$value->cargo."</td>";
                $datos.="<td>".$value->persona."</td>";
                $datos.="<td>".$value->tf."</td>";
                $datos.="<td>".$value->tfa."</td>";
                $datos.="<td>".$value->tfi."</td>";
                $datos.="<td>".$value->tia."</td>";
                $datos.="<td>".$value->tii."</td>";
                $datos.="</tr>";
            }
        }

        return Response::json(
            array(  'datos'=> $datos,
                    'cabecera'=>$cabecera,
                    'rst' => 1
            )
        );
    }
}
