<script>

    (function(){
        angular.module("app")
            .config(function($routeProvider) {
                $routeProvider

                    // route for the home page
                    .when('/', {
                        templateUrl : 'modulos/eventos/eventosPage.html',
                        controller  : 'eventosCtrl'
                    })
                    .when('/detalle/:id', {
                        templateUrl : 'modulos/eventos/eventoDetalle.html',
                        controller  : 'eventosCtrl'
                    })
                    .otherwise({
                        redirectTo: '/'
                    });
            })
            .controller("eventosCtrl", function($scope, Service) {
                $scope.listadoeventos = "listado eventos";



            });
    })()

</script>