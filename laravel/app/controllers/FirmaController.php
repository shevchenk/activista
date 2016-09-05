<?php

class FirmaController extends \BaseController
{
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

                $paginaFirma= new PaginaFirma;
                $paginaFirma['escalafon_id'] = $id;
                $paginaFirma->save();

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
            $operador   =   Input::get('operador');
            $fecha      =   Input::get('fecha');
            $array["w"]="";

            if( is_array($operador) ){
                $doperador=implode(",",$operador);
                $array['w'].=" AND a.id IN (".$doperador.") ";
            }
            
            if( $fecha!="" ){
                $f=explode(" - ",$fecha);
                $array['w'].=" AND DATE(f.created_at) BETWEEN '".$f[0]."' AND '".$f[1]."' ";
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
            $array["w"]="";

            if( is_array($operador) ){
                $doperador=implode(",",$operador);
                $array['w'].=" AND a.id IN (".$doperador.") ";
            }
            
            if( $fecha!="" ){
                $f=explode(" - ",$fecha);
                $array['w'].=" AND DATE(f.created_at) BETWEEN '".$f[0]."' AND '".$f[1]."' ";
            }
            $valida= Firma::DetalladoFirmas($array);

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
            $array["w"]="";

            if( is_array($digitador) ){
                $ddigitador=implode(",",$digitador);
                $array['w'].=" AND a.id IN (".$ddigitador.") ";
            }
            
            if( $fecha!="" ){
                $f=explode(" - ",$fecha);
                $array['w'].=" AND DATE(f.created_at) BETWEEN '".$f[0]."' AND '".$f[1]."' ";
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
            $array["w"]="";

            if( is_array($operador) ){
                $doperador=implode(",",$operador);
                $array['w'].=" AND a.id IN (".$doperador.") ";
            }
            
            if( $fecha!="" ){
                $f=explode(" - ",$fecha);
                $array['w'].=" AND DATE(f.created_at) BETWEEN '".$f[0]."' AND '".$f[1]."' ";
            }
            $valida= Firma::DuplicadoFirmas($array);

            $aParametro['rst']=1;
            $aParametro['data']=$valida;

            return Response::json($aParametro);
        }
    }
}
