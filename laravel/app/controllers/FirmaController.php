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
                $nombre=$listaFirmas[$i]->nombre;
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
                if( trim($estado_firma)=='' ){
                    if( $conteo!=3 ){
                        $array["w"]="   AND (
                                        (paterno='".$paterno."'
                                        AND materno='".$materno."'
                                        AND substr(nombres,1,(LENGTH('".$nombre."')-2) )=substr('".$nombre."',1,(LENGTH('".$nombre."')-2) )
                                        ) OR dni='".$dni."') ";
                        $reniec=Firma::ValidarReniec($array);
                        $reniecdni=0;
                        if( count($reniec)>0 ){
                            for ( $j=0; $j<count($reniec); $j++) {
                                if( $reniecdni==0 ){
                                $f['rdni']=$reniec[$j]->dni;
                                $f['rpaterno']=$reniec[$j]->paterno;
                                $f['rmaterno']=$reniec[$j]->materno;
                                $f['rnombres']=$reniec[$j]->nombres;
                                $f['conteo']=2;
                                $f['tconteo']=2;
                                    if($reniec[$j]->dni==$dni AND $reniecdni==0){
                                        $f['conteo']=2;
                                        $f['tconteo']=1;
                                        if( strtoupper($paterno)==$reniec[$j]->paterno AND strtoupper($materno)==$reniec[$j]->materno AND strtoupper($nombre)==trim($reniec[$j]->nombres) )
                                        {
                                            $f['conteo']=1;
                                            $f['tconteo']=0;
                                        }
                                        $reniecdni++;
                                        break;
                                    }
                                }
                            }
                        }
                        else{
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

                $f['usuario_created_at']=Auth::user()->id;
                $f->save();
            }
            DB::commit();
            $aParametro['rst']=1;
            $aParametro['msj']="Se validaron las páginas entre el nro ".$inicio." y el nro ".$fin;
            return Response::json($aParametro);
        }
    }
}
