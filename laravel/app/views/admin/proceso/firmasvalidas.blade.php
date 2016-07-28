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
    @include( 'admin.proceso.js.firmasvalidas_ajax' )
    @include( 'admin.proceso.js.firmasvalidas' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Registro de Recepción de las Fichas
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
            <br>
            <hr>
            <div class="col-sm-12">
                <div class="box-body table-responsive">
                    <table id="t_resultado" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th colspan='7' style='text-align:center; background-color:#A7C0DC;'><h2>Estado de validación de firmas</h2></th>
                        </tr>
                        <tr>
                            <th style='text-align:center; background-color:#DCE6F1;'>Nro Ficha</th>
                            <th style='text-align:center; background-color:#DCE6F1;'>Buenas</th>
                            <th style='text-align:center; background-color:#DCE6F1;'>Malas</th>
                            <th style='text-align:center; background-color:#DCE6F1;'>No Existe DNI</th>
                            <th style='text-align:center; background-color:#DCE6F1;'>Total Firmas</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
    </section><!-- /.content -->
@stop
