<?php
    $cargoS= Cargo::find(Auth::user()->nivel_id+1);
    if( count($cargoS)<=0 ){
        $cargoS= new stdClass();
        $cargoS->nombre='';
    }
?>
<!-- sidebar menu: : style can be found in sidebar.less -->
                    <!--ul class="sidebar-menu"-->
                        @if (isset($menus))
                            @foreach ( $menus as $key => $val)
                                        @foreach ( $val as $k)
                                            <?php $display=""; 
                                                if($k->visible==0){
                                                    $display="none";
                                                }
                                            ?>

                                                <div class="form-group row options-menu" style="display:{{ $display }}">
                                                    <a   class="col-sm-9 bg-light-blue disabled" href="admin.{{ $k->ruta }}">
                                                        <i class="fa fa-angle-double-right"></i><font size="+1"> <?php echo str_replace('textoSeguir',$cargoS->nombre,$k->opcion) ?></font>
                                                    </a>
                                                </div>

                                        @endforeach
                            @endforeach
                        @endif
                        <div class="form-group row options-menu">
                            <a   class="col-sm-9 bg-light-blue disabled" href="admin.proceso.perfilView">
                                <i class="fa fa-angle-double-right"></i><font size="+1"> Mi Perfil</font>
                            </a>
                        </div>
                        <div class="form-group row options-menu">
                            <a   class="col-sm-9 bg-light-blue disabled" href="admin.mantenimiento.misdatos">
                                <i class="fa fa-angle-double-right"></i><font size="+1"> Cambiar Contraseña</font>
                            </a>
                        </div>
