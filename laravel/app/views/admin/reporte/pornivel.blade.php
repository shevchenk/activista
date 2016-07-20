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
    @include( 'admin.reporte.js.pornivel_ajax' )
    @include( 'admin.reporte.js.pornivel' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Miembros integrantes de la red social por niveles
            <small> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="#">Reporte</a></li>
            <li class="active">Por Nivel de Red Social</li>
        </ol>
    </section>

        <!-- Main content -->
        <section class="content">
            <!-- Inicia contenido -->
            <div class="box">
                <fieldset>
                    <div class="row form-group" >
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                <label class="control-label">Nivel de Red Social:</label>
                                <select class="form-control" onchange="DetalleNivel();" name="slct_nivel" id="slct_nivel">
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="control-label">Miembro:</label>
                                <select class="form-control" name="slct_persona" id="slct_persona">
                                    <option>.::Seleccione::.    </option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="control-label"></label>
                                <input type="button" class="form-control btn btn-primary" id="generar" name="generar" value="Mostrar">
                            </div>
                        </div>
                    </div>
                    <div class="row form-group" >
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                <label class="control-label">Fecha y hora reporte:</label>
                                <span id="txthora"></span>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div><!-- /.box -->
            <div class="box-body table-responsive">
                <div class="row form-group reportes" id="reporte" style="display:none;">
                    <div class="col-sm-12">
                        <div class="box-body table-responsive">
                            <table id="t_reporte" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nivel de Red Social</th>
                                        <th>Paterno</th>
                                        <th>Materno</th>
                                        <th>Nombre</th>
                                        <th>Dni</th>
                                        <th>Email</th>
                                        <th>Celular</th>
                                        <th>Cant Pag</th>
                                    </tr>
                                </thead>
                                <tbody id="tb_reporte">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nivel de Red Social</th>
                                        <th>Paterno</th>
                                        <th>Materno</th>
                                        <th>Nombre</th>
                                        <th>Dni</th>
                                        <th>Email</th>
                                        <th>Celular</th>
                                        <th>Cant Pag</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.box -->
            <br>
            <br>
            <div class="box-body table-responsive">
                <div class="row form-group reportes" id="reporte2" style="display:none;">
                    <div class="col-sm-12">
                        <table id="t_reporte2" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nivel de Red Social</th>
                                    <th>Total Personas</th>
                                    <th>Total Paginas</th>
                                </tr>
                            </thead>
                            <tbody id="tb_reporte2">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Finaliza contenido -->
        </div>
    </section><!-- /.content -->
@stop
