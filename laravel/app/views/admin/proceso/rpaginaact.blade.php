<!DOCTYPE html>
@extends('layouts.master')  

@section('includes')
    @parent
    @include( 'admin.js.slct_global_ajax' )
    @include( 'admin.js.slct_global' )
    @include( 'admin.proceso.js.rpaginaact_ajax' )
    @include( 'admin.proceso.js.rpaginaact' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Registrar firmas del listado de Adherentes
            <small> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="#">Proceso</a></li>
            <li class="active">Firmas</li>
        </ol>
    </section>

        <!-- Main content -->
        <section class="content">
            <form name="form_personas_equipos" id="form_personas_equipos" method="POST" action="">
                <div class="col-sm-12">
                    <div class="col-sm-4">
                        <div><b>Seleccione Equipo a Gestionar:</b></div>
                        <select class="form-control" name="slct_equipo_id" id="slct_equipo_id" onchange="CargarPersonas();">
                            <option>.::Seleccione::.</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="box-body table-responsive">
                        <table id="t_personas_equipos" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th colspan='4' style='text-align:center; background-color:#A7C0DC;'><h2>Datos de la Persona</h2></th>
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
            <form name="form_firmas" id="form_firmas" method="POST" action="" style="display:none">
                <div class="col-sm-12">
                    <div class="box-body table-responsive">
                        <table id="t_fichas" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <td id="aux" style='text-align:center; background-color:#A7C0DC;width: 100px;'>
                                    <label><h2><b>Ficha:</b></h2></label>
                                    <input type="text" name="txt_ficha" id="txt_ficha" onkeypress="return enterGlobal(event,'aux',1);" class="form-control input-lg" onBlur="ListarFicha(this.value);">
                                </td>
                                <td style='text-align:center; background-color:#A7C0DC;'>
                                    &nbsp;
                                </td>
                                <td colspan='4' style='text-align:center; background-color:#A7C0DC;'>
                                    <h2>
                                        <b>Responsable de la Página <span id="txt_pag"></span></b>
                                    </h2>
                                    <span></span>
                                </td>
                            </tr>
                            <tr>
                                <th style='background-color: #DCE6F1'>Ficha</th>
                                <th style='background-color: #DCE6F1'>Fila</th>
                                <th style='background-color: #DCE6F1'>DNI</th>
                                <th style='background-color: #DCE6F1'>Paterno</th>
                                <th style='background-color: #DCE6F1'>Materno</th>
                                <th style='background-color: #DCE6F1'>Nombres</th>
                                <th>[]</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                            <tr>
                                <th style='background-color: #DCE6F1'>Ficha</th>
                                <th style='background-color: #DCE6F1'>Fila</th>
                                <th style='background-color: #DCE6F1'>DNI</th>
                                <th style='background-color: #DCE6F1'>Paterno</th>
                                <th style='background-color: #DCE6F1'>Materno</th>
                                <th style='background-color: #DCE6F1'>Nombres</th>
                                <th>[]</th>
                            </tr>
                            <tr>
                                <td style="text-align:center" colspan="2">
                                    <a class="btn btn-primary" onclick="Guardar();">
                                        <i class="fa fa-lg fa-save"></i>.::Guardar::.
                                    </a>
                                </td>
                                <td style="text-align:center" colspan="2">
                                    <a class="btn btn-primary" onclick="Cancelar();">
                                        <i class="fa fa-lg fa-save"></i>.::Cancelar::.
                                    </a>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </form>
    </section><!-- /.content -->
@stop
