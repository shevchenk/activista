<!DOCTYPE html>
@extends('layouts.master')  

@section('includes')
    @parent
    {{ HTML::style('lib/daterangepicker/css/daterangepicker-bs3.css') }}
    {{ HTML::style('lib/bootstrap-multiselect/dist/css/bootstrap-multiselect.css') }}
    {{ HTML::script('//cdn.jsdelivr.net/momentjs/2.9.0/moment.min.js') }}
    {{ HTML::script('lib/daterangepicker/js/daterangepicker_single.js') }}
    {{ HTML::script('lib/bootstrap-multiselect/dist/js/bootstrap-multiselect.js') }}

    @include( 'admin.js.slct_global_ajax' )
    @include( 'admin.js.slct_global' )
    @include( 'admin.mantenimiento.js.equipo_ajax' )
    @include( 'admin.mantenimiento.js.equipo' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Estructura Organizacional
                <small> </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
                <li><a href="#">Gestiones</a></li>
                <li class="active">Estructura Oranizacional</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- Inicia contenido -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs logo modal-header">
                            <li class="logo tab_1 active">
                                <a href="#tab_1" data-toggle="tab" onclick="ActPest(1);">
                                    <button class="btn btn-primary btn-sm"><i class="fa fa-cloud fa-lg"></i> </button>
                                    Gestión de Equipos
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <br>
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <div class="box-body table-responsive">
                                            <table id="t_grupo" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo Equipo</th>
                                                        <th>Equipo</th>
                                                        <th>Región</th>
                                                        <th>Provincia</th>
                                                        <th>Distrito</th>
                                                        <th>Localidad</th>
                                                        <th>Dirección</th>
                                                        <th>Teléfono Local</th>
                                                        <th>Estado</th>
                                                        <th> [ ] </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Tipo Equipo</th>
                                                        <th>Equipo</th>
                                                        <th>Región</th>
                                                        <th>Provincia</th>
                                                        <th>Distrito</th>
                                                        <th>Localidad</th>
                                                        <th>Dirección</th>
                                                        <th>Teléfono Local</th>
                                                        <th>Estado</th>
                                                        <th> [ ] </th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <a class='btn btn-primary btn-sm' class="btn btn-primary" 
                                            data-toggle="modal" data-target="#grupoModal" data-titulo="Nuevo"><i class="fa fa-plus fa-lg"></i>&nbsp;Nuevo</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Finaliza contenido -->
                </div>
            </div>

        </section><!-- /.content -->
@stop

@section('formulario')
     @include( 'admin.mantenimiento.form.grupo' )
     @include( 'admin.mantenimiento.form.cargo_estrategico' )
     @include( 'admin.mantenimiento.form.grupo_cargo' )
@stop
