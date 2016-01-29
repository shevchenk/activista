<!DOCTYPE html>
@extends('layouts.master')

@section('includes')
@parent
{{ HTML::style('lib/daterangepicker/css/daterangepicker-bs3.css') }}
{{ HTML::style('lib/bootstrap-multiselect/dist/css/bootstrap-multiselect.css') }}
{{ HTML::style('lib/angular-bootstrap-toggle-switch/style/bootstrap3/angular-toggle-switch-bootstrap-3.css') }}
{{ HTML::script('lib/moment.min.js') }}
{{ HTML::script('lib/daterangepicker/js/daterangepicker_single.js') }}
{{ HTML::script('lib/bootstrap-multiselect/dist/js/bootstrap-multiselect.js') }}


{{ HTML::script('lib/angular.min.js') }}
{{ HTML::script('lib/angular-route.js') }}
{{ HTML::script('//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-resource.js') }}
{{ HTML::script('lib/angular-sanitize.min.js') }}
{{ HTML::script('lib/angular-animate.js') }}
{{ HTML::script('lib/angular-strap.min.js') }}
{{ HTML::script('lib/angular-strap.tpl.min.js') }}

{{ HTML::script('lib/angular-bootstrap-toggle-switch/angular-toggle-switch.min.js') }}

{{ HTML::style('lib/bower_components/adapt-strap/dist/adapt-strap.min.css') }}
{{ HTML::script('lib/bower_components/adapt-strap/dist/adapt-strap.min.js') }}
{{ HTML::script('lib/bower_components/adapt-strap/dist/adapt-strap.tpl.min.js') }}


@include( 'admin.js.slct_global_ajax' )
@include( 'admin.js.slct_global' )
@include( 'admin.proceso.js.appAngular' )
@include( 'admin.proceso.js.perfil' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
<!-- Content Header (Page header) -->
<!-- Content Header (Page header) -->
<style xmlns="http://www.w3.org/1999/html">
    .top {
        position: fixed;
        z-index: 99999;
        width: 85%;
        top: 6px;
    }

    .tab-pane {
        min-height: 400px;
    }
    .form-group {
        margin-bottom: 0px;
    }
    .list-group-item-heading {
        overflow: hidden;
    }
</style>

<div id="alerts-container"></div>
<section class="content-header">
    <h1>
        Editar Perfil de usuario
        <small> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="#">Proceso</a></li>
        <li class="active">Solucionar problemas</li>
    </ol>
</section>

<!-- Main content -->
<section class="content contaier" ng-app="app">
    <div ng-controller="perfilCtrl">
        {{--<div class="well">--}}
            {{--@{{ perfil | json}}--}}
        {{--</div>--}}


            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active" ><a href="#home" aria-controls="home" role="tab" data-toggle="tab" ng-click="showGuardar = true">Datos Personales</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" ng-click="showGuardar = true">Lugar de Nacimiento</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" ng-click="showGuardar = true">Domicilio</a></li>
                    <li role="presentation" ng-if="idNivel < 8"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" ng-click="showGuardar = true">Centro de votacion</a></li>
                    <li role="presentation"><a href="#labores" aria-controls="labores" role="tab" data-toggle="tab" ng-click="showGuardar = true">Centro de Labores</a></li>
                    <li role="presentation" ng-if="seguirAlguien > 0"><a href="#lideres" aria-controls="lideres" role="tab" data-toggle="tab" ng-click="showGuardar = false">Seleccionar @{{textoNivel}}</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content" >
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <p></p>

                        <fieldset class="col-sm-9">
                            <legend>Datos Personales</legend>
                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label class="" for="">DNI</label>
                                    <input disabled type="text" class="form-control" ng-model="perfil.dni"/>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label class="" for="">Paterno</label>
                                    <input disabled type="text" class="form-control" ng-model="perfil.paterno"/>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label class="" for="">Materno</label>
                                    <input  disabled type="text" class="form-control"  ng-model="perfil.materno"/>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label class="" for="">Nombres</label>
                                    <input  disabled type="text" class="form-control"  ng-model="perfil.nombres"/>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="">Sexo</label>
                                    <select class="form-control"  ng-model="perfil.sexo">
                                        <option value="1">Masculino</option>
                                        <option value="2">Femenino</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="">Op. Sexual</label>
                                    <select class="form-control" ng-model="perfil.orientacion_sexual">
                                        <option value="1">Heterosexual</option>
                                        <option value="2">Homosexual</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="">Estado Civil</label>
                                    <select class="form-control" ng-model="perfil.estado_civil">
                                        <option value="1">Soltero</option>
                                        <option value="2">Casado</option>
                                        <option value="3">Divorsiado</option>
                                        <option value="4">Viudo</option>
                                        <option value="5">Conviviente</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-3">
                                    <label class="" for="">Grado de Instruccion</label>
                                    <select class="form-control" ng-model="perfil.grado_instruccion">
                                        <option value="1">Sin Nivel</option>
                                        <option value="2">Inicial o Preescolar</option>
                                        <option value="3">Primaria</option>
                                        <option value="4">Secundaria</option>
                                        <option value="5">Superior</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-2">
                                    <label class="" for="">Profesion/Ocp</label>
                                    <input type="text" class="form-control" ng-model="perfil.profesion"/>
                                </div>

                                <div class="form-group col-sm-2">
                                    <label class="" for="">Celular</label>
                                    <input type="text" class="form-control" ng-model="perfil.celular"/>
                                </div>

                                <div class="form-group col-sm-3">
                                    <label class="" for="">Correo Electronico</label>
                                    <input type="text" class="form-control" ng-model="perfil.email"/>
                                </div>

                                <div class="form-group col-sm-2">
                                    <label class="" for="">Twitter</label>
                                    <input type="text" class="form-control"  ng-model="perfil.twitter"/>
                                </div>

                            </div>
                        </fieldset>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <p></p>
                        <fieldset>
                            <legend>
                                Lugar de nacimiento
                            </legend>
                            <div class="form-group col-sm-3">
                                <label class="" for=""><i class="fa fa-calendar"></i> Fech Nac</label>
                                <input type="text" class="form-control" ng-model="perfil.fecha_nacimiento"
                                       data-date-format="yyyy-MM-dd" data-model-date-format="yyyy-MM-dd"
                                       data-date-type="string"
                                       data-min-date="02/10/70"
                                       data-max-date="today"
                                       data-autoclose="1"
                                       bs-datepicker/>
                            </div>
                            <div class="form-group col-sm-3">
                                <label class="" for="">Region</label>
                                <select class="form-control"
                                       ng-model="perfil.n_departamento"
                                       ng-options="dep.id as dep.nombre for dep in departamentos"
                                       ng-change="ActualizarProvincias(perfil.n_departamento, 'nProvincias')"
                                       ></select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label class="" for="">Provincias</label>
                                <select class="form-control"
                                        ng-model="perfil.n_provincia"
                                        ng-options="dep.id as dep.nombre for dep in nProvincias"
                                        ng-change="ActualizarDistritos(perfil.n_provincia, 'nDistritos')"
                                        /></select>
                            </div>

                            <div class="form-group col-sm-3">
                                <label class="" for="">Distrito</label>
                                <select class="form-control"
                                        ng-model="perfil.n_distrito"
                                        ng-options="dep.id as dep.nombre for dep in nDistritos"
                                        /></select>
                            </div>
                        </fieldset>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages"><p></p>
                        <fieldset>
                            <legend>
                                Domicilio
                            </legend>
                            <div class="form-group col-sm-4">
                                <label class="" for="">Region</label>
                                <select class="form-control"
                                        ng-model="perfil.d_departamento"
                                        ng-options="dep.id as dep.nombre for dep in departamentos"
                                        ng-change="ActualizarProvincias(perfil.d_departamento, 'dProvincias')"
                                        ></select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="" for="">Provincia</label>
                                <select class="form-control"
                                        ng-model="perfil.d_provincia"
                                        ng-options="dep.id as dep.nombre for dep in dProvincias"
                                        ng-change="ActualizarDistritos(perfil.d_provincia, 'dDistritos')"
                                        /></select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="" for="">Distrito</label>
                                <select class="form-control"
                                        ng-model="perfil.d_distrito"
                                        ng-options="dep.id as dep.nombre for dep in dDistritos"
                                        /></select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label class="" for="">Urbanizacion</label>
                                <input type="text" class="form-control" ng-model="perfil.d_urbanizacion"/>
                            </div>
                            <div class="form-group col-sm-3">
                                <label class="" for="">Avenida</label>
                                <input type="text" class="form-control" ng-model="perfil.d_avenida"/>
                            </div>
                            <div class="form-group col-sm-3">
                                <label class="" for="">Nro</label>
                                <input type="text" class="form-control" ng-model="perfil.d_numero"/>
                            </div>
                            <div class="form-group col-sm-3">
                                <label class="" for="">Telefono</label>
                                <input type="text" class="form-control" ng-model="perfil.d_telefono"/>
                            </div>

                        </fieldset>
                    </div>
                    <div ng-if="idNivel < 8" role="tabpanel" class="tab-pane" id="settings"><p></p>
                        <fieldset>
                            <legend>
                                Centro de votación
                            </legend>
                            <div class="form-group col-sm-4">
                                <label class="" for="">Region</label>
                                <select class="form-control"
                                        ng-model="perfil.cv_departamento"
                                        ng-options="dep.id as dep.nombre for dep in departamentos"
                                        ng-change="ActualizarProvincias(perfil.cv_departamento, 'cvProvincias')"
                                        ></select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="" for="">Provincia</label>
                                <select class="form-control"
                                        ng-model="perfil.cv_provincia"
                                        ng-options="dep.id as dep.nombre for dep in cvProvincias"
                                        ng-change="ActualizarDistritos(perfil.cv_provincia, 'cvDistritos')"
                                        /></select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="" for="">Distrito</label>
                                <select class="form-control"
                                        ng-model="perfil.cv_distrito"
                                        ng-options="dep.id as dep.nombre for dep in cvDistritos"
                                        /></select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label class="" for="">Colegio</label>
                                <input type="text" class="form-control" ng-model="perfil.cv_colegio"/>
                            </div>
                            <div class="form-group col-sm-3">
                                <label class="" for="">Mesa</label>
                                <input type="text" class="form-control" ng-model="perfil.cv_mesa"/>
                            </div>
                        </fieldset>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="labores"><p></p>
                        <fieldset>
                            <legend>
                                Centro de labores
                            </legend>
                            <div class="form-group col-sm-4">
                                <label class="" for="">Region</label>
                                <select class="form-control"
                                        ng-model="perfil.cl_departamento"
                                        ng-options="dep.id as dep.nombre for dep in departamentos"
                                        ng-change="ActualizarProvincias(perfil.cl_departamento, 'clProvincias')"
                                        ></select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="" for="">Provincia</label>
                                <select class="form-control"
                                        ng-model="perfil.cl_provincia"
                                        ng-options="dep.id as dep.nombre for dep in clProvincias"
                                        ng-change="ActualizarDistritos(perfil.cl_provincia, 'clDistritos')"
                                        /></select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="" for="">Distrito</label>
                                <select class="form-control"
                                        ng-model="perfil.cl_distrito"
                                        ng-options="dep.id as dep.nombre for dep in clDistritos"
                                        /></select>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="" for="">Urbanizacion</label>
                                <input type="text" class="form-control" ng-model="perfil.cl_urbanizacion"/>
                            </div>
                            <div class="form-group col-sm-3">
                                <label class="" for="">Direccion</label>
                                <input type="text" class="form-control" ng-model="perfil.cl_direccion"/>
                            </div>
                            <div class="form-group col-sm-1">
                                <label class="" for="">Nro</label>
                                <input type="text" class="form-control" ng-model="perfil.cl_numero"/>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="" for="">Telefono</label>
                                <input type="text" class="form-control"  ng-model="perfil.cl_telefono"/>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="" for="">Nombre</label>
                                <input type="text" class="form-control" ng-model="perfil.cl_nombre"/>
                            </div>


                        </fieldset>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="lideres">


                     <p>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-2 " >
                                    <p></p>
                                    <button ng-show="!formularioBuscarLider" class="btn btn-info" ng-click="formularioBuscarLider = true"> + Buscar un @{{textoNivel}}</button>
                                    <button ng-show="formularioBuscarLider" class="btn btn-danger" ng-click="formularioBuscarLider = false"> + Ocultar formulario</button>
                                </div>
                                <div class="col-sm-8">
                                    <div ng-show="!perfil.lider_padre || perfil.lider_padre == 0"
                                         class=" col-sm-12 alert alert-warning">
                                        * Usted no tiene a nadie asignado
                                    </div>
                                    <div ng-show="perfil.lider_padre > 0"
                                         class=" col-sm-12 alert alert-info">
                                        * Usted esta asignado a <strong>@{{ liderPadre.nombres }} @{{ liderPadre.paterno }} @{{ liderPadre.materno }}</strong>
                                    </div>
                                </div>


                            </div>
                        </div>
                     </p>


                        <div class="row" ng-show="formularioBuscarLider">
                            <div class="row">
                                <div class="col-sm-12">
                                    <!--========== Advanced Implementation with search ========== -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"
                                                               ng-keypress="buscarByPress($event)"
                                                               ng-change="buscarLider()"
                                                               ng-model="liderSearchKey">
                                                        <span class="input-group-addon">
                                                          <i class="glyphicon glyphicon-search"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <ad-table-ajax table-name="lideres"
                                                           column-definition="lideresColumnDef"
                                                           table-classes="table table-bordered"
                                                           page-sizes="[5, 20, 50]"
                                                           pagination-btn-group-classes="pagination pagination-sm"
                                                           ajax-config="lideresAjaxConfig"
                                                           page-loader="methods.pageLoader">
                                            </ad-table-ajax>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="form-horizontal" ng-show="perfil.lider_padre > 0 && !formularioBuscarLider">
                            <div class="row">
                                <fieldset class="col-sm-12">
                                    <legend>Datos Mi @{{textoNivel}}</legend>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Nombres y apellidos </label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">@{{ liderPadre.nombres }} @{{ liderPadre.paterno }} @{{ liderPadre.materno }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">DNI</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">@{{ liderPadre.dni }}</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Celular</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">@{{ liderPadre.celular }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">@{{ liderPadre.email }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Urbanizacoin</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">@{{ liderPadre.d_urbanizacion }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Direccion</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">@{{ liderPadre.d_avenidoa }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Nro</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">@{{ liderPadre.d_numero }}</p>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <fieldset>
                                        <legend>Por favor , seleccione al menus un grupo de su @{{textoNivel}}</legend>

                                        <div class="row">
                                            <div class="col-sm-3" ng-repeat="grupo in grupos" style="border:1px solid #ccc; border-radius:10px;margin: 10px;padding: 10px" >
                                                <div class="list-group">
                                                    <h4 class="list-group-item-heading" style="padding: 5px;">@{{grupo.nombre}}</h4>
                                                    <p style="min-height: 150px" class="list-group-item-text">@{{grupo.descripcion}}</p>
                                                    <p>
                                                        <strong>FB link:</strong>
                                                        <a ng-href="@{{grupo.fb_url}}" target='_blank'>Facebook</a>
                                                    </p>
                                                </div>
                                                <button class="btn btn-danger" ng-if="grupo.unido == 1" ng-click="salirGrupo(grupo)">Salir de Grupo</button>
                                                <button class="btn btn-success" ng-if="grupo.unido != 1" ng-click="entrarGrupo(grupo)">Unirme</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div ng-if="!grupos.length"> El @{{textoNivel}} no cuenta con grupos creado</div>

                                        </div>


                                    </fieldset>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>

            </div>


       <div class="row" ng-show="showGuardar">
           <div class="col-sm-offset-4 col-sm-6 text-right">
               <button  class="btn btn-default " ng-click="volverAPerfil()">Cancelar</button>
               <button  class="btn btn-success " ng-click="guardarDatos()">Guardar Datos</button>
           </div>
       </div>



    </div>


</section><!-- /.content -->
@stop
