<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Persona extends Base implements UserInterface, RemindableInterface
{
    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $table = "personas";
    
    public static $where =[
                        'id', 'paterno','materno','nombre','email','dni',
                        'password','fecha_nacimiento','sexo', 'estado'
                        ];
    public static $selec =[
                        'id', 'paterno','materno','nombre','email','dni',
                        'password','fecha_nacimiento','sexo', 'estado'
                        ];
    public static function get(array $data =array()){

        //recorrer la consulta
        $personas = parent::get( $data);

        foreach ($personas as $key => $value) {
            if ($key=='password') {
                $personas[$key]['password']='';
            }
        }

        return $personas;
    }
    /**
     * Cargos relationship
     */
    public function cargos()
    {
        return $this->belongsToMany('Cargo');
    }
    public static function getSedes($personaId)
    {
        //subconsulta
        $sql = DB::table('cargo_persona as cp')
        ->join(
            'cargos as c', 
            'cp.cargo_id', '=', 'c.id'
        )
        ->join(
            'sede_cargo_persona as acp', 
            'cp.id', '=', 'acp.cargo_persona_id'
        )
        ->join(
            'sedes as a', 
            'acp.sede_id', '=', 'a.id'
        )
        ->select(
            DB::raw(
                "
                CONCAT(c.id, '-',
                    GROUP_CONCAT(a.id)
                ) AS info"
            )
        )
        ->whereRaw("cp.persona_id=$personaId AND cp.estado=1 AND c.estado=1 AND acp.estado=1")
        //->where("cp.persona_id",$personaId)
        //->where("cp.estado","1")
        //->where("c.estado","1")
        //->where("acp.estado","1")
        ->groupBy('c.id');
        //consulta
        $sedes = DB::table(DB::raw("(".$sql->toSql().") as a"))
                ->select(
                    DB::raw("GROUP_CONCAT( info SEPARATOR '|'  ) as DATA ")
                )
               ->get();

        return $sedes;
    }

}


