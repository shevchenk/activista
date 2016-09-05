<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

        @section('autor')
        <meta name="author" content="Jorge Salcedo (Shevchenko)">
        @show

        <link rel="shortcut icon" href="favicon.ico">

        @section('descripcion')
        <meta name="description" content="">
        @show
        <title>
            @section('titulo')
                Activista - Lider
            @show
        </title>

        @section('includes')
            <?php echo HTML::style('lib/bootstrap-3.3.1/css/bootstrap.min.css'); ?>
            <?php echo HTML::style('lib/font-awesome-4.2.0/css/font-awesome.min.css'); ?>

            {{ HTML::script('lib/jquery-2.1.3.min.js') }}
            {{ HTML::script('lib/jquery-ui-1.11.2/jquery-ui.min.js') }}
            {{ HTML::script('lib/bootstrap-3.3.1/js/bootstrap.min.js') }}

            <?php echo HTML::style('lib/bootstrap-3.3.1/css/ionicons.min.css'); ?>
            <?php echo HTML::style('lib/datatables-1.10.4/media/css/dataTables.bootstrap.css'); ?>
            <?php echo HTML::style('css/admin/admin.css'); ?>

            {{ HTML::script('lib/datatables-1.10.4/media/js/jquery.dataTables.js') }}
            {{ HTML::script('lib/datatables-1.10.4/media/js/dataTables.bootstrap.js') }}
            {{ HTML::script('js/psi.js') }}
            @include( 'admin.js.app' )

            {{ HTML::style('lib/daterangepicker/css/daterangepicker-bs3.css') }}
            {{ HTML::style('lib/bootstrap-multiselect/dist/css/bootstrap-multiselect.css') }}
            {{ HTML::script('lib/daterangepicker/js/daterangepicker.js') }}
            {{ HTML::script('lib/bootstrap-multiselect/dist/js/bootstrap-multiselect.js') }}

            @include( 'admin.js.slct_global_ajax' )
            @include( 'admin.js.slct_global' )
            @include( 'admin.proceso.js.validadni_ajax' )
            @include( 'admin.proceso.js.validadni' )
        @show
    </head> 

    <body class="skin-blue">
    <div id="msj" class="msjAlert"> </div>
            <header class="header">
                <a href="admin" class="logo">Valida DNI
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <div class="navbar-right">
                        <ul class="nav navbar-nav">             
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">                            
                                <a href="salir">
                                    <i class="glyphicon glyphicon-user">Salir</i>
                                    
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
        <div class="wrapper row-offcanvas row-offcanvas-left ">
            <aside class="right-side">
                <section class="content-header">
                <h1>
                    VALIDACIÓN DE DNI
                    <small> </small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
                    <li><a href="#">Reporte</a></li>
                    <li class="active">DNI</li>
                </ol>
            </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Inicia contenido -->
                    <div class="box">
                        <fieldset>
                            <div class="row form-group" >
                                <div class="col-sm-12">
                                    <div class="col-sm-3">
                                        <label class="control-label">DNI:</label>
                                        <input class="form-control" maxlength="8" type="number" name="txt_dni" id="txt_dni" onKeyPress='return msjG.validaDni(event,this);'>
                                    </div>
                                    <div class="col-sm-2">
                                        <br>
                                        <a class="btn btn-sm btn-primary" onclick="ValidaDNI();">
                                            <i class="fa fa-search fa-lg"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div><!-- /.box -->
                </div>
            </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
