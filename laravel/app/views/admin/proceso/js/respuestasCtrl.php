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
                    templateUrl : 'modulos/respuestas/bandeja.html',
                    controller  : 'bandejaCtrl'
                })
                .when('/mensaje/:id', {
                    templateUrl : 'modulos/respuestas/responder.html',
                    controller  : 'ResponderCtrl'
                })
                .when('/enviarMensaje', {
                    templateUrl : 'modulos/respuestas/enviarMensaje.html',
                    controller  : 'enviarMensajeCtrl'
                })
                .otherwise({
                    redirectTo: '/'
                });
        })
        .controller("bandejaCtrl", function($scope , Mensaje , notificaciones, $location) {
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

            $scope.irEnviarMensaje = function () {
                $location.path("/enviarMensaje");
            }



            $scope.mostrarFormulario = function () {
                $scope.formulario = true;
            }

            $scope.ocultarFormulario = function () {
                $scope.formulario = false;
            }



        })

        .controller('ResponderCtrl', function ($scope, Mensaje, $routeParams, $location, notificaciones, TipoAcceso){
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
                        $location.path("/");

                    },function(error){
                        console.log(error);
                    });
                } else {
                    notificaciones.showError("Por Favor agregre el asunto y descripcion antes de enviar.")
                }
            };
        })

        .controller('enviarMensajeCtrl', function($scope, Mensaje, $location, TipoAcceso, notificaciones){
            $scope.mensaje = new Mensaje();
            $scope.mensaje.acceso = "2";
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
        .directive('listMessage', function () {
            return {
                restrict: 'EAC',
                templateUrl: 'modulos/respuestas/listaMensajes.html',
                controller: function ($scope, Mensaje) {
                    $scope.responder = function (mensaje_id){
                        $scope.formulario = true;
                        $scope.mensaje = Mensaje.get({id:mensaje_id})
                    }
                }
            }
        })
        .directive('formRespuesta', function () {
            return {
                restrict: 'EAC',
                templateUrl: 'modulos/respuestas/formRespuesta.html'
            }
        })
    ;
})()
</script>
