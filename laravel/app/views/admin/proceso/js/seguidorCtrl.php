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
                $scope.textoNivel='<?php echo $cargoS ? $cargoS->nombre : ''; ?>';
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
            .controller("agregarCtrl", function($scope, Service,$location,notificaciones) {
                $scope.textoNivel='<?php echo $cargoS ? $cargoS->nombre : ''; ?>';
                $scope.seguidor = {};
                $scope.seguidor.nivel='<?php echo $cargoS ? $cargoS->id : ''; ?>';
                $scope.seguidor.fecha_inicio='<?php echo date("Y-m-d"); ?>';
                slctGlobal.listarSlctFijo3('grupop','listargrupoe','slct_grupo');
                
                $scope.guardarSeguidor = function () {
                    $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
                    Service.postSeguidor($scope.seguidor).then(function(response){
                        $(".overlay,.loading-img").remove();
                        if (response.data.code == "ok") {
                            $location.path("/");
                            Psi.mensaje('success',response.data.message,4000);
                        } else {
                            Psi.mensaje('danger',response.data.message,5000);
                        }
                    });
                };

                $scope.cancelar = function() {
                    $location.path("/");
                };

                $scope.CargarCargoEscalafon = function() {
                    var data={grupo_persona_id:$scope.seguidor.grupo};
                    slctGlobal.listarSlctFijo2('grupop','listarcargoe','slct_cargo',data,null,SoloAfiliado);
                }

                    SoloAfiliado=function(id){
                        $("#slct_cargo option").css("display","none");
                        $("#slct_cargo option[data-dat='1']").css("display","").attr("selected","true");
                    }


            });
    })()

</script>
