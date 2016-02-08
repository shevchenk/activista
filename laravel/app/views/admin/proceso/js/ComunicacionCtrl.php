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
                    .when('/enviar-mensaje', {
                        templateUrl : 'modulos/comunicacion/formEnviar.html',
                        controller  : 'enviarMensajeCtrl'
                    })
                    .otherwise({
                        redirectTo: '/'
                    });
            })
            .controller("bandejaCtrl", function($scope , $location ,Mensaje , notificaciones) {
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
            .controller('enviarMensajeCtrl', function ($scope, $location, Mensaje, notificaciones) {
                $scope.mensaje = new Mensaje();

                $scope.volverABandeja = function () {
                    $location.path('/');
                }

                $scope.enviarMensaje = function (form) {
                    if (form.$valid) {
                        var mensaje  = new Mensaje();
                        mensaje.asunto = $scope.mensaje.asunto;
                        mensaje.descripcion = $scope.mensaje.descripcion;
                        mensaje.$save(function(response){
                            $scope.mensaje = {};
                            $location.path('/mensajes-enviados');
                            notificaciones.success('Mensaje enviado correctamente!');


                        },function(error){
                            console.log(error);
                        });
                    } else {
                        notificaciones.showError("Por Favor agregre el asunto y descripcion antes de enviar.")
                    }

                }

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
            .directive('mensajesMenu', function ($location) {
                return {
                    restrict: 'E',
                    templateUrl: 'modulos/comunicacion/menu.html',
                    controller: function ($scope) {
                        $scope.fnEnviarMensaje = function () {
                            $location.path('/enviar-mensaje')
                        };
                        $scope.fnIrBandeja = function () {
                            $location.path('/')
                        };
                        $scope.fnIrEnviados = function () {
                            $location.path('/mensajes-enviados');
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
                            $scope.mensaje = Bandeja.get({id: $scope.mensaje});
                            $scope.verRespuesta = function (id) {
                                $scope.respuesta_id = id;
                                $scope.verRespuesta = true;

                            }

                    }
                }
            });


    })()
</script>
