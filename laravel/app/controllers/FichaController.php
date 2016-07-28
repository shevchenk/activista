<?php

class FichaController extends \BaseController
{
    public function postCargarpersonas()
    {
        if ( Request::ajax() ) {
            $array=array();
            $array['where']='';$array['usuario']=Auth::user()->id;
            $array['limit']='';$array['order']='';

            if( Input::has("paterno") ){
                $array['where'].=" AND r.paterno LIKE '%".Input::get("paterno")."%' ";
            }

            if( Input::has("materno") ){
                $array['where'].=" AND r.materno LIKE '%".Input::get("materno")."%' ";
            }

            if( Input::has("nombres") ){
                $array['where'].=" AND r.nombres LIKE '%".Input::get("nombres")."%' ";
            }

            if( Input::has("dni") ){
                $array['where'].=" AND r.dni LIKE '%".Input::get("dni")."%' ";
            }

            if (Input::has('draw')) {
                if (Input::has('order')) {
                    $inorder=Input::get('order');
                    $incolumns=Input::get('columns');
                    $array['order']=  ' ORDER BY '.
                                      $incolumns[ $inorder[0]['column'] ]['name'].' '.
                                      $inorder[0]['dir'];
                }

                $array['limit']=' LIMIT '.Input::get('start').','.Input::get('length');
                $retorno["draw"]=Input::get('draw');
            }
            
            $array['order']=" ORDER BY r.paterno,r.materno,r.nombres ";

            $cant  = Ficha::getCargarReniecCount( $array );
            $aData = Ficha::getCargarReniec( $array );

            $aParametro['rst'] = 1;
            $aParametro["recordsTotal"]=$cant;
            $aParametro["recordsFiltered"]=$cant;
            $aParametro['data'] = $aData;
            $aParametro['msj'] = "No hay registros aún";
            return Response::json($aParametro);
        }
    }

    public function postBuscardni()
    {
        if ( Request::ajax() ) {
            $dni=Input::get('dni');
            $ficha=Input::get('ficha');
            $aData=Reniec::getPersona($dni);

            $aParametro['data'] = $aData;
            $aParametro['rst'] = 1;
            $aParametro['msj'] = "";
            if( COUNT($aData)==0 ){
                $ef=EscalafonFichas::getEFIdporFicha($ficha);
                $efr=EscalafonFichas::getEFRIdporFicha($ficha);

                $ficham= new Ficha;
                if( count($ef)>0 ){
                    $ficham['escalafon_ficha_id']=$ef[0]->id;

                    if( count($efr)>0 ){
                        $ficham['escalafon_ficha_recepcion_id']=$efr[0]->id;
                    }
                }
                $ficham['ficha']=$ficha;
                $ficham['estado_ficha']=3;
                $ficham['usuario_created_at']=Auth::user()->id;
                $ficham->save();

                $aParametro['rst'] = 2;
                $aParametro['msj'] = "No Existe persona con el dni:".$dni." Será contabilizada como firma inválida";
            }

            $vef=Ficha::getValidarEstadoFicha($ficha);
            $aParametro['estado']=$vef;


            return Response::json($aParametro);
        }
    }

    public function postBuscarficha()
    {
        if ( Request::ajax() ) {
            $ficha=Input::get('ficha');
            $ef=EscalafonFichas::getEFIdporFicha($ficha);
            $efr=EscalafonFichas::getEFRIdporFicha($ficha);
            $vef=Ficha::getValidarEstadoFicha($ficha);

            $crearFicha=true;
            $estado=5;
            if( count($ef)>0 ){
                $estado=4;
                if( count($efr)>0 ){
                    $crearFicha=false;
                }
            }

            if( $crearFicha ){
                $ficham= new Ficha;
                if( count($ef)>0 ){
                    $ficham['escalafon_ficha_id']=$ef[0]->id;
                }
                $ficham['ficha']=$ficha;
                $ficham['estado_ficha']=$estado;
                $ficham['usuario_created_at']=Auth::user()->id;
                $ficham->save();
            }

            $aParametro['rst'] = 1;
            $aParametro['estado']=$vef;
            $aParametro['msj'] = "Ficha Válida";
            if( count($ef)==0 ){
                $aParametro['rst'] = 2;
                $aParametro['msj'] = "Ficha inválida, No fué Entregada";
            }
            elseif( count($efr)==0 ){
                $aParametro['rst'] = 2;
                $aParametro['msj'] = "Ficha inválida, No fué Recepcionada";
            }
            return Response::json($aParametro);
        }
    }

    public function postFirmasvalidas()
    {
        if ( Request::ajax() ) {
            $escalafon_id=Input::get('escalafon_id');
            $datos=Ficha::getCargarFirmasValidas($escalafon_id);
            $aParametro['rst'] = 1;
            $aParametro['datos']=$datos;
            return Response::json($aParametro);
        }
    }

    public function postValidarficha()
    {
        if ( Request::ajax() ) {
            
            $ficha=Input::get('ficha');
            $reniec=Input::get('reniec');
            $fichaId=Input::get('ficha_id');
            $paternon=Input::get('paternon');
            $maternon=Input::get('maternon');
            $nombresn=Input::get('nombresn');

            $paterno=Input::get('paterno');
            $materno=Input::get('materno');
            $nombres=Input::get('nombres');
            $dni=Input::get('dni');



            if($reniec!='' && $fichaId!=''){
                $fichama = Ficha::find($fichaId);
                $fichama['usuario_updated_at']=Auth::user()->id;
                $fichama['reniec_id']=$reniec;
                $fichama['estado']=0;
                $fichama->save();
            }

            $ef=EscalafonFichas::getEFIdporFicha($ficha);
            $efr=EscalafonFichas::getEFRIdporFicha($ficha);

            $ficham= new Ficha;
            if($reniec!=''){
                $ficham['reniec_id']=$reniec;
                $ficham['dni']=$dni;
            }
            if( count($ef)>0 ){
                $ficham['escalafon_ficha_id']=$ef[0]->id;

                if( count($efr)>0 ){
                    $ficham['escalafon_ficha_recepcion_id']=$efr[0]->id;
                }
            }

            $estadoFicha=0; //No existe dni
            if( strcasecmp($paternon,$paterno)!=0 OR strcasecmp($maternon,$materno)!=0 OR strcasecmp($nombresn,$nombres)!=0  ){
                $estadoFicha=2; // no existe asignación de entrega y recepción
            }
            elseif( strcasecmp($paternon,$paterno)==0 AND strcasecmp($maternon,$materno)==0 AND strcasecmp($nombresn,$nombres)==0 ){
                $estadoFicha=1; // no existe asignación de recepción
            }

            $ficham['ficha']=$ficha;
            $ficham['paterno']=$paternon;
            $ficham['materno']=$maternon;
            $ficham['nombres']=$nombresn;
            $ficham['estado_ficha']=$estadoFicha;
            $ficham['usuario_created_at']=Auth::user()->id;
            $ficham->save();

            if($reniec!=''){
                $reniecm= Reniec::find($reniec);
                $reniecm['ficha_id']=$ficham->id;
                $reniecm['usuario_updated_at']=Auth::user()->id;
                $reniecm->save();
            }
            $vef=Ficha::getValidarEstadoFicha($ficha);
            
            return Response::json(array('rst'=>1,'msj'=>'Se registró la validación','estado'=>$vef));
        }
    }
}
