<?php

class PaginaFirmaController extends \BaseController
{
    public function postPaginaspendientes()
    {
        if ( Request::ajax() ) {
            PaginaFirma::LimpiarNuevamente();
            $r=array();
            $r= PaginaFirma::PaginasPendientes($r);
            $r= PaginaFirma::PaginasPendientesDosCientos($r);
            return Response::json($r);
        }
    }

    public function getPrueba()
    {
        PaginaFirma::LimpiarNuevamente();
        $r=array(); $r2=array();
        $r= PaginaFirma::PaginasPendientesD();
        $limit=count($r);
        $r2= PaginaFirma::PaginasRegistradas($limit,0);
        
        for ($i=0; $i < count($r); $i++) {
            DB::beginTransaction(); 
            $paginaFirmaExistente=PaginaFirma::find($r2[$i]->id);
            $paginaFirmaExistente->estado=2;
            $paginaFirmaExistente->save();


            $paginaFirmaPendiente=PaginaFirma::find($r[$i]->id);
            $paginaFirmaPendiente->pagina_firma_id_cambio=$paginaFirmaExistente->id;
            $paginaFirmaPendiente->escalafon_id=$paginaFirmaExistente->escalafon_id;
            $paginaFirmaPendiente->estado=1;
            $paginaFirmaPendiente->save();

            $sqlfirmas="UPDATE firmas
                        SET pagina_firma_id='".$paginaFirmaPendiente->id."'
                        WHERE pagina_firma_id='".$paginaFirmaExistente->id."'";
            DB::update($sqlfirmas);

            $sqlfichas="UPDATE fichas
                        SET hoja='".$paginaFirmaPendiente->id."'
                        WHERE hoja='".$paginaFirmaExistente->id."'";
            DB::update($sqlfichas);

            $sqlescalafon=" UPDATE escalafon_fichas
                            SET desdeh='".$paginaFirmaPendiente->id."',
                            hastah='".$paginaFirmaPendiente->id."'
                            WHERE desdeh='".$paginaFirmaExistente->id."'";
            DB::update($sqlescalafon);

            DB::commit();
        }

    }

    public function getClasificarDocs()
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
}

