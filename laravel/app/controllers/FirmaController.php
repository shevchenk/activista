<?php

class FirmaController extends \BaseController
{
    public function postEliminar()
    {
        if ( Request::ajax() ) {
            $pagina      =   Input::get('pagina');

            $paginas=PaginaFirma::find($pagina);
            if( count($paginas)>0 ){
                if($paginas->estado==2){
                    $aParametro['msj'] = "Página no existe";
                    $aParametro['pagina']=$paginas->id;
                    $aParametro['rst'] = 2;
                }
                else{
                    DB::beginTransaction();
                    $paginas['estado']=2;
                    $paginas->save(); 
                    
                    $historial= new HistorialPaginaFirma;
                    $historial->usuario_id=Auth::user()->id;
                    $historial->pagina_firma_id=$paginas->id;
                    $historial->save();


                    $delete1='  DELETE FROM escalafon_fichas_recepcion 
                                WHERE escalafon_ficha_id IN 
                                    (SELECT id 
                                    FROM escalafon_fichas 
                                    WHERE desdeh='.$paginas->id.')';
                    $delete2='DELETE FROM escalafon_fichas WHERE desdeh='.$paginas->id;
                    $delete3='DELETE FROM fichas WHERE hoja='.$paginas->id;
                    $delete4='DELETE FROM firmas WHERE pagina_firma_id='.$paginas->id;
                    DB::delete($delete1);
                    DB::delete($delete2);
                    DB::delete($delete3);
                    DB::delete($delete4);
                    
                    DB::commit();
                    $aParametro['msj'] = "Se realizó la eliminación de la página nro ".$pagina;
                    $aParametro['pagina']=$paginas->id;
                    $aParametro['rst'] = 1;
                }
            }
            else{
                $aParametro['msj'] = "Página no existe";
                $aParametro['pagina']=0;
                $aParametro['rst'] = 2;
            }

            return Response::json($aParametro);
        }
    }

    public function postGuardar()
    {
        if ( Request::ajax() ) {
            $fich      =   Input::get('ficha');
            $id         =   Input::get('escalafon_id');
            $aParametro=array();$paginaFirma=array();
            $valida=0;
            $valida= Firma::ValidaFicha($fich);


            if($valida==0){
                DB::beginTransaction();
                $dni        =   Input::get('dni');
                $paterno    =   Input::get('paterno');
                $materno    =   Input::get('materno');
                $nombre     =   Input::get('nombre');
                $paginaFirma=array();

                if( Input::has('pag_id') ){
                    $pagina_id = Input::get('pag_id');
                    $paginaFirma= PaginaFirma::find($pagina_id);
                    $paginaFirma['escalafon_id'] = $id;
                    $paginaFirma['estado'] = 1;
                    $paginaFirma->save();
                }
                else{
                    $paginaFirma= new PaginaFirma;
                    $paginaFirma['escalafon_id'] = $id;
                    $paginaFirma->save();
                }

                for ($i=0; $i < count($dni); $i++) { 

                    $firma=new Firma;
                    $firma["pagina_firma_id"]   = $paginaFirma->id;
                    $firma["ficha"]   =trim($fich);
                    $firma["fila"]    =($i+1);
                    $firma["dni"]     =trim($dni[$i]);
                    $firma["paterno"] =trim($paterno[$i]);
                    $firma["materno"] =trim($materno[$i]);
                    $firma["nombre"]  =trim($nombre[$i]);
                    $firma['conteo']  =0;


                    if( trim($dni[$i])=='' AND trim($paterno[$i])=='' AND trim($materno[$i])=='' AND trim($nombre[$i])=='' ){
                        $firma['conteo']=3;
                    }
                    else if( trim($dni[$i])!='' ){
                        $validadni= Firma::ValidaFirma( trim($dni[$i]) );
                        if( count($validadni)>0 ){
                            $firma['conteo']=2;
                            $firma['estado_firma']=$validadni[0]->ids;
                        }
                    }
                    $firma['usuario_created_at']=Auth::user()->id;
                    $firma->save();

                }
                /**************************************************************/
                $fecha_entrega=date("Y-m-d");
                $desde=trim($fich);
                $hasta=trim($fich);
                $desdeh=$paginaFirma->id;
                $hastah=$paginaFirma->id;

                /***********Entregar*******************************************/
                $sql="  SELECT COUNT(id) cant
                        FROM paginafirma
                        WHERE escalafon_id=".$id;
                $rr= DB::select($sql);

                $escalafonFicha= new EscalafonFichas;
                $escalafonFicha['usuario_created_at']=Auth::user()->id;
                $escalafonFicha['escalafon_id']=$id;
                $escalafonFicha['fecha_entrega']=$fecha_entrega;
                $escalafonFicha['desde']=$desde;
                $escalafonFicha['hasta']=$hasta;
                $escalafonFicha['desdeh']=$desdeh;
                $escalafonFicha['hastah']=$hastah;
                $escalafonFicha['orden']=$rr[0]->cant; 
                $escalafonFicha->save();
                /**************************************************************/
                /***********Recepcionar****************************************/
                $escalafonFichaRecepcion= new EscalafonFichasRecepcion;
                $escalafonFichaRecepcion['usuario_created_at']=Auth::user()->id;
                $escalafonFichaRecepcion['escalafon_ficha_id']=$escalafonFicha->id;
                $escalafonFichaRecepcion['fecha_recepcion']=$fecha_entrega;
                $escalafonFichaRecepcion['desde']=$desde;
                $escalafonFichaRecepcion['hasta']=$hasta;
                $escalafonFichaRecepcion['orden']=$rr[0]->cant;
                $escalafonFichaRecepcion->save();
                /**************************************************************/
                /***********Validar********************************************/
                $ficha=new Ficha;
                $ficha['ficha']=$fich;
                $ficha['hoja']=$paginaFirma->id;
                $ficha['escalafon_ficha_id']=$escalafonFicha->id;
                $ficha['escalafon_ficha_recepcion_id']=$escalafonFichaRecepcion->id;
                $ficha['usuario_created_at']=Auth::user()->id;
                $ficha->save();
                /**************************************************************/
                DB::commit();
                $aParametro['msj'] = "Se realizó ";
                $aParametro['pagina']=$paginaFirma->id;
                $aParametro['rst'] = 1;
                //DB::rollback();

            }
            else{
                $aParametro['msj'] = "Ficha Existente ";
                $aParametro['rst'] = 2;
            }

            return Response::json($aParametro);
        }
    }

    public function postValidar()
    {
        if ( Request::ajax() ) {
            $tipo      =   Input::get('tipo');
            $valor     =   Input::get('valor');
            $array["w"]="";

            if( $tipo=="f" ){
                $array['w']=" AND f.ficha='".$valor."'";
            }
            elseif( $tipo=="p" ){
                $array['w']=" AND f.pagina_firma_id='".$valor."'";
            }
            $valida= Firma::CargarFichaPagina($array);

            $aParametro['rst']=1;
            $aParametro['data']=$valida;

            return Response::json($aParametro);
        }
    }

    public function postValidarpagina()
    {
        if ( Request::ajax() ) {
            $p      =   Input::get('p');

            $valida= Firma::ValidaPagina($p);

            return Response::json($valida);
        }
    }

    public function postValidarreniec()
    {
        if ( Request::ajax() ) {
            $inicio=Input::get('inicio');
            $fin=Input::get('fin');
            $array["w"]=" AND pagina_firma_id BETWEEN '".$inicio."' AND '".$fin."' ";
            $listaFirmas= Firma::ListarFirmas($array);
            DB::beginTransaction();
            for ($i=0; $i<count($listaFirmas); $i++) {
                $dnombre=explode(" ",$listaFirmas[$i]->nombre);
                $nombre=$dnombre[0];
                $paterno=$listaFirmas[$i]->paterno;
                $materno=$listaFirmas[$i]->materno;
                $dni=$listaFirmas[$i]->dni;
                $id=$listaFirmas[$i]->id;
                $conteo=$listaFirmas[$i]->conteo;
                $estado_firma=$listaFirmas[$i]->estado_firma;

                $f=Firma::find($id);
                $f['valida']=1;
                $f['conteo']=2;
                $f['tconteo']=0;
                $f['rdni']='';
                $f['rpaterno']='';
                $f['rmaterno']='';
                $f['rnombres']='';
                if( trim($estado_firma)=='' ){
                    if( $conteo!=3 ){

                        $array["w"]="   AND dni='".$dni."' ";
                        $reniec=Firma::ValidarReniec($array);
                        
                        if( count($reniec)>0 ){
                            $f['conteo']=2;
                            $f['tconteo']=1;
                            $drnombre=explode(" ",trim($reniec[0]->nombres));
                            $rnombre=$drnombre[0];
                                if( strtoupper($paterno)==$reniec[0]->paterno AND strtoupper($materno)==$reniec[0]->materno AND strtoupper($nombre)==$rnombre )
                                {
                                    $f['conteo']=1;
                                    $f['tconteo']=0;
                                }
                                else{
                                    if( strtoupper($paterno)==$reniec[0]->paterno OR strtoupper($materno)==$reniec[0]->materno ){
                                        $f['conteo']=4;
                                    }
                                    $f['rdni']=$reniec[0]->dni;
                                    $f['rpaterno']=$reniec[0]->paterno;
                                    $f['rmaterno']=$reniec[0]->materno;
                                    $f['rnombres']=$reniec[0]->nombres;
                                }
                        }

                        if( $f['conteo']==2 || $f['conteo']==4 ){
                        $array["w"]="   AND paterno='".$paterno."'
                                        AND materno='".$materno."'
                                        AND substr(nombres,1,(LENGTH('".$nombre."')-2) )=substr('".$nombre."',1,(LENGTH('".$nombre."')-2) )
                                        AND dni!='".$dni."'
                                    ";
                        $reniec2=Firma::ValidarReniec($array);
                            if( count($reniec2)>0 AND count($reniec2)<3 ){
                                for ( $j=0; $j<count($reniec2); $j++) {
                                    $f['rdni'].="|".$reniec2[$j]->dni;
                                    $f['rpaterno'].="|".$reniec2[$j]->paterno;
                                    $f['rmaterno'].="|".$reniec2[$j]->materno;
                                    $f['rnombres'].="|".$reniec2[$j]->nombres;
                                    $f['conteo']=4;
                                    if( $f['tconteo']!=1 ){
                                        $f['tconteo']=2;
                                    }
                                }
                            }
                        }

                        if( $f['rdni']=='' AND $f['conteo']==2 ){
                            $f['tconteo']=3;
                        }
                    }
                    else{
                        $f['conteo']=3;
                        $f['tconteo']=0;
                    }
                }
                else{
                    $f['conteo']=2;
                    $f['tconteo']=4;
                }

                $f['usuario_updated_at']=Auth::user()->id;
                $f->save();
            }
            DB::commit();
            $aParametro['rst']=1;
            $aParametro['msj']="Se validaron las páginas entre el nro ".$inicio." y el nro ".$fin;
            return Response::json($aParametro);
        }
    }

    public function postActualizar()
    {
        if ( Request::ajax() ) {
            $dniG= Input::get('dni');
            $paternoG= Input::get('paterno');
            $maternoG= Input::get('materno');
            $nombreG= Input::get('nombre');
            $actualizaG= Input::get('actualiza');

            DB::beginTransaction();
            for( $i=0; $i<count($dniG); $i++ ){
                if( $actualizaG[$i]!='0' ){
                    $actg=explode("|",$actualizaG[$i]);
                    $dnombre=explode(" ",$nombreG[$i]);
                    $nombre=$dnombre[0];
                    $paterno=$paternoG[$i];
                    $materno=$maternoG[$i];
                    $dni=$dniG[$i];
                    $id=$actg[1];

                    $f=Firma::find($id);
                    $f['valida']=1;
                    $f['conteo']=2;
                    $f['tconteo']=0;
                    $f['paterno']=$paterno;
                    $f['materno']=$materno;
                    $f['nombre']=$nombreG[$i];
                    $f['dni']=$dni;
                    $f['rdni']='';
                    $f['rpaterno']='';
                    $f['rmaterno']='';
                    $f['rnombres']='';

                    $array["w"]="   AND dni='".$dni."' ";
                    $reniec=Firma::ValidarReniec($array);
                    
                    if( count($reniec)>0 ){
                        $f['conteo']=2;
                        $f['tconteo']=1;
                        $drnombre=explode(" ",trim($reniec[0]->nombres));
                        $rnombre=$drnombre[0];
                            if( strtoupper($paterno)==$reniec[0]->paterno AND strtoupper($materno)==$reniec[0]->materno AND strtoupper($nombre)==$rnombre )
                            {
                                $f['conteo']=1;
                                $f['tconteo']=0;
                            }
                            else{
                                if( strtoupper($paterno)==$reniec[0]->paterno OR strtoupper($materno)==$reniec[0]->materno ){
                                    $f['conteo']=4;
                                }
                                $f['rdni']=$reniec[0]->dni;
                                $f['rpaterno']=$reniec[0]->paterno;
                                $f['rmaterno']=$reniec[0]->materno;
                                $f['rnombres']=$reniec[0]->nombres;
                            }
                    }

                    if( $f['conteo']==2 || $f['conteo']==4 ){
                    $array["w"]="   AND paterno='".$paterno."'
                                    AND materno='".$materno."'
                                    AND substr(nombres,1,(LENGTH('".$nombre."')-2) )=substr('".$nombre."',1,(LENGTH('".$nombre."')-2) )
                                    AND dni!='".$dni."'
                                ";
                    $reniec2=Firma::ValidarReniec($array);
                        if( count($reniec2)>0 AND count($reniec2)<3 ){
                            for ( $j=0; $j<count($reniec2); $j++) {
                                $f['rdni'].="|".$reniec2[$j]->dni;
                                $f['rpaterno'].="|".$reniec2[$j]->paterno;
                                $f['rmaterno'].="|".$reniec2[$j]->materno;
                                $f['rnombres'].="|".$reniec2[$j]->nombres;
                                $f['conteo']=4;
                                if( $f['tconteo']!=1 ){
                                    $f['tconteo']=2;
                                }
                            }
                        }
                    }

                    if( $f['rdni']=='' AND $f['conteo']==2 ){
                        $f['tconteo']=3;
                    }

                    $f['usuario_updated_at']=Auth::user()->id;
                    $f->save();
                }
            }
            DB::commit();
            $aParametro['rst']=1;
            $aParametro['msj']="Se realizaron los cambios correctamente";
            return Response::json($aParametro);
        }
    }

    public function postConsolidado()
    {
        if ( Request::ajax() ) {
            $operador =   Input::get('operador');
            $equipo   =   Input::get('equipo');
            $fecha    =   Input::get('fecha');
            $pini     =   Input::get('pini');
            $pfin     =   Input::get('pfin');

            $array["w"]=""; $w=array();

            if( is_array($operador) ){
                $doperador=implode(",",$operador);
                $array['w'].=" AND a.id IN (".$doperador.") ";
            }
            
            if( $fecha!="" ){
                $f=explode(" - ",$fecha);
                array_push($w, " DATE(f.created_at) BETWEEN '".$f[0]."' AND '".$f[1]."' ");
            }

            if( is_array($equipo) ){
                $dequipo=implode(",",$equipo);
                array_push($w, " FIND_IN_SET(e.grupo_persona_id,'".$dequipo."')>0 ");
            }

            if( $pini!='' AND $pfin!='' ){
                array_push($w, " f.pagina_firma_id BETWEEN '".$pini."' AND '".$pfin."' ");
            }

            if( count($w)>0 ){
                $array['w'].=" AND ".implode("AND",$w)." ";
            }
            $valida= Firma::ConsolidadoFirmas($array);

            $aParametro['rst']=1;
            $aParametro['data']=$valida;

            return Response::json($aParametro);
        }
    }

    public function postDetallado()
    {
        if ( Request::ajax() ) {
            $operador   =   Input::get('operador');
            $fecha      =   Input::get('fecha');
            $equipo   =   Input::get('equipo');
            $pini     =   Input::get('pini');
            $pfin     =   Input::get('pfin');

            $array["w"]=""; $w=array();

            if( is_array($operador) ){
                $doperador=implode(",",$operador);
                $array['w'].=" AND a.id IN (".$doperador.") ";
            }
            
            if( $fecha!="" ){
                $f=explode(" - ",$fecha);
                array_push($w, " DATE(f.created_at) BETWEEN '".$f[0]."' AND '".$f[1]."' ");
            }

            if( is_array($equipo) ){
                $dequipo=implode(",",$equipo);
                array_push($w, " FIND_IN_SET(e.grupo_persona_id,'".$dequipo."')>0 ");
            }

            if( $pini!='' AND $pfin!='' ){
                array_push($w, " f.pagina_firma_id BETWEEN '".$pini."' AND '".$pfin."' ");
            }

            if( count($w)>0 ){
                $array['w'].=" AND ".implode("AND",$w)." ";
            }

            $valida= Firma::DetalladoFirmas($array);

            $aParametro['rst']=1;
            $aParametro['data']=$valida;

            return Response::json($aParametro);
        }
    }

    public function postRegistradosg()
    {
        if ( Request::ajax() ) {
            $fecha      =   Input::get('fecha');
            $equipo   =   Input::get('equipo');
            $visualiza   =   Input::get('visualiza');
            /*$pini     =   Input::get('pini');
            $pfin     =   Input::get('pfin');*/

            $array["w"]=""; $w=array();$array["visualiza"]=$visualiza;

            if( $fecha!="" ){
                $f=explode(" - ",$fecha);
                array_push($w, " DATE(f.created_at) BETWEEN '".$f[0]."' AND '".$f[1]."' ");
            }

            if( is_array($equipo) ){
                $dequipo=implode(",",$equipo);
                array_push($w, " FIND_IN_SET(e.grupo_persona_id,'".$dequipo."')>0 ");
            }

            /*if( $pini!='' AND $pfin!='' ){
                array_push($w, " f.pagina_firma_id BETWEEN '".$pini."' AND '".$pfin."' ");
            }*/

            if( count($w)>0 ){
                $array['w'].=" AND ".implode("AND",$w)." ";
            }
            $valida= Firma::RegistrosFirmasG($array);

            $aParametro['rst']=1;
            $aParametro['data']=$valida;

            return Response::json($aParametro);
        }
    }

    public function postRegistrados()
    {
        if ( Request::ajax() ) {
            $digitador  =   Input::get('digitador');
            $fecha      =   Input::get('fecha');
            $equipo   =   Input::get('equipo');
            $pini     =   Input::get('pini');
            $pfin     =   Input::get('pfin');

            $array["w"]=""; $w=array();

            if( is_array($digitador) ){
                $ddigitador=implode(",",$digitador);
                $array['w'].=" AND a2.id IN (".$ddigitador.") ";
            }
            
            if( $fecha!="" ){
                $f=explode(" - ",$fecha);
                array_push($w, " DATE(f.created_at) BETWEEN '".$f[0]."' AND '".$f[1]."' ");
            }

            if( is_array($equipo) ){
                $dequipo=implode(",",$equipo);
                array_push($w, " FIND_IN_SET(e.grupo_persona_id,'".$dequipo."')>0 ");
            }

            if( $pini!='' AND $pfin!='' ){
                array_push($w, " f.pagina_firma_id BETWEEN '".$pini."' AND '".$pfin."' ");
            }

            if( count($w)>0 ){
                $array['w'].=" AND ".implode("AND",$w)." ";
            }
            $valida= Firma::RegistrosFirmas($array);

            $aParametro['rst']=1;
            $aParametro['data']=$valida;

            return Response::json($aParametro);
        }
    }

    public function postDuplicado()
    {
        if ( Request::ajax() ) {
            $operador   =   Input::get('operador');
            $fecha      =   Input::get('fecha');
            $equipo   =   Input::get('equipo');
            $pini     =   Input::get('pini');
            $pfin     =   Input::get('pfin');
            $array["w"]=""; $w=array();

            if( is_array($operador) ){
                $doperador=implode(",",$operador);
                $array['w'].=" AND a.id IN (".$doperador.") ";
            }
            
            if( $fecha!="" ){
                $f=explode(" - ",$fecha);
                array_push($w, " DATE(f.created_at) BETWEEN '".$f[0]."' AND '".$f[1]."' ");
            }

            if( is_array($equipo) ){
                $dequipo=implode(",",$equipo);
                array_push($w, " FIND_IN_SET(e.grupo_persona_id,'".$dequipo."')>0 ");
            }

            if( $pini!='' AND $pfin!='' ){
                array_push($w, " f.pagina_firma_id BETWEEN '".$pini."' AND '".$pfin."' ");
            }

            if( count($w)>0 ){
                $array['w'].=" AND ".implode("AND",$w)." ";
            }
            $valida= Firma::DuplicadoFirmas($array);

            $aParametro['rst']=1;
            $aParametro['data']=$valida;

            return Response::json($aParametro);
        }
    }

    public function postValidadni()
    {
        if ( Request::ajax() ) {
            $dni      =   Input::get('dni');
            $valida= Firma::ValidaDNI($dni);

            $aParametro['rst']=1;
            $aParametro['msj']=$valida;

            return Response::json($aParametro);
        }
    }

    public function postReservadni()
    {
        if ( Request::ajax() ) {
            $dni      =   Input::get('dni');
            $valida= Firma::ReservaDNI($dni);

            $aParametro['rst']=1;
            $aParametro['msj']=$valida;

            return Response::json($aParametro);
        }
    }

    public function postValidarficha()
    {
        if ( Request::ajax() ) {
            $ficha      =   Input::get('ficha');
            $valida= Firma::ValidaFicha($ficha);

            if($valida==0){
                $msj="Ficha Disponible";
                $aParametro['rst']=1;
            }
            else{
                $aParametro['rst']=2;
                $msj="Ficha Existente";
            }

            $aParametro['msj']=$msj;

            return Response::json($aParametro);
        }
    }

    public function postExportar()
    {

        if ( Request::ajax() ) {
            ini_set('memory_limit','512M');
            set_time_limit(600);
            $result=Firma::select('pagina_firma_id','fila','dni','paterno','materno','nombre')->where('id','<=',1000)->get();

        
        $az=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ');
        $azcount=array(17,17,17,17,17,17,17,18,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15);

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

        $cabecera=array('NUM_PAG','NUM_ITE','NUM_ELE','APE_PAT','APE_MAT','NOM_ADE');

            for($i=0;$i<count($cabecera);$i++){
            $objPHPExcel->getActiveSheet()->setCellValue($az[$i]."1",$cabecera[$i]);
            $objPHPExcel->getActiveSheet()->getStyle($az[$i]."1")->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension($az[$i])->setWidth($azcount[$i]);
            }
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.$az[($i-1)].'1')->applyFromArray($styleAlignmentBold);

        
        $cont=0;
        $valorinicial=1;
        $azcant=0;
        foreach($result as $r){ 
            $cont++;
            $valorinicial++;
            $azcant=0;
            $objPHPExcel->getActiveSheet()->setCellValue($az[$azcant].$valorinicial,$r->pagina_firma_id);
            $objPHPExcel->getActiveSheet()->setCellValue($az[$azcant].$valorinicial,$r->fila);$azcant++;
            $objPHPExcel->getActiveSheet()->setCellValue($az[$azcant].$valorinicial,$r->dni);$azcant++;
            $objPHPExcel->getActiveSheet()->setCellValue($az[$azcant].$valorinicial,$r->paterno);$azcant++;
            $objPHPExcel->getActiveSheet()->setCellValue($az[$azcant].$valorinicial,$r->materno);$azcant++;
            $objPHPExcel->getActiveSheet()->setCellValue($az[$azcant].$valorinicial,$r->nombre);$azcant++;
        }
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.$az[$azcant].$valorinicial)->applyFromArray($styleThinBlackBorderAllborders);
        $objPHPExcel->getActiveSheet()->setTitle('Listado');
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Listado_'.date("Y-m-d_H-i-s").'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;

        }
    }
}
