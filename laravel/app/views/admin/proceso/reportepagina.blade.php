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
    @include( 'admin.proceso.js.eliminapagina_ajax' )
    @include( 'admin.proceso.js.eliminapagina' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Elimina Página
            <small> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="#">Proceso</a></li>
            <li class="active">Elimina Página</li>
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
                                    <i class="fa fa-lg fa-search"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                    </div>
                </fieldset>

            </div><!-- /.box -->
        </div>
    </section><!-- /.content -->
@stop
