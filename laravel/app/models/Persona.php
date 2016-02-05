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
    public $table = "activistas";
    
    public static $where =[
                        'id', 'paterno','materno','nombres','email','dni',
                        'password','fecha_nacimiento','sexo', 'estado'
                        ];
    public static $selec =[
                        'id', 'paterno','materno','nombres','email','dni',
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
    public static function getCargar()
    {
        $sql="  SELECT a.id,a.dni,a.paterno,a.materno,a.nombres,a.email,
                a.password, a.fecha_nacimiento,a.sexo,a.estado,
                MAX( IF(pc.estado=1,pc.cargo_id,NULL) ) cargo_id,
                GROUP_CONCAT( CONCAT(c.nombre,'_',pc.created_at) SEPARATOR '|')
                cargos
                FROM activistas a
                INNER JOIN activista_cargo pc ON a.id=pc.activista_id
                INNER JOIN cargos c ON c.id=pc.cargo_id
                GROUP BY a.id";
        $personas = DB::select($sql);

        return $personas;
    }

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


