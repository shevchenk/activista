<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">		
		<meta name="author" content="Jorge Salcedo (Shevchenko)">
		
		<link rel="shortcut icon" href="assets/ico/favicon.ico">
		<meta name="description" content="">
		<title>			
				Activista - Ingreso
		</title>
			<?php echo HTML::style('lib/font-awesome-4.2.0/css/font-awesome.min.css'); ?>
			<?php echo HTML::style('lib/bootstrap-3.3.1/css/bootstrap.min.css'); ?>

			{{ HTML::script('lib/jquery-2.1.3.min.js') }}
			{{ HTML::script('lib/jquery-ui-1.11.2/jquery-ui.min.js') }}
			{{ HTML::script('lib/bootstrap-3.3.1/js/bootstrap.min.js') }}

			<?php echo HTML::style('css/login/login.css'); ?>
			
			{{ HTML::script('js/login/login_ajax.js') }}
			{{ HTML::script('js/login/login.js') }}
	</head>

<body bgcolor="#FFF">
<div id="mainWrap">
	<div id="loggit">
		<h1><i class="fa fa-lock"></i> Soy PPKausa </h1>
			<?php 	if(Session::get('valores')!=''){
						$valores=Session::get('valores');
						echo "<script>alert('$valores');</script>";
					}
			?>
			<h3 id="mensaje_msj"  class="label-success">
			<?=	Session::get('msj'); ?>			
			</h3>
			
			<h3 id="mensaje_error" style="display:none" class="label-danger">			
			</h3>

            <h3 id="mensaje_inicio">Por Favor <strong>Logeate</strong></h3>
        

		<form action="check/login" id="logForm" method="post" class="form-horizontal">
			<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<div class="col-xs-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
							<input type="text" name="usuario" id="usuario" class="form-control input-lg" placeholder="Usuario" autocomplete="off" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
							<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Contraseña" autocomplete="off" required>
						</div>
					</div>
				</div>
				<div class="form-group formSubmit">
					<div class="col-sm-6">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="remember" checked autocomplete="off"> Mantener activa la session
							</label>
						</div>
					</div>
					<div class="col-sm-5 submitWrap">
						<button type="button" id="btnIniciar" class="btn btn-primary btn-lg">Iniciar sesión</button>
					</div>
				</div>					
				<div class="load" align="center" style="display:none"><i class="fa fa-spinner fa-spin fa-3x"></i></div>
				<hr/>
				<?php
				/*<div class="form-group">
					<div class="col-xs-12">
						<button type="button" id="btnRegistrar" class="col-sm-12 btn btn-warning btn-lg">Registrate Aquí</button>
					</div>
				</div>*/
				?>
			</div>
			</div>	
		</form>

		<form action="check/nuevo" id="newForm" style="display:none" method="post" class="form-horizontal">
			<div class="row">
			<div class="col-md-12 row">
				<div class=" radio col-xs-8">
					<label>
                        <input type='radio' name='rdb_check' value='9' class='flat-red'  >&nbsp;Sé un Simptizante
                    </label>
				</div>
				<div class="col-xs-3">
					<a class="btn btn-sm btn-info" data-img="4" data-target="#imagenppkModal" data-toggle="modal">.:Ver Detalle:.</a>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="radio col-xs-8">
					<label>
                        <input type='radio' name='rdb_check' value='8' class='flat-red' >&nbsp;Sé un Seguidor
                    </label>
				</div>
				<div class="col-xs-3">
					<a class="btn btn-sm btn-info" data-img="3" data-target="#imagenppkModal" data-toggle="modal">.:Ver Detalle:.</a>
				</div>
            </div>
            <div class="col-md-12 row">
                <div class="radio col-xs-8">
					<label>
                        &nbsp;Sé un Activista
                    </label>
				</div>
				<div class="col-xs-3">
					<a class="btn btn-sm btn-info" data-img="2" data-target="#imagenppkModal" data-toggle="modal">.:Ver Detalle:.</a>
				</div>
            </div>
            <div class="col-md-12 row">
            	<div class="radio col-xs-8">
					<label>
                        &nbsp;Sé un Lider Operativo
                    </label>
				</div>
				<div class="col-xs-3">
					<a class="btn btn-sm btn-info" data-img="1" data-target="#imagenppkModal" data-toggle="modal">.:Ver Detalle:.</a>
				</div>
			</div>
			<div class="col-md-12 row">
            	<div class="radio col-xs-8">
					<label>
                        &nbsp;Sé un Lider Zonal
                    </label>
				</div>
				<div class="col-xs-3">
					<a class="btn btn-sm btn-info" data-img="1" data-target="#imagenppkModal" data-toggle="modal">.:Ver Detalle:.</a>
				</div>
			</div>
			<div class="col-md-12 row">
            	<div class="radio col-xs-8">
					<label>
                        &nbsp;Sé un Lider Distrital
                    </label>
				</div>
				<div class="col-xs-3">
					<a class="btn btn-sm btn-info" data-img="1" data-target="#imagenppkModal" data-toggle="modal">.:Ver Detalle:.</a>
				</div>
			</div>
			<div class="col-md-12 row">
            	<div class="radio col-xs-8">
					<label>
                        &nbsp;Sé un Lider Provincial
                    </label>
				</div>
				<div class="col-xs-3">
					<a class="btn btn-sm btn-info" data-img="1" data-target="#imagenppkModal" data-toggle="modal">.:Ver Detalle:.</a>
				</div>
			</div>
			<div class="col-md-12 row">
            	<div class="radio col-xs-8">
					<label>
                        &nbsp;Sé un Lider Regional
                    </label>
				</div>
				<div class="col-xs-3">
					<a class="btn btn-sm btn-info" data-img="1" data-target="#imagenppkModal" data-toggle="modal">.:Ver Detalle:.</a>
				</div>
			</div>
			<div class="col-md-12 row form-group">
            	<div class="radio col-xs-8">
					<label>
                        &nbsp;Sé un Lider Nacional
                    </label>
				</div>
				<div class="col-xs-3">
					<a class="btn btn-sm btn-info" data-img="1" data-target="#imagenppkModal" data-toggle="modal">.:Ver Detalle:.</a>
				</div>
			</div>
				<div class="form-group">
					<div class="col-xs-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
							<input type="text" name="paterno" id="paterno" class="form-control input-lg" placeholder="Paterno" autocomplete="off" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
							<input type="text" name="materno" id="materno" class="form-control input-lg" placeholder="Materno" autocomplete="off" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
							<input type="text" name="nombre" id="nombre" class="form-control input-lg" placeholder="Nombres" autocomplete="off" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
							<input type="text" name="email" id="email" class="form-control input-lg" placeholder="Email" autocomplete="off" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
							<input type="text" name="dni" id="dni" class="form-control input-lg" placeholder="Dni" autocomplete="off" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
							<input type="password" name="passwordn" id="passwordn" class="form-control input-lg" placeholder="Contraseña" autocomplete="off" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
							<input type="password" name="passwordc" id="passwordc" class="form-control input-lg" placeholder="Confirmar Contraseña" autocomplete="off" required>
						</div>
					</div>
				</div>
				<div class="form-group formSubmit">
					<div class="col-xs-6">
						<button type="button" id="btnNuevo" class="col-sm-12 btn btn-info btn-lg">Crear Cuenta</button>
					</div>
					<div class="col-xs-6">
						<button type="button" id="btnRegresar" class="col-sm-12 btn btn-link btn-lg">Cancelar</button>
					</div>
				</div>					
				<div class="load" align="center" style="display:none"><i class="fa fa-spinner fa-spin fa-3x"></i></div>	
			</div>
			</div>	
		</form>
	</div>
</div>
</body>
@include( 'layouts.form.detalle' )
