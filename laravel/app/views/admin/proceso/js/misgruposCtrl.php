<script>

    (function(){
        angular.module("app")
            .config(function($routeProvider) {
                $routeProvider

                    // route for the home page
                    .when('/', {
                        templateUrl : 'modulos/grupos/grupoView.html',
                        controller  : 'grupoCtrl'
                    })

                    // route for the about page
                    .when('/editar/:id', {
                        templateUrl : 'modulos/grupos/grupoEditar.html',
                        controller  : 'grupoEditarCtrl'
                    })
                    // route for the about page
                    .when('/crear', {
                        templateUrl : 'modulos/grupos/grupoCrear.html',
                        controller  : 'grupoCrearCtrl'
                    })
                    .otherwise({
                        redirectTo: '/'
                    });
            })
            .factory('grupoSvc', function($http) {
                return {
                    getGrupos: function () {
                        return $http.get("grupo/grupos");
                    },
                    getGrupo: function (id) {
                        return $http.get('grupo/grupo', {params: {grupo_id: id}});
                    },
                    updateGrupo:function(data) {
                        return $http({
                            method: 'POST',
                            url: 'grupo/actualizargrupo',
                            headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                            data: $.param(data)
                        });
                    },
                    cambiarEstado: function(data){
                        return $http({
                            method: 'POST',
                            url: 'grupo/cambiarestado',
                            headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                            data: $.param(data)
                        });
                    }

                };
            })
            .controller("grupoCtrl", function($scope, grupoSvc , $alert, notificaciones, $location) {
                $scope.grupo = {};

                $scope.gruposColumnDef = [
                    {
                        columnHeaderDisplayName: 'Titulo',
                        displayProperty: 'nombre'
                    },
                    {
                        columnHeaderDisplayName: 'Descripción',
                        displayProperty: 'descripcion',
                        width: '30em'
                    },
                    {
                        columnHeaderDisplayName: 'Estado',
                        templateUrl: 'modulos/grupos/rowEstado.html'
                    },
                    {
                        columnHeaderDisplayName: 'Acciones',
                        templateUrl: 'modulos/grupos/rowOptions.html',
                        width:'20em'
                    }
                ];
                $scope.gruposTableConfig = {
                    url: 'grupo/grupos',
                    method: 'get',
                    params:{},
                    paginationConfig: {
                        response: {
                            totalItems: 'results.totalResults',
                            itemsLocation: 'results.list'
                        }
                    }
                };

                $scope.cambiarEstado = function (item) {
                    $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
                    grupoSvc.cambiarEstado(item).then(function(res){
                    $(".overlay,.loading-img").remove();
                        // Permite hacer el cambio dinamico
                        $scope.gruposTableConfig.params.change = !$scope.gruposTableConfig.params.change;
                        Psi.mensaje('success',res.data.message,4000);
                    });
                }

                $scope.checkStatus = function (item, index) {
                    var rowClass = '';
                    if (item.estado != 1) {
                        rowClass = 'danger';
                    }
                    return rowClass;
                }


            })
            .factory('grupoCrearSvc', function($http) {
                return {
                    getPreguntas: function () {return $http.get("grupo/preguntas");},
                    saveGrupo:function(data) {
                        return $http({
                            method: 'POST',
                            url: 'grupo/guardargrupo',
                            headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                            data: $.param(data)
                        });
                    }
                };
            })
            .controller("grupoCrearCtrl", function($scope, grupoCrearSvc , $alert, notificaciones, $location,perfilSvc) {
                $scope.grupo = {};

                grupoCrearSvc.getPreguntas().then(function (res) {
                    $scope.grupo.preguntas = res.data;

                    $scope.grupo.preguntas.forEach(function (item) {
                        item.estado = false;
                    });

                });

                $scope.guardarGrupo = function() {
                    $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
                    grupoCrearSvc.saveGrupo($scope.grupo).then(function(res){
                        $(".overlay,.loading-img").remove();
                        $location.path("/");
                        Psi.mensaje('success',res.data.message,4000);

                    },function(error){
                        $(".overlay,.loading-img").remove();
                        Psi.mensaje('danger',error.message,5000);
                    })
                }

                // busqueda de region/departameto
                perfilSvc.getRegion().then(function(response){
                    $scope.departamentos = response.data;
                });
                perfilSvc.getProvincia().then(function(response){
                    $scope.Provincias = response.data;

                });
                perfilSvc.getDistritos().then(function(response){
                    $scope.Distritos = response.data;

                });

                // cuando se ejecuta departamento
                $scope.ActualizarProvincias = function(departamento, provincias) {
                    perfilSvc.getProvincia(departamento).then(function(response){  $scope[provincias] = response.data;      })
                };

                // cuando se ejecuta departamento
                $scope.ActualizarDistritos = function(provincia, distritos) {
                    perfilSvc.getDistritos(provincia).then(function(response){  $scope[distritos] = response.data;      })
                };



            })
            .controller("grupoEditarCtrl", function($scope, grupoSvc ,grupoCrearSvc, $alert, notificaciones, $location, $routeParams, perfilSvc) {
                $scope.grupo = {};
                $scope.cargando = true;



                // busqueda de region/departameto
                perfilSvc.getRegion().then(function(response){
                    $scope.departamentos = response.data;
                    perfilSvc.getProvincia().then(function(response){
                        $scope.Provincias = response.data;
                        perfilSvc.getDistritos().then(function(response){
                            $scope.Distritos = response.data;

                            $scope.dataReady();

                        });
                    });
                });

                $scope.dataReady = function (){
                    grupoSvc.getGrupo($routeParams.id).then(function(response) {
//                    console.log(response);

                        $scope.grupo = response.data;

                        $scope.grupo.departamento = $scope.grupo.region;
                        $scope.grupo.edad_desde = $scope.grupo.edad_desde*1;
                        $scope.grupo.edad_hasta = $scope.grupo.edad_hasta*1;

                        // mis grupos
                        $scope.grupo.preguntas.forEach(function(item){
                            item.estado = !!item.estado;
                        });

                        grupoCrearSvc.getPreguntas().then(function (res) {
                           var preg = $scope.grupo.preguntas;
                            $scope.grupo.preguntas = angular.extend( res.data, preg);
                            $scope.cargando = false;
                        });



                    });
                };




                $scope.editarGrupo = function () {
                    $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
                    grupoSvc.updateGrupo($scope.grupo).then(function(res){
                    $(".overlay,.loading-img").remove();
                       $location.path("/");
                       Psi.mensaje('success',res.data.message,4000);                       
                   });
                }

            })

    })()

</script>
