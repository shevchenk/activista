<?php
    $nivelId = Auth::user()->nivel_id;
    $seguirAlguien= $nivelId-1;
    if($nivelId==10 or $nivelId==11){
        $seguirAlguien=0;
    }
    $cargoS= Cargo::find($seguirAlguien);
    if( count($cargoS)<=0 ){
        $cargoS= new stdClass();
        $cargoS->nombre='';
    }
?>
<script>

    (function(){

        angular.module("app")
            .controller("perfilCtrl", function($scope, perfilSvc , $alert, notificaciones , $http) {
                $scope.textoNivel='<?php echo $cargoS->nombre; ?>';
                $scope.seguirAlguien='<?php echo $seguirAlguien; ?>';
                $scope.idNivel='<?php echo $nivelId; ?>';

                $scope.perfil = {};
                $scope.liderPadre = {};
                $scope.buscar = {}
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
                    perfilSvc.getActivista()
                        .success(function(data){
                            angular.extend($scope.perfil, data);
                            $scope.perfil.soy_lider = !!($scope.perfil.soy_lider*1);
                        });
                };

                $scope.actualizarLiderDatos = function () {
                    perfilSvc.getLiderpadre()
                        .success(function(data){
                            console.log(data);
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
                }

                $scope.actualizarActivista();

               $scope.actualizarLiderDatos();

                $scope.guardarDatos = function() {


                    $scope.perfil.soy_lider = ($scope.perfil.soy_lider) ? 1 : 0;

                    perfilSvc.save($scope.perfil)
                        .then(
                            function(response){
                                notificaciones.showNotification(response.data.message);
                                console.log(response)
                                window.location.href = "admin.proceso.perfilView#/"
                            },
                            function(error){
                                console.log(error);
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
                        columnHeaderDisplayName: 'Asignarme '+$scope.textoNivel,
                        template: '<button class="btn btn-success" ng-click="asignarmeLider(item.id)"> + Asignar</button>',
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
                    params:{
                        nivel: $scope.seguirAlguien
                    },
                    paginationConfig: {
                        response: {
                            totalItems: 'results.totalResults',
                            itemsLocation: 'results.list'
                        }
                    }
                };

                $scope.buscarByPress = function (keyEvent, liderSearchKey) {
                    if (keyEvent.which === 13) {
                        $scope.lideresAjaxConfig.params.texto = liderSearchKey;
                    }
                }


                $scope.asignarmeLider = function(item) {
                    perfilSvc.postAsignarlider(item).then(function(response){
                        notificaciones.showNotification(response.message);
                        notificaciones.showNotification(response.data.message);
                        $scope.formularioBuscarLider = false;
                        $scope.actualizarActivista();
                        $scope.actualizarLiderDatos();
                    });
                }

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

                $scope.volverAPerfil = function () {
                    window.location.href = "admin.proceso.perfilView#/";
                }

            });



    })()

</script>
