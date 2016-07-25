<?php

class EscalafonFichasController extends \BaseController
{
    public function postCargarentregas()
    {
        if ( Request::ajax() ) {
            $array=array();
            $array['where']='';$array['usuario']=Auth::user()->id;
            $array['limit']='';$array['order']=' ORDER BY ef.orden ';

            if( Input::has("id") ){
                $array['where'].=" AND ef.escalafon_id='".Input::get("id")."' ";
            }

            $r = EscalafonFichas::getCargarEntregas( $array );
            return Response::json(array('rst'=>1,'datos'=>$r));
        }
    }

    public function postCargarrecepcion()
    {
        if ( Request::ajax() ) {
            $array=array();
            $array['where']='';$array['usuario']=Auth::user()->id;
            $array['limit']='';$array['order']=' ORDER BY efr.orden ';

            if( Input::has("id") ){
                $array['where'].=" AND efr.escalafon_ficha_id='".Input::get("id")."' ";
            }

            $r = EscalafonFichasRecepcion::getCargarRecepcion( $array );
            return Response::json(array('rst'=>1,'datos'=>$r));
        }
    }

    public function postCreareditar()
    {
        if ( Request::ajax() ) {
            $id=Input::get('escalafon_id');
            $ids=Input::get('ids');
            $fecha_entrega=Input::get('fecha_entrega');
            $desde=Input::get('desde');
            $hasta=Input::get('hasta');

            DB::beginTransaction();
            EscalafonFichas::where('escalafon_id', $id)
            ->update(
                array(
                    'estado' => 0,
                    'usuario_updated_at' => Auth::user()->id
                )
            );

            for ($i=0; $i < count($ids); $i++) { 
                if( $ids[$i]!='' ){
                    $escalafonFicha= EscalafonFichas::find( $ids[$i] );
                    $escalafonFicha['usuario_updated_at']=Auth::user()->id;
                    $escalafonFicha['estado']=1;
                }
                else{
                    $escalafonFicha= new EscalafonFichas;
                    $escalafonFicha['usuario_created_at']=Auth::user()->id;
                }
                    $escalafonFicha['escalafon_id']=$id;
                    $escalafonFicha['fecha_entrega']=$fecha_entrega[$i];
                    $escalafonFicha['desde']=$desde[$i];
                    $escalafonFicha['hasta']=$hasta[$i];
                    $escalafonFicha['orden']=$i+1;
                    $escalafonFicha->save();
            }
            DB::commit();
            return Response::json(array('rst'=>1,'msj'=>'Datos Actualizados'));
        }
    }

    public function postCreareditarrecepcion()
    {
        if ( Request::ajax() ) {
            $id=Input::get('escalafon_ficha_id');
            $ids=Input::get('ids');
            $fecha_recepcion=Input::get('fecha_recepcion');
            $desde=Input::get('desde');
            $hasta=Input::get('hasta');

            DB::beginTransaction();
            EscalafonFichasRecepcion::where('escalafon_ficha_id', $id)
            ->update(
                array(
                    'estado' => 0,
                    'usuario_updated_at' => Auth::user()->id
                )
            );

            for ($i=0; $i < count($ids); $i++) { 
                if( $ids[$i]!='' ){
                    $escalafonFicha= EscalafonFichasRecepcion::find( $ids[$i] );
                    $escalafonFicha['usuario_updated_at']=Auth::user()->id;
                    $escalafonFicha['estado']=1;
                }
                else{
                    $escalafonFicha= new EscalafonFichasRecepcion;
                    $escalafonFicha['usuario_created_at']=Auth::user()->id;
                }
                    $escalafonFicha['escalafon_ficha_id']=$id;
                    $escalafonFicha['fecha_recepcion']=$fecha_recepcion[$i];
                    $escalafonFicha['desde']=$desde[$i];
                    $escalafonFicha['hasta']=$hasta[$i];
                    $escalafonFicha['orden']=$i+1;
                    $escalafonFicha->save();
            }
            DB::commit();
            return Response::json(array('rst'=>1,'msj'=>'Datos Actualizados'));
        }
    }

    public function postEditarvalidacion()
    {
        if ( Request::ajax() ) {
            $ids=Input::get('ids');
            $buena=Input::get('buena');
            $mala=Input::get('mala');

            DB::beginTransaction();
            for ($i=0; $i < count($ids); $i++) { 
                $escalafonFicha= EscalafonFichasRecepcion::find( $ids[$i] );
                    if( trim($buena[$i])!='' ){
                        $escalafonFicha['buena']=$buena[$i];
                        $escalafonFicha['mala']=$mala[$i];
                    }
                    else{
                        $escalafonFicha['buena']=NULL;
                        $escalafonFicha['mala']=NULL;
                    }
                $escalafonFicha->save();
            }
            DB::commit();
            return Response::json(array('rst'=>1,'msj'=>'Datos Actualizados'));
        }
    }

}
