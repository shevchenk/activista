<!DOCTYPE html>
@extends('layouts.master')  

@section('includes')
    @parent

{{ HTML::style('css/styles.css') }}
    
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')

            <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        {{ trans('greetings.pinicio') }}
                        <small> </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
                        <li class="active">{{ trans('greetings.menu_inicio') }}</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- Inicia contenido -->

                            <!--div class="col-lg-3 col-xs-6">
                                
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h4>Perfil</h4>
                                        <p>Actualize sus datos persoales</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <a href="admin.proceso.perfilView" class="small-box-footer">
                                       Actualizar Perfil <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-xs-6">
                                
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <h4>Registro de Personas</h4>
                                        <p>Registre seguidores a su cargo</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                    <a href="admin.proceso.seguidor" class="small-box-footer">
                                       Registrar <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div-->



                            <!-- Finaliza contenido -->
                        </div>
                    </div>

                </section><!-- /.content -->
@stop
