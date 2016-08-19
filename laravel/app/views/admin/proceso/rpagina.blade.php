<!DOCTYPE html>
@extends('layouts.master')  

@section('includes')
    @parent
    {{ HTML::style('lib/daterangepicker/css/daterangepicker-bs3.css') }}
    {{ HTML::style('lib/bootstrap-multiselect/dist/css/bootstrap-multiselect.css') }}
    {{ HTML::script('lib/daterangepicker/js/daterangepicker.js') }}
    {{ HTML::script('lib/bootstrap-multiselect/dist/js/bootstrap-multiselect.js') }}
    {{ HTML::script('lib/momentjs/2.9.0/moment.min.js') }}
    {{ HTML::script('lib/daterangepicker/js/daterangepicker_single.js') }}

    @include( 'admin.js.slct_global_ajax' )
    @include( 'admin.js.slct_global' )
    @include( 'admin.proceso.js.rpagina_ajax' )
    @include( 'admin.proceso.js.rpagina' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Registrar firmas del listado de Adherentes
            <small> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="#">Proceso</a></li>
            <li class="active">Firmas</li>
        </ol>
    </section>

        <!-- Main content -->
        <section class="content">
            <form name="form_personas_equipos" id="form_personas_equipos" method="POST" action="">
                <div class="box-body table-responsive">
                    <div class="col-sm-12">
                        <input type="hidden" name="escalafong" value="1">
                        <table id="t_personas_equipos" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th colspan='7' style='text-align:center; background-color:#A7C0DC;'><h2>Datos de la Persona</h2></th>
                                <th colspan='5' style='text-align:center; background-color:#DEACA9;'><h2>Datos del Equipo</h2></th>
                            </tr>
                            <tr></tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot><tr></tr></tfoot>
                        </table>
                    </div>
                </div>
            </form>
            <form name="form_escalafon_fichas" id="form_escalafon_fichas" method="POST" action="">
                <div class="box-body table-responsive oculta">
                    <div class="col-sm-12">
                        <hr>
                        <br>
                        <table id="t_fichas" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <td colspan="2" style='text-align:center; background-color:#A7C0DC;'>
                                    <label id="titulo"><h2><b>Ficha:</b></h2></label>
                                    <input type="text" name="txt_nro_ficha" id="txt_nro_ficha" onKeyPress="return msjG.validaNumeros(event);" class="form-control input-lg" onBlur="ListarFicha(this.value);" onKeyUp="enterGlobal(event,'titulo')">
                                </td>
                                <td colspan='4' style='text-align:center; background-color:#A7C0DC;'>
                                    <h2>
                                        <b>Responsable de la Página</b>
                                    </h2>
                                    <span></span>
                                </td>
                            </tr>
                            <tr>
                                <th style='background-color: #DCE6F1'>Ficha</th>
                                <th style='background-color: #DCE6F1'>Fila</th>
                                <th style='background-color: #DCE6F1'>DNI</th>
                                <th style='background-color: #DCE6F1'>Paterno</th>
                                <th style='background-color: #DCE6F1'>Materno</th>
                                <th style='background-color: #DCE6F1'>Nombres</th>
                                <th>[]</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                            <tr>
                                <th style='background-color: #DCE6F1'>Ficha</th>
                                <th style='background-color: #DCE6F1'>Fila</th>
                                <th style='background-color: #DCE6F1'>DNI</th>
                                <th style='background-color: #DCE6F1'>Paterno</th>
                                <th style='background-color: #DCE6F1'>Materno</th>
                                <th style='background-color: #DCE6F1'>Nombres</th>
                                <th>[]</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-sm-12">
                    <hr>
                    <br>
                    <a class="btn btn-primary oculta2" onclick="Guardar();"><i class="fa fa-lg fa-save"></i>.::Guardar::.</a>
                </div>
            </form>
    </section><!-- /.content -->
@stop
