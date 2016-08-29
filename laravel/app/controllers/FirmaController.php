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
}
