<?php
class CargarController extends BaseController
{
    private $userID;

    public function __construct()
    {
        $this->beforeFilter('auth'); // bloqueo de acceso
        $this->userID = Auth::user()->id;
    }

    public function postAsignacion()
    {
        if (isset($_FILES['carga']) and $_FILES['carga']['size'] > 0) {

            $uploadFolder = 'txt/emails';
            
            if ( !is_dir($uploadFolder) ) {
                mkdir($uploadFolder);
            }

            $nombreArchivo = explode(".",$_FILES['carga']['name']);
            $tmpArchivo = $_FILES['carga']['tmp_name'];
            $archivoNuevo = $nombreArchivo[0]."_u".Auth::user()->id."_".date("Ymd_his")."." . $nombreArchivo[1];
            $file = $uploadFolder . '/' . $archivoNuevo;

            //@unlink($file);

            $m="Ocurrio un error al subir el archivo. No pudo guardarse.";
            if (!move_uploaded_file($tmpArchivo, $file)) {
                return Response::json(
                    array(
                        'upload' => FALSE,
                        'rst'    => '2',
                        'msj'    => $m,
                        'error'  => $_FILES['archivo'],
                    )
                );
            }

            $arrayExist=array();

            $file=file('C:\\wamp\\www\\activista\\public\\txt\\emails\\'.$archivoNuevo);
            //$file=file('/home/castimor/public_html/diagram.process/public/txt/asignacion/'.$archivoNuevo);
            DB::beginTransaction();
                for($i=0; $i < count($file); $i++) {
                    $detfile=explode("\t",$file[$i]);
                    $persona=Persona::where('email','=',trim( $detfile[0]) )
                                    ->get();

                    if( count($persona)==0 ){
                        $arrayExist[]=$detfile[0]."; Email no existe en nuestra base de datos.";
                    }
                    else{
                        foreach ($persona as $key => $value) {
                            $mensajeria= Mensajeria::where('activista_id',$value->id)->first();
                            if( !isset($mensajeria->id) ){
                                $mensajeria= new Mensajeria;
                                $mensajeria->activista_id=$value->id;
                                $mensajeria->usuario_created_at=$this->userID;
                            }
                            else{
                                $mensajeria->usuario_updated_at=$this->userID;
                            }

                            $mensajeria->email=1;
                            $mensajeria->validado=0;
                            $mensajeria->aceptado=0;
                            $mensajeria->save();
                        }
                    }
                }
            DB::commit();

            return Response::json(
                array(
                    'rst'       => '1',
                    'msj'       => 'Archivo procesado correctamente',
                    'file'    => $archivoNuevo,
                    'upload'    => TRUE,
                    'existe'    => $arrayExist
                )
            );
        }
    }

}
