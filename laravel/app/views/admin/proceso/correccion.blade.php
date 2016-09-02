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
    @include( 'admin.proceso.js.correccion_ajax' )
    @include( 'admin.proceso.js.correccion' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Corrección de Listado de Adherentes
            <small> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="#">Proceso</a></li>
            <li class="active">Corrección</li>
        </ol>
    </section>

        <!-- Main content -->
        <section class="content">
            <!-- Inicia contenido -->
            <div class="box">
                <fieldset>
                    <div class="row form-group" >
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <label class="control-label">Ficha:</label>
                                <input type="text" class="form-control" name="txt_ficha" id="txt_ficha" onkeypress="return msjG.validaNumeros(event);" onkeyup="LimpiaText('txt_pagina')">
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Página:</label>
                                <input type="text" class="form-control" name="txt_pagina" id="txt_pagina" onkeypress="return msjG.validaNumeros(event);" onkeyup="LimpiaText('txt_ficha')">
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
                                        <th colspan='10' style='text-align:center; background-color:#A7C0DC;'>
                                            <h2 id="responsable"></h2>
                                            <span>Responsable de la Página</span>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Ficha</th>
                                        <th>Fila</th>
                                        <th>DNI</th>
                                        <th>Paterno</th>
                                        <th>Materno</th>
                                        <th>Nombres</th>
                                        <th>Tipo Error</th>
                                        <th style="width:250px !important;">Firma ya Existente</th>
                                        <th>Conteo</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Ficha</th>
                                        <th>Fila</th>
                                        <th>DNI</th>
                                        <th>Paterno</th>
                                        <th>Materno</th>
                                        <th>Nombres</th>
                                        <th>Tipo Error</th>
                                        <th>Firma ya Existente</th>
                                        <th>Conteo</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3">
                                            <a class="btn btn-primary" onclick="Guardar();">
                                                Guardar
                                                <i class="fa fa-lg fa-save">
                                                </i>
                                            </a>
                                        </th>
                                        <th colspan="2">
                                            &nbsp;
                                        </th>
                                        <th colspan="3">
                                            <a class="btn btn-primary" onclick="BuscarReniec();">
                                                Buscar Data en Reniec
                                                <i class="fa fa-lg fa-search">
                                                </i>
                                            </a>
                                        </th>
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
