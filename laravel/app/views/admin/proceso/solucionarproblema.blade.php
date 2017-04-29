<!DOCTYPE html>
@extends('layouts.master')

@section('includes')
    @parent
    {{ HTML::style('lib/daterangepicker/css/daterangepicker-bs3.css') }}
    {{ HTML::style('lib/bootstrap-multiselect/dist/css/bootstrap-multiselect.css') }}
    {{ HTML::script('//cdn.jsdelivr.net/momentjs/2.9.0/moment.min.js') }}
    {{ HTML::script('lib/daterangepicker/js/daterangepicker_single.js') }}
    {{ HTML::script('lib/bootstrap-multiselect/dist/js/bootstrap-multiselect.js') }}

    @include( 'admin.js.slct_global_ajax' )
    @include( 'admin.js.slct_global' )
    @include( 'admin.proceso.js.solucionarproblema_ajax' )
    @include( 'admin.proceso.js.solucionarproblema' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
            <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Solucionar problemas
                        <small> </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
                        <li><a href="#">Proceso</a></li>
                        <li class="active">Solucionar problemas</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
            <form id="solucion" name="solucion" action="">
                    <div class="row  form-group">
                        <div class="col-xs-12">
                            <div class="col-sm-3">
                                <label class="control-label">Sede:
                                </label>
                                <select class="form-control" name="slct_sede[]" id="slct_sede" multiple>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Tipo problema:
                                </label>
                                <select class="form-control" name="slct_tipo_problema[]" id="slct_tipo_problema" multiple>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Estados:
                                </label>
                                <select class="form-control" name="slct_estado[]" id="slct_estado" multiple>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row  form-group">
                        <div class="col-xs-12">
                            <div class="col-sm-2">
                                <label class="control-label">Fecha Registro Inicio:
                                <input type="text" class="form-control fecha" name="txt_fecha_ini" placeholder="AAAA-MM-DD" id="txt_fecha_ini" onfocus="blur()" required="required"/>
                            </div>
                            <div class="col-sm-1">
                                &nbsp;
                            </div>
                            <div class="col-sm-2">
                                <label class="control-label">Fecha Registro Fin:
                                <input type="text" class="form-control fecha" name="txt_fecha_fin" placeholder="AAAA-MM-DD" id="txt_fecha_fin" onfocus="blur()" required="required"/>
                            </div>
                            <div class="col-sm-3">
                                <br>
                                <a class="btn btn-info btn-sm" id="buscar">
                                    <i class="fa fa-search fa-lg">  Buscar  </i>
                                </a>
                            </div>
                        </div>
                    </div>
            </form>
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- Inicia contenido -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Filtros</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="t_problemas" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nº</th>
                                                <th>Sede</th>
                                                <th>Problema General</th>
                                                <th>Tipo Problema</th>
                                                <th>Descripción</th>
                                                <th>Fecha problema</th>
                                                <th>Fecha registro</th>
                                                <th>Estado problema</th>
                                                <th> [ ] </th>
                                            </tr>
                                        </thead>
                                        <tbody id="tb_problemas">
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nº</th>
                                                <th>Sede</th>
                                                <th>Problema General</th>
                                                <th>Tipo Problema</th>
                                                <th>Descripción</th>
                                                <th>Fecha problema</th>
                                                <th>Fecha registro</th>
                                                <th>Estado problema</th>
                                                <th> [ ] </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            <!-- Finaliza contenido -->
                        </div>
                    </div>

                </section><!-- /.content -->
@stop

@section('formulario')
     @include( 'admin.proceso.form.problemaDetalle' )
@stop
