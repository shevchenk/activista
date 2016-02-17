<?php
$cargoS= Cargo::find(Auth::user()->nivel_id);
?>
<script>
    (function(){
        angular.module("app")
            .config(function($routeProvider) {
                $routeProvider

                    // route for the home page
                    .when('/', {
                        templateUrl : 'modulos/comunicacion/bandeja.html',
                        controller  : 'bandejaCtrl'
                    })
                    .when('/mensajes-enviados', {
                        templateUrl : 'modulos/comunicacion/listado.html',
                        controller  : 'mensajesEnviadosCtrl'
                    })

                    .when('/mensajes-para-responder', {
                        templateUrl : 'modulos/respuestas/listaMensajes.html',
                        controller  : 'mensajesParaResponderCtrl'
                    })
                    .when('/responder-mensaje/:id', {
                        templateUrl : 'modulos/respuestas/responder.html',
                        controller  : 'ResponderMensajeCtrl'
                    })

                    .when('/enviar-mensaje', {
                        templateUrl : 'modulos/comunicacion/formEnviar.html',
                        controller  : 'enviarMensajeCtrl'
                    })
                    // Envia un mensaje respondido
                    .when('/enviarMensaje-respuesta', {
                        templateUrl : 'modulos/respuestas/enviarMensaje.html',
                        controller  : 'enviarMensajeRespondidoCtrl'
                    })
                    .when('/ver-respuesta/:id', {
                        templateUrl : 'modulos/comunicacion/verRespuesta.html',
                        controller  : 'verRespuestaCtrl'
                    })
                    .otherwise({
                        redirectTo: '/'
                    });
            })
            .controller("bandejaCtrl", function($scope , $location ,Mensaje , notificaciones, Cargo, Auth) {
                $scope.cargo = Cargo.get();
                $scope.auth = Auth.get();
                $scope.idCargo='<?php echo $cargoS->id; ?>';
                if($scope.idCargo>9){
                    //alert('Es lider o liebre');
                    $location.path("/mensajes-para-responder");
                }

                var actualizarMensajesEnviados = function () {
                    $scope.mensajesEnviados = Mensaje.query();
                };



                $scope.flagMostrarBandeja = true;
                $scope.flagEnviarMensaje = false;
                $scope.flagMostrarEnviados = false;

                $scope.mostrarMensajesEnviados = function () {
                    $location.path('/mensajes-enviados');
                };

                $scope.textoNivel='<?php echo $cargoS->nombre; ?>';
                $scope.formulario = false;
                $scope.mensaje = {};
                $scope.mensajesEnviados = [];
                actualizarMensajesEnviados();

            })
            .controller('mensajesEnviadosCtrl', function ($scope, $location, Mensaje, notificaciones) {
                $scope.mensajesEnviados = Mensaje.query({soloEnviados: 1});

                $scope.enviarMensaje = function() {
                    $location.path('/enviar-mensaje')
                };
                $scope.mostrarBandeja = function () {
                    $location.path('/');
                };

                $scope.mostrarMensajesEnviados = function () {
                    $location.path('/mensajes-enviados');
                }


            })
            .controller("mensajesParaResponderCtrl", function($scope , Mensaje , notificaciones, $location, Cargo) {
                var actualizarMensajesSinResponder = function () {
                    var params = {
                        estado: "0",
                        soy: 'liebre'
                    };
                    Mensaje.query(params).$promise.then(function(response){
                        $scope.mensajesSinResponder = response;
                    });
                };
                $scope.textoNivel='<?php echo $cargoS->nombre; ?>';
                $scope.formulario = false;
                $scope.mensaje = {};
                $scope.mensajesEnviados = [];
                actualizarMensajesSinResponder();


            })
            .controller('ResponderMensajeCtrl', function ($scope, Mensaje, $routeParams, $location, notificaciones, TipoAcceso){
                $scope.mensaje = Mensaje.get({id: $routeParams.id});

                $scope.tipo_accesos = TipoAcceso.query();


                $scope.ocultarFormulario = function () {
                    $location.path("/");
                };

                $scope.responderMensaje = function (form) {
                    if (form.$valid) {
                        $scope.mensaje.editar = true;
                        $scope.mensaje.$save(function(response){
                            $scope.mensaje = {};
                            notificaciones.showNotification('Se envio respuesta');
                            $location.path("/mensajes-para-responder");

                        },function(error){
                            console.log(error);
                        });
                    } else {
                        notificaciones.showError("Por Favor agregre el asunto y descripcion antes de enviar.")
                    }
                };
            })
            .controller('enviarMensajeCtrl', function ($scope, $location, Mensaje, notificaciones, Upload) {
                $scope.mensaje = new Mensaje();

                $scope.volverABandeja = function () {
                    $location.path('/');
                };

                $scope.enviarMensaje = function (form) {
                    if (form.$valid) {
                        $scope.mensaje.$save(function(){
                            $scope.mensaje = {};
                            $location.path('/mensajes-enviados');
                            notificaciones.success('Mensaje enviado correctamente!');
                        },function(error){
                            console.log(error);
                        });
                    } else {
                        notificaciones.showError("Por Favor agregre el asunto y descripcion antes de enviar.")
                    }
                };
            })
            .controller('enviarMensajeRespondidoCtrl', function($scope, Mensaje, $location, notificaciones, TipoAcceso){
                $scope.mensaje = new Mensaje();
                $scope.mensaje.acceso = "2";
                $scope.nivelesSeleccionados = [];
                $scope.tipo_accesos = TipoAcceso.query();

                $scope.volver = function () {
                    $location.path('/');
                };


                $scope.EnviarMensaje = function (form) {
                    if (form.$valid) {
                        $scope.mensaje.envioEnMasa= 1;
                        $scope.mensaje.$save(function() {
                            $scope.mensaje = {};
                            notificaciones.showNotification('Se envio Mensaje');
                            $location.path("/");

                        },function(error){
                            console.log(error);
                        });
                    } else {
                        notificaciones.showError("Por Favor llene todos los campos antes de enviar.")
                    }
                }
            })
            .controller('verRespuestaCtrl', function ($scope, Bandeja, $location, $routeParams) {
                $scope.noEditar = true;
                $scope.mensaje = Bandeja.get({id: $routeParams.id});
            })
            .directive('composeMessage', function () {
                return {
                    restrict: 'EAC',
                    templateUrl: 'modulos/comunicacion/formEnviar.html',
                    controller: function ($scope) {
                        $scope.volverABandeja = function () {
                            $scope.ocultarFormulario()
                        }
                    }
                }
            })
            .directive('listMessage', function () {
                return {
                    restrict: 'EAC',
                    templateUrl: 'modulos/comunicacion/listado.html'
                }
            })
            .directive('bandeja', function () {
                return {
                    restrict: 'EAC',
                    scope: {},
                    templateUrl: 'modulos/comunicacion/bandejaMensajes.html',
                    controller: function ($scope, Bandeja) {
                        $scope.RespuestaView = false;
                        $scope.bandeja = Bandeja.query();

                        $scope.verRespuesta = function (id) {
                            $scope.respuesta_id = id;
                            $scope.RespuestaView = true;

                        }

                    }
                }
            })
            .directive('mensajesMenu', function ($location, Cargo) {
                return {
                    restrict: 'E',
                    templateUrl: 'modulos/comunicacion/menu.html',
                    controller: function ($scope) {
                        $scope.cargo = Cargo.get();
                        $scope.fnEnviarMensaje = function () {
                            $location.path('/enviar-mensaje')
                        };
                        $scope.fnIrBandeja = function () {
                            $location.path('/')
                        };
                        $scope.fnIrEnviados = function () {
                            $location.path('/mensajes-enviados');
                        }
                        $scope.fnEnviarMensajeRespondido = function () {
                            $location.path('/enviarMensaje-respuesta');
                        }
                        $scope.fnIrMensajesParaResponder = function () {
                            $location.path('/mensajes-para-responder');
                        }

                    }
                }
            })
            .directive('verRespuesta', function () {
                return {
                    restrict: 'EAC',
                    scope: {
                        mensaje: '='
                    },
                    templateUrl: 'modulos/comunicacion/verRespuesta.html',
                    controller: function ($scope, Bandeja) {
                        $scope.noEliminar = true;
                            $scope.mensaje = Bandeja.get({id: $scope.mensaje});
                            $scope.verRespuesta = function (id) {
                                $scope.respuesta_id = id;
                                $scope.verRespuesta = true;
                            }
                    }
                }
            })
        ;


    })()
</script>
