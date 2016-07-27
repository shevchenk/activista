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
            $aData=Reniec::getPersona($dni);

            $aParametro['data'] = $aData;
            $aParametro['rst'] = 1;
            $aParametro['msj'] = "";
            if( COUNT($aData)==0 ){
                $aParametro['rst'] = 2;
                $aParametro['msj'] = "No Existe persona con el dni:".$dni;
            }
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
            if( $reniec=='' AND count($ef)==0 ){
                $estadoFicha=9; // no existe asignación de entrega y recepción y no existe persona
            }
            elseif( $reniec=='' AND count($ef)>0 AND count($efr)==0 ){
                $estadoFicha=8; // no existe asignación de entrega y recepción y no existe persona
            }
            elseif( $reniec=='' AND count($ef)>0 AND count($efr)>0 ){
                $estadoFicha=7; // no existe asignación de entrega y recepción y no existe persona
            }
            elseif( $reniec!='' AND ($paternon!=$paterno OR $maternon!=$materno OR $nombresn!=$nombres) AND count($ef)==0 ){
                $estadoFicha=6; // no existe asignación de entrega y recepción y no existe persona
            }
            elseif( $reniec!='' AND ($paternon==$paterno OR $maternon==$materno OR $nombresn==$nombres) AND count($ef)>0 AND count($efr)==0 ){
                $estadoFicha=5; // no existe asignación de recepción y no existe persona
            }
            elseif( $reniec!='' AND ($paternon==$paterno OR $maternon==$materno OR $nombresn==$nombres) AND count($ef)>0 AND count($efr)>0 ){
                $estadoFicha=4; // no existe asignación de recepción y no existe persona
            }
            elseif( $reniec!='' AND $paternon==$paterno AND $maternon==$materno AND $nombresn==$nombres AND count($ef)==0 ){
                $estadoFicha=3; // no existe asignación de entrega y recepción
            }
            elseif( $reniec!='' AND $paternon==$paterno AND $maternon==$materno AND $nombresn==$nombres AND count($ef)>0 AND count($efr)==0 ){
                $estadoFicha=2; // no existe asignación de recepción
            }
            else if( $reniec!='' AND $paternon==$paterno AND $maternon==$materno AND $nombresn==$nombres ){
                $estadoFicha=1; // si existe y es válido
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
            
            return Response::json(array('rst'=>1,'msj'=>'Se registró la validación'));
        }
    }
}
