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
    @include( 'admin.mantenimiento.js.pornivelvalida' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Miembros integrantes de la red por Niveles
            <small> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="#">Reporte</a></li>
            <li class="active">Por Nivel</li>
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
                                <label class="control-label">Nivel:</label>
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
                </fieldset>
            </div><!-- /.box -->
            <div class="box-body table-responsive">
                <div class="row form-group reportes" id="reporte" style="display:none;">
                    <div class="col-sm-12">
                        <div class="box-body table-responsive">
                        <form id="formValidar" name="formValidar" action="" method="POST">
                            <table id="t_reporte" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="80px;">Nivel</th>
                                        <th width="80px;">Paterno</th>
                                        <th width="80px;">Materno</th>
                                        <th width="80px;">Nombre</th>
                                        <th width="80px;">Dni</th>
                                        <th width="200px;">
                                            Email
                                            &nbsp;
                                            <a class="btn btn-success btn-sm" onclick="ExportaEmail();">
                                                <i class='fa fa-file-excel-o fa-lg'></i>
                                            </a>
                                        </th>
                                        <th width="100px;">Rpta Email</th>
                                        <th width="150px;">Celular</th>
                                        <th width="30px;">Nro Llamadas</th>
                                        <th width="100px;">Rpta Celular</th>
                                    </tr>
                                </thead>
                                <tbody id="tb_reporte">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nivel</th>
                                        <th>Paterno</th>
                                        <th>Materno</th>
                                        <th>Nombre</th>
                                        <th>Dni</th>
                                        <th>
                                            Email
                                            &nbsp;
                                            <a class="btn btn-success btn-sm" onclick="ExportaEmail();">
                                                <i class='fa fa-file-excel-o fa-lg'></i>
                                            </a>
                                        </th>
                                        <th>Rpta Email</th>
                                        <th>Celular</th>
                                        <th>Nro Llamadas</th>
                                        <th>Rpta Celular</th>
                                    </tr>
                                    <tr>
                                        <td colspan="8">
                                            <a class="btn btn-sm btn-primary" onclick="Guardar();">
                                                <i class="fa fa-save fa-lg"></i>
                                                Guardar
                                            </a>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.box -->
        </div>
    </section><!-- /.content -->
@stop
