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
                    Mensaje.query().$promise.then(function(response){
                        $scope.mensajesEnviados = response;
                    });
                };
                $scope.textoNivel='<?php echo $cargoS->nombre; ?>';
                $scope.formulario = false;
                $scope.mensaje = {};
                $scope.mensajesEnviados = [];
                actualizarMensajesEnviados();



                $scope.mostrarFormulario = function () {
                    $scope.formulario = true;
                }

                $scope.ocultarFormulario = function () {
                    $scope.formulario = false;
                }

                $scope.enviarMensaje = function (form) {
                    if (form.$valid) {
                        var mensaje  = new Mensaje();
                        mensaje.asunto = $scope.mensaje.asunto;
                        mensaje.descripcion = $scope.mensaje.descripcion;
                        mensaje.$save(function(response){
                            $scope.mensaje = {};
                            $scope.formulario = false;
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
                        $scope.volverABandeja = function (formulario) {
                            formulario = false;
                        }
                    }
                }
            })
            .directive('listMessage', function () {
                return {
                    restrict: 'EAC',
                    templateUrl: 'modulos/comunicacion/listado.html'
                }
            });
    })()
</script>
