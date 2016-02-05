<?php
$cargoS= Cargo::find(Auth::user()->nivel_id+1);
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
                    .otherwise({
                        redirectTo: '/'
                    });
            })
            .controller("bandejaCtrl", function($scope , Mensaje , notificaciones) {
                var actualizarMensajesEnviados = function () {
                    $scope.mensajesEnviados = Mensaje.query();
                };

                $scope.flagMostrarBandeja = true;
                $scope.flagEnviarMensaje = false;
                $scope.flagMostrarEnviados = false;

                $scope.mostrarFormulario = function () {
                    $scope.flagMostrarBandeja = false;
                    $scope.flagEnviarMensaje = true;
                    $scope.flagMostrarEnviados = false;
                }

                $scope.mostrarBandeja = function () {
                    $scope.flagMostrarBandeja = true;
                    $scope.flagEnviarMensaje = false;
                    $scope.flagMostrarEnviados = false;
                }

                $scope.mostrarMensajesEnviados = function () {
                    $scope.flagMostrarBandeja = false;
                    $scope.flagEnviarMensaje = false;
                    $scope.flagMostrarEnviados = true;
                }


                $scope.textoNivel='<?php echo $cargoS->nombre; ?>';
                $scope.formulario = false;
                $scope.mensaje = {};
                $scope.mensajesEnviados = [];
                actualizarMensajesEnviados();






                $scope.mostrarFormulario = function () {
                    $scope.flagMostrarBandeja = false;
                    $scope.flagEnviarMensaje = true;
                    $scope.flagMostrarEnviados = false;
                };

                $scope.ocultarFormulario = function () {
                    $scope.flagMostrarBandeja = true;
                    $scope.flagEnviarMensaje = false;
                    $scope.flagMostrarEnviados = false;
                };

                $scope.enviarMensaje = function (form) {
                    if (form.$valid) {
                        var mensaje  = new Mensaje();
                        mensaje.asunto = $scope.mensaje.asunto;
                        mensaje.descripcion = $scope.mensaje.descripcion;
                        mensaje.$save(function(response){
                            $scope.mensaje = {};
                            $scope.ocultarFormulario();
                            actualizarMensajesEnviados();

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
