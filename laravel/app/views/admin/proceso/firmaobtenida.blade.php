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
    @include( 'admin.proceso.js.firmaobtenida_ajax' )
    @include( 'admin.proceso.js.firmaobtenida' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            PLANILLA CONSOLIDADA DE FIRMAS OBTENIDAS POR OPERADORES
            <small> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="#">Reporte</a></li>
            <li class="active">consolidada</li>
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
                                        <th style='background-color: #DCE6F1'>Equipo</th>
                                        <th style='background-color: #DCE6F1'>Operador</th>
                                        <th style='background-color: #DCE6F1'>Fecha</th>
                                        <th style='background-color: #DCE6F1'>Número de<br>Fichas</th>
                                        <th style='background-color: #DCE6F1'>Blancos</th>
                                        <th style='background-color: #DCE6F1'>Duplicados</th>
                                        <th style='background-color: #DCE6F1'>No<br>Válidos</th>
                                        <th style='background-color: #DCE6F1'>Válidos</th>
                                        <th style='background-color: #DCE6F1'>Subsanados</th>
                                        <th style='background-color: #DCE6F1'>Firmas a<br>Pagar</th>
                                        <th style='background-color: #DCE6F1'>Firmas por<br>Operador</th>
                                        <th style='background-color: #DCE6F1'>S/. a Pagar<br>X Operador</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Equipo</th>
                                        <th>Operador</th>
                                        <th>Fecha</th>
                                        <th>Número de<br>Fichas</th>
                                        <th>Blancos</th>
                                        <th>Duplicados</th>
                                        <th>No<br>Válidos</th>
                                        <th>Válidos</th>
                                        <th>Subsanados</th>
                                        <th>Firmas a<br>Pagar</th>
                                        <th>Firmas por<br>Operador</th>
                                        <th>S/. a Pagar<br>X Operador</th>
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
