<!DOCTYPE html>
@extends('layouts.master')

@section('includes')
@parent
{{ HTML::style('lib/daterangepicker/css/daterangepicker-bs3.css') }}
{{ HTML::style('lib/bootstrap-multiselect/dist/css/bootstrap-multiselect.css') }}
{{ HTML::style('lib/angular-bootstrap-toggle-switch/style/bootstrap3/angular-toggle-switch-bootstrap-3.css') }}
{{ HTML::script('//cdn.jsdelivr.net/momentjs/2.9.0/moment.min.js') }}
{{ HTML::script('lib/daterangepicker/js/daterangepicker_single.js') }}
{{ HTML::script('lib/bootstrap-multiselect/dist/js/bootstrap-multiselect.js') }}


{{ HTML::script('//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js') }}
{{ HTML::script('//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js') }}
{{ HTML::script('//cdn.jsdelivr.net/angularjs/1.4.5/angular-sanitize.min.js') }}
{{ HTML::script('//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.js') }}
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/angular-strap/2.3.5/angular-strap.min.js') }}
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/angular-strap/2.3.5/angular-strap.tpl.min.js') }}

{{ HTML::script('lib/angular-bootstrap-toggle-switch/angular-toggle-switch.min.js') }}

{{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css') }}
{{ HTML::style('lib/bower_components/adapt-strap/dist/adapt-strap.min.css') }}
{{ HTML::script('lib/bower_components/adapt-strap/dist/adapt-strap.min.js') }}
{{ HTML::script('lib/bower_components/adapt-strap/dist/adapt-strap.tpl.min.js') }}


@include( 'admin.js.slct_global_ajax' )
@include( 'admin.js.slct_global' )
@include( 'admin.proceso.js.appAngular' )
@include( 'admin.proceso.js.gruposCtrl' )
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
        min-height: 200px;
    }
    .content .content-inner{
        padding-bottom: 40px;
    }



    .truncate {
        height: 10em;
        min-height: 10em;
        max-height: 10em;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .list-group-item-heading {
        overflow: hidden;
    }
</style>

<div id="alerts-container"></div>
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="#">Proceso</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content contaier" ng-app="app">
    <div  class="col-sm-10 content-inner">
        <!-- angular templating -->
        <!-- this is where content will be injected -->
        <div ng-view></div>
    </div>

</section><!-- /.content -->
@stop

@section('formulario')
    @include( 'admin.proceso.form.problemaDetalle' )
@stop
