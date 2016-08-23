<?php

class FirmaController extends \BaseController
{
    public function postGuardar()
    {
        if ( Request::ajax() ) {
            $ficha      =   Input::get('ficha');
            $aParametro=array();$paginaFirma=array();
            $valida=0;
            $valida= Firma::ValidaFicha($ficha);

            if($valida==0){
                DB::beginTransaction();
                $dni        =   Input::get('dni');
                $paterno    =   Input::get('paterno');
                $materno    =   Input::get('materno');
                $nombre     =   Input::get('nombre');

                $paginaFirma= new PaginaFirma;
                $paginaFirma->save();

                for ($i=0; $i < count($dni); $i++) { 

                    $firma=new Firma;
                    $firma["pagina_firma_id"] =$paginaFirma->id;
                    $firma["ficha"]   =trim($ficha);
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
                DB::commit();
                $aParametro['msj'] = "Se realizó ";
                $aParametro['pagina']=$paginaFirma->id;
                $aParametro['rst'] = 1;

            }
            else{
                $aParametro['msj'] = "Ficha Existente ";
                $aParametro['rst'] = 2;
            }

            return Response::json($aParametro);
        }
    }
}
