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
    @include( 'admin.proceso.js.firmaduplicada_ajax' )
    @include( 'admin.proceso.js.firmaduplicada' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            DETALLE DE FIRMAS DUPLICADAS OBTENIDAS POR OPERADORES
            <small> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="#">Reporte</a></li>
            <li class="active">Duplicadas</li>
        </ol>
    </section>

        <!-- Main content -->
        <section class="content">
            <!-- Inicia contenido -->
            <div class="box">
                <fieldset>
                    <div class="row form-group" >
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <label class="control-label">Operador:</label>
                                <select name="slct_operador" id="slct_operador" multiple>
                                    <option>.::Selecciona::.</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <label class="control-label">Rango Fecha:</label>
                                <input type="text" class="form-control fecha" name="txt_fecha" id="txt_fecha">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                <label class="control-label">Equipo:</label>
                                <select name="slct_equipo" id="slct_equipo" multiple>
                                    <option>.::Selecciona::.</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-1">
                                <label class="control-label">Página Inicio:</label>
                                <input type="text" class="form-control" onKeyPress='return msjG.validaNumeros(event);' name="txt_pinicio" id="txt_pinicio">
                            </div>
                            <div class="col-sm-1">
                                <label class="control-label">Página Fin:</label>
                                <input type="text" class="form-control" onKeyPress='return msjG.validaNumeros(event);' name="txt_pfinal" id="txt_pfinal">
                            </div>
                            <div class="col-sm-1">
                                <br>
                                <a class="btn btn-primary" onclick="Listar();">
                                    <i class="fa fa-search fa-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <form name="form_reniec_validacion" id="form_reniec_validacion" method="POST" action="">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table id="t_personas" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th colspan='2' style='text-align:center; background-color:#A7C0DC;'><h2>Adherente</h2></th>
                                        <th colspan='5' style='text-align:center; background-color:#DEACA9;'><h2>Operadores que han obtenido la firma</h2></th>
                                    </tr>
                                    <tr>
                                        <th style='background-color: #DCE6F1'>DNI</th>
                                        <th style='background-color: #DCE6F1'>Apellidos y Nombres</th>
                                        <th style='background-color: #F2DCDB'>Apellidos y Nombres</th>
                                        <th style='background-color: #F2DCDB'>Fecha</th>
                                        <th style='background-color: #F2DCDB'>Ficha</th>
                                        <th style='background-color: #F2DCDB'>Página</th>
                                        <th style='background-color: #F2DCDB'>Fila</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                    <tr>
                                        <th style='background-color: #DCE6F1'>DNI</th>
                                        <th style='background-color: #DCE6F1'>Apellidos y Nombres</th>
                                        <th style='background-color: #F2DCDB'>Apellidos y Nombres</th>
                                        <th style='background-color: #F2DCDB'>Fecha</th>
                                        <th style='background-color: #F2DCDB'>Ficha</th>
                                        <th style='background-color: #F2DCDB'>Página</th>
                                        <th style='background-color: #F2DCDB'>Fila</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </form>
                </fieldset>
            </div><!-- /.box -->
        </div>
    </section><!-- /.content -->
@stop
