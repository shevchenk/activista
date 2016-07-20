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
    @include( 'admin.mantenimiento.js.porniveledit' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Editar Celular y Email de los miembros integrantes de su red social
            <small> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="#">Reporte</a></li>
            <li class="active">Editar Celular y Emaild</li>
        </ol>
    </section>

        <!-- Main content -->
        <section class="content">
            <!-- Inicia contenido -->
            <div class="box">
                <fieldset>
                </fieldset>
            </div><!-- /.box -->
            <div class="box-body table-responsive">
                <div class="row form-group reportes" id="reporte" style="display:none;">
                    <div class="col-sm-12">
                        <div class="box-body table-responsive">
                        <form name="formEdit" id="formEdit" method="post" action="">
                            <table id="t_reporte" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="100px;">Nivel de Red Social</th>
                                        <th width="100px;">Paterno</th>
                                        <th width="100px;">Materno</th>
                                        <th width="100px;">Nombre</th>
                                        <th width="80px;">Dni</th>
                                        <th width="250px;">Email</th>
                                        <th width="150px;">Celular</th>
                                        <th width="70px;">[]</th>
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
                                        <th>[]</th>
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
            <!-- Finaliza contenido -->
        </div>
    </section><!-- /.content -->
@stop
