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

    public function postValidarFicha()
    {
        if ( Request::ajax() ) {
            $array=array();
            $array['where']='';$array['usuario']=Auth::user()->id;
            $array['limit']='';$array['order']=' ORDER BY efr.orden ';

            if( Input::has("id") ){
                $array['where'].=" AND efr.escalafon_ficha_id='".Input::get("id")."' ";
            }

            $r = EscalafonFichasRecepcion::getValidarFicha( $array );
            return Response::json(array('rst'=>1,'datos'=>$r));
        }
    }
}
