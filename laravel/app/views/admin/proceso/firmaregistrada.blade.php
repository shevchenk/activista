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
    @include( 'admin.proceso.js.firmaregistrada_ajax' )
    @include( 'admin.proceso.js.firmaregistrada' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            PRODUCCIÓN CONSOLIDADA DE REGISTRO DE FIRMAS
            <small> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="#">Reporte</a></li>
            <li class="active">registros</li>
        </ol>
    </section>

        <!-- Main content -->
        <section class="content">
            <!-- Inicia contenido -->
            <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs logo modal-header">
                <li class="logo tab_1 active">
                    <a href="#tab_1" data-toggle="tab">
                        <button class="btn btn-primary btn-sm"><i class="fa fa-cloud fa-lg"></i> </button>
                        Detalle por Grupo - Digitador
                    </a>
                </li>
                <li class="logo tab_2">
                    <a href="#tab_2" data-toggle="tab">
                        <button class="btn btn-primary btn-sm"><i class="fa fa-cloud fa-lg"></i> </button>
                        Consolidado por Grupo
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1" onclick="ActPest(1);">
                    <div class="box">
                        <fieldset>
                            <div class="row form-group" >
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <label class="control-label">Digitador(a):</label>
                                        <select name="slct_digitador" id="slct_digitador" multiple>
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
                                                <th style='background-color: #DCE6F1'>Digitador(a)</th>
                                                <th style='background-color: #DCE6F1'>Fecha</th>
                                                <th style='background-color: #DCE6F1'>Números de Páginas</th>
                                                <th style='background-color: #DCE6F1'>Números de Firmas</th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Equipo</th>
                                                <th>Digitador(a)</th>
                                                <th>Fecha</th>
                                                <th>Números de Páginas</th>
                                                <th>Números de Firmas</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </fieldset>
                    </div><!-- /.box -->
                </div>
                <div class="tab-pane" id="tab_2" onclick="ActPest(2);">
                    <div class="box">
                        <fieldset>
                            <div class="row form-group" >
                                <div class="col-sm-12">
                                    <div class="col-sm-3">
                                        <label class="control-label">Rango Fecha:</label>
                                        <input type="text" class="form-control fecha" name="txt_fechag" id="txt_fechag">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <label class="control-label">Equipo:</label>
                                        <select name="slct_equipog" id="slct_equipog" multiple>
                                            <option>.::Selecciona::.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-1">
                                        <br>
                                        <a class="btn btn-primary" onclick="ListarG();">
                                            <i class="fa fa-search fa-lg"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <form name="form_reniec_validaciong" id="form_reniec_validaciong" method="POST" action="">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table id="t_personasg" class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th style='background-color: #DCE6F1'>Equipo</th>
                                                <th style='background-color: #DCE6F1'>Fecha</th>
                                                <th style='background-color: #DCE6F1'>Números de Páginas</th>
                                                <th style='background-color: #DCE6F1'>Números de Firmas</th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Equipo</th>
                                                <th>Fecha</th>
                                                <th>Números de Páginas</th>
                                                <th>Números de Firmas</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </fieldset>
                    </div><!-- /.box -->
                </div>
            </div><!-- /.tab-content -->
        </div><!-- nav-tabs-custom -->
        </div>
    </section><!-- /.content -->
@stop
