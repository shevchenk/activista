<script>

    (function(){
        angular.module("app")
            .config(function($routeProvider) {
                $routeProvider

                    // route for the home page
                    .when('/', {
                        templateUrl : 'modulos/seguidor/ListadoSeguidores.html',
                        controller  : 'listardoCtrl'
                    })
                    .when('/agregar/', {
                        templateUrl : 'modulos/seguidor/AgregarSeguidores.html',
                        controller  : 'agregarCtrl'
                    })
                    .otherwise({
                        redirectTo: '/'
                    });
            })
            .controller("listardoCtrl", function($scope) {
                $scope.columnDef = [
                    {
                        columnHeaderDisplayName: 'Nombres',
                        template: '<div>{{ item.nombres + " "  + item.paterno + " "  + item.materno }}</div>'
                    },
                    {
                        columnHeaderDisplayName: 'DNI',
                        displayProperty: 'dni'
                    },
                    {
                        columnHeaderDisplayName: 'Fecha',
                        displayProperty: 'fecha_ingreso'
                    }
                ];
                $scope.tableConfig = {
                    url: 'seguidor/seguidores',
                    method: 'get',
                    params:{},
                    paginationConfig: {
                        response: {
                            totalItems: 'results.totalResults',
                            itemsLocation: 'results.list'
                        }
                    }
                };
            })
            .controller("agregarCtrl", function($scope, Service,$location) {
                $scope.seguidor = {};

                $scope.guardarSeguidor = function () {
                    Service.postSeguidor($scope.seguidor).then(function(response){
                        $location.path("/");
                        notificaciones.showNotification(res.data.message);
                    });
                };

                $scope.cancelar = function() {
                    $location.path("/");
                };

            });
    })()

</script>