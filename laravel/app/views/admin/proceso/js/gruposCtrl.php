<script>

    (function(){
        angular.module("app")
            .config(function($routeProvider) {
                $routeProvider

                    // route for the home page
                    .when('/', {
                        templateUrl : 'modulos/grupos/grupos.html',
                        controller  : 'gruposCtrl'
                    })
                    .when('/ver/:id', {
                        templateUrl : 'modulos/grupos/grupoVer.html',
                        controller  : 'gruposVerCtrl'
                    })
                    .otherwise({
                        redirectTo: '/'
                    });
            })
            .factory('gruposSvc', function($http) {
                return {
                    listarGrupos: function () {
                        return $http.get("grupo/listargrupos");
                    },
                    getGrupo: function (id) {
                        return $http.get('grupo/grupo', {params: {grupo_id: id}});
                    }
                };
            })


            .controller("gruposCtrl", function($scope, gruposSvc , $alert, notificaciones, $location, perfilSvc) {
                $scope.grupos = {};

                gruposSvc.listarGrupos().then(function(data){
                    console.log(data);
                    $scope.grupos = data.data.results.list;
                    perfilSvc.getActivistagrupo().then(function(response){
                        var grupos = response.data;

                        grupos.forEach(function(e){
                            $scope.grupos.forEach(function(item){
                                if (item.id == e.grupo_id) {
                                    item.unido = 1;
                                }
                            });
                        });
                    });
                })



            })
            .controller("gruposVerCtrl", function($scope, gruposSvc , $alert, notificaciones, $location, $routeParams) {

                gruposSvc.getGrupo($routeParams.id).then(function(response){
                    $scope.grupo = response.data;
                })



            })


    })()

</script>