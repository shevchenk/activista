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

                                                <a  style="display:{{ $display }}" class="col-sm-9 btn btn-app" href="admin.{{ $k->ruta }}">
                                                    <i class="fa fa-angle-double-right"></i><font size="+1"> {{ $k->opcion }}</font>
                                                </a>
                                                <br>
                                        @endforeach
                            @endforeach
                        @endif
                        <!--li class="treeview">
                            <a href="#">
                                <i class="fa fa-shield"></i> <span>{{ trans('greetings.menu_info') }}</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="admin.mantenimiento.misdatos"><i class="fa fa-angle-double-right"></i>{{ trans('greetings.menu_info_actualizar') }} </a></li>
                            </ul>
                        </li-->
                    <!--/ul-->
