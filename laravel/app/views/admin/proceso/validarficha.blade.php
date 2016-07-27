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
    @include( 'admin.proceso.js.validarficha_ajax' )
    @include( 'admin.proceso.js.validarficha' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Validación de Firmas
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
                                <th colspan='4' style='text-align:center; background-color:#A7C0DC;'><h2>Datos de Reniec</h2></th>
                                <th colspan='4' style='text-align:center; background-color:#DEACA9;'><h2>Datos de Validación</h2></th>
                            </tr>
                            <tr></tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot><tr></tr></tfoot>
                        </table>
                    </div>
                </div>
            </form>
    </section><!-- /.content -->
@stop
