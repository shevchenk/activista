<?php
    $nivelId = Auth::user()->nivel_id;
    $seguirAlguien= $nivelId-1;
    $cargoS= Cargo::find($seguirAlguien);
    if(count($cargoS<=0)){
        $cargoS= new stdClass();
        $cargoS->nombre='';
    }
?>
<script>

    (function(){
        angular.module("app")
            .config(function($routeProvider) {

                $routeProvider

                    // route for the home page
                    .when('/', {
                        templateUrl : 'modulos/perfil/perfilView.html',
                        controller  : 'perfilViewCtrl'
                    })
                    .when('/editar', {
                        templateUrl : 'modulos/perfil/perfilEdit.html',
                        controller  : 'perfilCtrl',
                        controllerAs: 'Edit'
                    })

                    .otherwise({
                        redirectTo: '/'
                    });
            })

            .controller("perfilViewCtrl", function($scope, Service , $alert, notificaciones, $location, perfilSvc) {
                $scope.perfil = {};
                $scope.textoNivel='<?php echo $cargoS->nombre; ?>';
                $scope.seguirAlguien='<?php echo $seguirAlguien; ?>';
                $scope.idNivel='<?php echo $nivelId; ?>';

                Service.getPerfil().then(function(response){
                    $scope.perfil = response.data;

                    setTimeout(function(){
                        $scope.perfil.n_departamento_texto = jQuery('[ng-model="perfil.n_departamento"] option:selected').text();
                        $scope.perfil.n_provincia_texto = jQuery('[ng-model="perfil.n_provincia"] option:selected').text();
                        $scope.perfil.n_distrito_texto = jQuery('[ng-model="perfil.n_distrito"] option:selected').text();

                        $scope.perfil.d_departamento_texto = jQuery('[ng-model="perfil.d_departamento"] option:selected').text();
                        $scope.perfil.d_provincia_texto = jQuery('[ng-model="perfil.d_provincia"] option:selected').text();
                        $scope.perfil.d_distrito_texto = jQuery('[ng-model="perfil.d_distrito"] option:selected').text();

                        $scope.perfil.cv_departamento_texto = jQuery('[ng-model="perfil.cv_departamento"] option:selected').text();
                        $scope.perfil.cv_provincia_texto = jQuery('[ng-model="perfil.cv_provincia"] option:selected').text();
                        $scope.perfil.cv_distrito_texto = jQuery('[ng-model="perfil.cv_distrito"] option:selected').text();

                        $scope.perfil.cl_departamento_texto = jQuery('[ng-model="perfil.cl_departamento"] option:selected').text();
                        $scope.perfil.cl_provincia_texto = jQuery('[ng-model="perfil.cl_provincia"] option:selected').text();
                        $scope.perfil.cl_distrito_texto = jQuery('[ng-model="perfil.cl_distrito"] option:selected').text();

                    },1000);

                    Service.getApoyos()
                        .then(function(response){
                            response.data.forEach(function(item){
                                item.selected = !!item.selected;
                            });
                            $scope.perfil.activismo = response.data;
                        });
                });

                perfilSvc.getLiderpadre()
                    .success(function(data){
                        $scope.liderPadre = data;
                        perfilSvc.getGruposbyid($scope.liderPadre.id).then(function(response){
                            $scope.grupos = response.data.results.list;

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
                        });
                    });

                $scope.entrarGrupo = function (item) {

                    perfilSvc.getUnirgrupo(item.id).then(function(response){
                        //actualizar boton
                        item.unido = 1;
                    });
                }
                $scope.salirGrupo = function (item) {
                    perfilSvc.getSalirgrupo(item.id).then(function(response){
                        //actualizar boton
                        item.unido = 0;
                    });
                }


                // busqueda de region/departameto
                Service.getRegion().then(function(response){
                    $scope.departamentos = response.data;
                });
                Service.getProvincia().then(function(response){
                    $scope.nProvincias = response.data;
                    $scope.dProvincias = response.data;
                    $scope.cvProvincias = response.data;
                    $scope.clProvincias = response.data;
                    $scope.bProvincias = response.data;
                });
                Service.getDistritos().then(function(response){
                    $scope.nDistritos = response.data;
                    $scope.dDistritos = response.data;
                    $scope.cvDistritos = response.data;
                    $scope.clDistritos = response.data;
                    $scope.bDistritos = response.data;
                });



            })


            // edicion de perfil
            .controller("perfilCtrl", function($scope, perfilSvc , $alert, notificaciones , $http, $location, $rootScope) {
                $scope.perfil = {};
                $scope.liderPadre = {};
                $scope.buscar = {};
                $scope.departamentos = [];
                $scope.formularioBuscarLider = false;
                $scope.showGuardar = true;

                perfilSvc.getApoyos()
                    .success(function(data){
                        data.forEach(function(item){
                            item.selected = !!item.selected;
                        });
                        $scope.perfil.activismo = data;
                    });


                $scope.actualizarActivista = function () {
                    $scope.formularioBuscarLider = false;
                    perfilSvc.getActivista()
                        .success(function(data){
                            angular.extend($scope.perfil, data);
                            $scope.perfil.soy_lider = !!($scope.perfil.soy_lider*1);
                        });
                };

                $scope.actualizarLiderDatos = function () {
                    $scope.formularioBuscarLider = false;
                    perfilSvc.getLiderpadre()
                        .success(function(data){
                            $scope.liderPadre = data;
                            $scope.formularioBuscarLider = false;

                            perfilSvc.getGruposbyid($scope.liderPadre.id).then(function(response){
                                $scope.grupos = response.data.results.list;

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
                            });

                        });
                };



                $scope.actualizarActivista();

                $scope.actualizarLiderDatos();

                $scope.guardarDatos = function() {


                    $scope.perfil.soy_lider = ($scope.perfil.soy_lider) ? 1 : 0;

                    perfilSvc.save($scope.perfil)
                        .then(
                        function(response){
                            notificaciones.showNotification(response.data.message);
                            $location.path("/");
                        },
                        function(error){
//                            console.log(error);
                            notificaciones.showError("Hubo un Problema al guardar los datos");
                        }
                    );
                };


                // cuando se ejecuta departamento
                $scope.ActualizarProvincias = function(departamento, provincias) {
                    perfilSvc.getProvincia(departamento).then(function(response){  $scope[provincias] = response.data;      })
                };

                // cuando se ejecuta departamento
                $scope.ActualizarDistritos = function(provincia, distritos) {
                    perfilSvc.getDistritos(provincia).then(function(response){  $scope[distritos] = response.data;      })
                };

                // busqueda de region/departameto
                perfilSvc.getRegion().then(function(response){
                    $scope.departamentos = response.data;
                });
                perfilSvc.getProvincia().then(function(response){
                    $scope.nProvincias = response.data;
                    $scope.dProvincias = response.data;
                    $scope.cvProvincias = response.data;
                    $scope.clProvincias = response.data;
                    $scope.bProvincias = response.data;
                });
                perfilSvc.getDistritos().then(function(response){
                    $scope.nDistritos = response.data;
                    $scope.dDistritos = response.data;
                    $scope.cvDistritos = response.data;
                    $scope.clDistritos = response.data;
                    $scope.bDistritos = response.data;
                });

                // ========== Advanced Implementation with search ========== //
                $scope.lideresColumnDef = [
                    {
                        columnHeaderDisplayName: 'Asignarme Lider',
                        template: '<button class="btn btn-success" ng-click="asignarmeLider(window);"> + Asignar</button>',
                        width: '10em'
                    },
                    {
                        columnHeaderDisplayName: 'Paterno',
                        displayProperty: 'paterno'
                    },
                    {
                        columnHeaderDisplayName: 'Materno',
                        displayProperty: 'materno'
                    },
                    {
                        columnHeaderDisplayName: 'Nombres',
                        displayProperty: 'nombres'
                    },
                    {
                        columnHeaderDisplayName: 'DNI',
                        displayProperty: 'dni'
                    }
                ];
                $scope.lideresAjaxConfig = {
                    url: 'perfil/buscarlider',
                    method: 'get',
                    params:{},
                    paginationConfig: {
                        response: {
                            totalItems: 'results.totalResults',
                            itemsLocation: 'results.list'
                        }
                    }
                };

                // live search implementation
//                $scope.liderSearchKey = $scope.lideresAjaxConfig.params.texto;
                $scope.buscarLider = function () {
                    if ( $scope.liderSearchKey) {
                        $scope.lideresAjaxConfig.params.texto = $scope.liderSearchKey;
                    }
                };

                $scope.asignarmeLider = function(item) {
                    debugger
                    perfilSvc.postAsignarlider(item).then(function(response){
                        notificaciones.showNotification(response.data.message);
                        flag = false;
                        $scope.actualizarActivista();
                        $scope.actualizarLiderDatos();
                    });
                }
            });
    })()

</script>
