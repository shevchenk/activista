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
    @include( 'admin.proceso.js.validarf' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Validación de Firmas de las Ficha
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
            <form name="form_validacion_personas" id="form_validacion_personas" method="POST" action="">
                <div class="box-body">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <table id="t_fichas" class="table table-condensed">
                            <thead>
                                <tr>
                                <th colspan="2" style='text-align:center; background-color:#A7C0DC;'>Rango de Listas</th>
                                </tr>
                                <tr>
                                <th style='text-align:center; background-color: #DCE6F1'>Inicio</th>
                                <th style='text-align:center; background-color: #DCE6F1'>Final</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input class="form-control" type="text" id="txt_inicio" name="txt_inicio" onBlur="ValidaMenorMayor('txt_inicio','txt_fin',this.parentNode.parentNode);" onKeyUp="ValidaT('txt_inicio','txt_fin',this.parentNode);" onKeyPress="return msjG.validaNumeros(event);">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" id="txt_fin" name="txt_fin" onBlur="ValidaMenorMayor('txt_inicio','txt_fin',this.parentNode.parentNode);" onKeyUp="ValidaT('txt_inicio','txt_fin',this.parentNode);" onKeyPress="return msjG.validaNumeros(event);">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <a class="btn btn-primary">
                                            Buscar<i class="fa fa-lg fa-search"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="col-sm-12 ocultar">
                        <div class="col-sm-2">
                            <a class="btn btn-primary" onclick="GuadarDatos();"> 
                                <i class="fa fa-lg fa-save"></i>
                                Guardar
                            </a>
                        </div>
                    </div>
                </div>
            </form>
    </section><!-- /.content -->
@stop
