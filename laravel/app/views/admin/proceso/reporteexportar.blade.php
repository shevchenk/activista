<!DOCTYPE html>
@extends('layouts.master')  

@section('includes')
    @parent
    @include( 'admin.proceso.js.reporteexportar' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Reporte Página Libre
            <small> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="#">Proceso</a></li>
            <li class="active">Reporte Página Libre</li>
        </ol>
    </section>

        <!-- Main content -->
        <section class="content">
            <!-- Inicia contenido -->
            <div class="box">
                <fieldset>
                    <div class="row form-group" >
                    <form name="form_validacion" id="form_validacion" method="POST" action="">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <a id="valida" class="btn btn-primary">
                                    <i class="fa fa-lg fa-file">Exportar</i>
                                </a>
                            </div>
                        </div>
                        <br><hr><br>
                        <div class="col-md-12">
                          <!-- Custom Tabs (Pulled to the right) -->
                          <!-- nav-tabs-custom -->
                        </div>
                    </form>
                    </div>
                </fieldset>

            </div><!-- /.box -->
        </div>
    </section><!-- /.content -->
@stop
