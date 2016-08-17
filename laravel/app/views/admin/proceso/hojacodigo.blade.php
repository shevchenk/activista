<!DOCTYPE html>
@extends('layouts.master')  

@section('includes')
    @parent
    @include( 'admin.js.slct_global_ajax' )

    @include( 'admin.proceso.js.hojacodigo_ajax' )
    @include( 'admin.proceso.js.hojacodigo' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Relacionar Hoja - Ficha
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
                                <th colspan="4" style='text-align:center; background-color:#A7C0DC;'>Relación</th>
                                </tr>
                                <tr>
                                <th style='text-align:center; background-color: #DCE6F1'>#</th>
                                <th style='text-align:center; background-color: #DCE6F1'>Hoja</th>
                                <th style='text-align:center; background-color: #DCE6F1'>Fichas</th>
                                <th style='text-align:center; background-color: #DCE6F1'>[]</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">
                                        <a class="btn btn-primary" onClick="Guardar();">
                                            Guardar<i class="fa fa-lg fa-save"></i>
                                        </a>
                                    </td>
                                    <td colspan="2">
                                        <a class="btn btn-danger" onClick="Limpiar();">
                                            Limpiar<i class="fa fa-lg fa-remove"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </form>
    </section><!-- /.content -->
@stop
