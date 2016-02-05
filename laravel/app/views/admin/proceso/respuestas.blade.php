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

@include( 'admin.proceso.js.appAngular' )
@include( 'admin.proceso.js.respuestasCtrl' )
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
    .pointer {
        cursor: pointer;
    }
</style>

<div id="alerts-container"></div>
<section class="content-header">
</section>

<!-- Main content -->
<section class="content contaier" ng-app="app">

    <div  class="col-sm-12 content-inner">
        <div id="alerts-container"></div>

        <div ng-view></div>
    </div>

</section><!-- /.content -->
@stop
