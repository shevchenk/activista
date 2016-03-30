<?php

class Validar extends Base
{
    public static function Verificar()
    {
        $email=Input::get('email');
        $hash=Input::get('hash');

        $sql="  SELECT count(id) cant
                FROM activistas
                WHERE email='$email'
                AND MD5(concat(id,email))='$hash'";
        $r=DB::select($sql);

        return $r[0]->cant;
    }

    public static function Emailok()
    {
        $email=Input::get('email');
        $hash=Input::get('hash');

        $sql="  SELECT id
                FROM activistas
                WHERE email='$email'
                AND MD5(concat(id,email))='$hash'";
        $r=DB::select($sql);

        $mensajeria= Mensajeria::where('activista_id',$r[0]->id)->first();
        
        if( !isset($mensajeria->id) ){
            $mensajeria= new Mensajeria;
            $mensajeria->activista_id=$r[0]->id;
            $mensajeria->usuario_created_at=1;
        }
        else{
            $mensajeria->usuario_updated_at=1;
        }

        $mensajeria->email=1;
        $mensajeria->validado=1;
        $mensajeria->aceptado=1;
        $mensajeria->save();
    }

}
