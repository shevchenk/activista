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
                <div class="box-body table-responsive">
                    <div class="col-sm-12">
                        <h2 id="h2_ficha" style='text-align:center; background-color:#A7C0DC;'>Validar Ficha Nro:</h2>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-3">
                            <label>Ingrese Ficha a Validar:</label><div id="div_ficha" style="color:red">*</div>
                            <input type="text" onKeyPress='return msjG.validaNumeros(event);' class='form-control' name="txt_ficha" id="txt_ficha">
                            <span><a onclick="BuscarFicha();" class="btn btn-primary"><i class="fa fa-lg fa-search"></i></a></span>
                            
                        </div>
                    </div>
                    <div class="col-sm-12 ocultar">
                        <h2 style='text-align:center; background-color:#A7C0DC;'>Datos de la Reniec</h2>
                    </div>
                    <div class="col-sm-12 ocultar">
                        <div class="col-sm-2">
                            <label>Ingrese DNI:</label>
                            <input type="text" onKeyPress='return msjG.validaDni(event,this.id);' class='form-control' name="txt_dni_b" id="txt_dni_b">
                            <span><a onclick="BuscarDNI();" class="btn btn-primary"><i class="fa fa-lg fa-search"></i></a></span>
                        </div>
                    </div>
                    <div class="col-sm-12 ocultar">
                        <div class="col-sm-3">
                            <label>DNI:</label>
                            <input readonly type="text" class='form-control lim' name="txt_dni" id="txt_dni">
                            <input readonly type="hidden" class='form-control lim' name="txt_reniec" id="txt_reniec">
                            <input readonly type="hidden" class='form-control lim' name="txt_ficha_id" id="txt_ficha_id">
                        </div>
                        <div class="col-sm-3">
                            <label>Paterno:</label>
                            <input readonly type="text" class='form-control lim' name="txt_paterno" id="txt_paterno">
                        </div>
                        <div class="col-sm-3">
                            <label>Materno:</label>
                            <input readonly type="text" class='form-control lim' name="txt_materno" id="txt_materno">
                        </div>
                        <div class="col-sm-3">
                            <label>Nombres:</label>
                            <input readonly type="text" class='form-control lim' name="txt_nombres" id="txt_nombres">
                        </div>
                    </div>
                    <div class="col-sm-12 ocultar">
                        <h2 style='text-align:center; background-color:#A7C0DC;'>Datos a Validar</h2>
                    </div>
                    <div class="col-sm-6 ocultar">
                        <div class="col-sm-12 ocultar">
                            <div class="col-sm-6">
                                <label>Paterno:</label>
                                <input type="text" style="text-transform:uppercase;" onKeyPress='return msjG.validaLetras(event);' class='form-control lim' name="txt_paternon" id="txt_paternon">
                            </div>
                        </div>
                        <div class="col-sm-12 ocultar">
                            <div class="col-sm-6">
                                <label>Materno:</label>
                                <input type="text" style="text-transform:uppercase;" onKeyPress='return msjG.validaLetras(event);' class='form-control lim' name="txt_maternon" id="txt_maternon">
                            </div>
                        </div>
                        <div class="col-sm-12 ocultar">
                            <div class="col-sm-6">
                                <label>Nombres:</label>
                                <input type="text" style="text-transform:uppercase;" onKeyPress='return msjG.validaLetras(event);' class='form-control lim' name="txt_nombresn" id="txt_nombresn">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 ocultar">
                        <div class="col-sm-12">
                            <table id="t_mensaje_final" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th id="th_ficha" colspan="2" style="text-align:center">Firmas</th>
                                </tr>
                                <tr>
                                    <th style="text-align:center">Buenas</th>
                                    <th style="text-align:center">Malas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="success"></td>
                                    <td class="danger"></td>
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
