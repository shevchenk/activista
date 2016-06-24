<?php

class CargoEstrategico extends Base
{
    public $table = "cargos_estrategicos";
    public static $where =['id', 'nombre', 'estado'];
    public static $selec =['id', 'nombre', 'estado'];
}
