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
    @include( 'admin.proceso.js.recepcionarfirma_ajax' )
    @include( 'admin.proceso.js.recepcionarfirma' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Recepcción de las Fichas
            <small> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="#">Proceso</a></li>
            <li class="active">fichas</li>
        </ol>
    </section>

        <!-- Main content -->
        <section class="content">
            <form name="form_personas_equipos" id="form_personas_equipos" method="POST" action="">
                <input type="hidden" name="escalafon" value="1">
                <div class="box-body table-responsive">
                    <div class="col-sm-12">
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
                                <td colspan='5' style='text-align:center; background-color:#A7C0DC;'>
                                    <h2>
                                        Fichas Entregadas
                                    </h2>
                                    <small></small>
                                </td>
                            </tr>
                            <tr>
                                <th style='background-color: #DCE6F1'>Nro Entrega</th>
                                <th style='background-color: #DCE6F1'>Fecha Entrega</th>
                                <th style='background-color: #DCE6F1'>Entrega<br>Desde</th>
                                <th style='background-color: #DCE6F1'>Entrega<br>Hasta</th>
                                <th style='background-color: #DCE6F1'>Total Fichas Entregadas</th>
                                <th>
                                    []
                                </th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                            <tr>
                                <th style='background-color: #DCE6F1'>Nro Entrega</th>
                                <th style='background-color: #DCE6F1'>Fecha Entrega</th>
                                <th style='background-color: #DCE6F1'>Entrega<br>Desde</th>
                                <th style='background-color: #DCE6F1'>Entrega<br>Hasta</th>
                                <th style='background-color: #DCE6F1'>Total Fichas Entregadas</th>
                                <th>
                                    []
                                </th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </form>
            <form name="form_escalafon_fichas_recepcionadas" id="form_escalafon_fichas_recepcionadas" method="POST" action="">
                <div class="box-body table-responsive oculta2">
                    <div class="col-sm-12">
                        <hr>
                        <br>
                        <table id="t_fichas_recepcionadas" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <td colspan='5' style='text-align:center; background-color:#A7C0DC;'>
                                    <h2>
                                        Fichas Recepcionadas
                                    </h2>
                                    <small></small>
                                </td>
                            </tr>
                            <tr>
                                <th style='background-color: #DCE6F1'>Nro<br>Recepción</th>
                                <th style='background-color: #DCE6F1'>Fecha Recepción</th>
                                <th style='background-color: #DCE6F1'>Recepción<br>Desde</th>
                                <th style='background-color: #DCE6F1'>Recepción<br>Hasta</th>
                                <th style='background-color: #DCE6F1'>Total Fichas<br>Recepcionadas</th>
                                <th>
                                    <a class="btn btn-success" onclick="AddTrFichaRecepcionada();"><i class="fa fa-lg fa-plus"></i></a>
                                </th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                            <tr>
                                <th style="text-align:right; background-color: #DCE6F1" colspan="4"> Total de Fichas Recepcionadas: </th>
                                <td><input type="text" id="txt_tr_f" class="form-control" value='0' disabled></td>
                            </tr>
                            <tr>
                                <th style="text-align:right; background-color: #DCE6F1" colspan="4"> Total de Fichas Faltantes: </th>
                                <td><input type="text" id="txt_tf_f" class="form-control" value='0' disabled></td>
                            </tr>
                            <tr>
                                <th style='background-color: #DCE6F1'>Nro<br>Recepción</th>
                                <th style='background-color: #DCE6F1'>Fecha Recepción</th>
                                <th style='background-color: #DCE6F1'>Recepción<br>Desde</th>
                                <th style='background-color: #DCE6F1'>Recepción<br>Hasta</th>
                                <th style='background-color: #DCE6F1'>Total Fichas<br>Recepcionadas</th>
                                <th>
                                    <a class="btn btn-success" onclick="AddTrFichaRecepcionada();"><i class="fa fa-lg fa-plus"></i></a>
                                </th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </form>
            <div class="col-sm-12">
            <hr>
            <br>
            <a class="btn btn-primary oculta2" onclick="Guardar();"><i class="fa fa-lg fa-save"></i>.::Guardar::.</a>
            </div>
    </section><!-- /.content -->
@stop
