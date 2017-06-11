<!DOCTYPE html>
@extends('layouts.master')  

@section('includes')
    @parent
    {{ HTML::style('lib/daterangepicker/css/daterangepicker-bs3.css') }}
    {{ HTML::style('lib/bootstrap-multiselect/dist/css/bootstrap-multiselect.css') }}
    {{ HTML::script('lib/daterangepicker/js/daterangepicker.js') }}
    {{ HTML::script('lib/bootstrap-multiselect/dist/js/bootstrap-multiselect.js') }}

    @include( 'admin.js.slct_global_ajax' )
    @include( 'admin.js.slct_global' )
    @include( 'admin.proceso.js.reportepagina_ajax' )
    @include( 'admin.proceso.js.reportepagina' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Reporte Página Libre
            <small> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="#">Proceso</a></li>
            <li class="active">Reporte Página Libre</li>
        </ol>
    </section>

        <!-- Main content -->
        <section class="content">
            <!-- Inicia contenido -->
            <div class="box">
                <fieldset>
                    <div class="row form-group" >
                    <form name="form_validacion" id="form_validacion" method="POST" action="">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <a id="valida" class="btn btn-primary">
                                    <i class="fa fa-lg fa-search"></i>
                                </a>
                            </div>
                        </div>
                        <br><hr><br>
                        <div class="col-md-6">
                          <!-- Custom Tabs (Pulled to the right) -->
                          <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs pull-right">
                              <li class="active"><a href="#tab_1-1" data-toggle="tab">Tab 1</a></li>
                              <li><a href="#tab_2-2" data-toggle="tab">Tab 2</a></li>
                            </ul>
                            <div class="tab-content">
                              <div class="tab-pane active" id="tab_1-1">
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                        <th>Página Libre</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                              </div>
                              <!-- /.tab-pane -->
                              <div class="tab-pane" id="tab_2-2">
                                <table id="table2" class="table table-bordered table-striped">
                                    <thead>
                                        <th>Pagina Inicio</th>
                                        <th>Página Final</th>
                                        <th>Página(s) Libre(s)</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                              </div>
                            </div>
                            <!-- /.tab-content -->
                          </div>
                          <!-- nav-tabs-custom -->
                        </div>
                    </form>
                    </div>
                </fieldset>

            </div><!-- /.box -->
        </div>
    </section><!-- /.content -->
@stop
