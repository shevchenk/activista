<?php

class MensajeriaController extends \BaseController
{
    private $userID;

    public function __construct()
    {
        $this->beforeFilter('auth'); // bloqueo de acceso
        $this->userID = Auth::user()->id;
    }

    public function postValidar()
    {
        if ( Request::ajax() ) {
            
            $personas= Input::get('personas');

            DB::beginTransaction();
            for ($i=0; $i < count($personas); $i++) { 
                $per= explode("_",$personas[$i]);

                $mensajeria= Mensajeria::where('activista_id',$per[1])->first();
                if( !isset($mensajeria->id) ){
                    $mensajeria= new Mensajeria;
                    $mensajeria->activista_id=$per[1];
                    $mensajeria->usuario_created_at=$this->userID;
                }
                else{
                    $mensajeria->usuario_updated_at=$this->userID;
                    $mensajeria->nrollamada=$mensajeria->nrollamada*1+1;
                }

                if( $per[0]=='celular'){
                    $mensajeria->cel=$per[2];
                }
                else{
                    $mensajeria->email=$per[2];
                }
                $mensajeria->save();
            }

            DB::commit();

            return Response::json(
                    array(
                        'rst'=>1,
                        'msj'=>'Se registro correctamente'
                        )
            );
        }
    }
}
