<script>

    (function(){
        angular.module("app", [
            'mgcrea.ngStrap',
            'ngSanitize',
            'ngAnimate',
            'toggle-switch',
            'adaptv.adaptStrap',
            'ngRoute',
            'ngResource',
            'ngFileUpload'
        ])
            .factory('notificaciones', function($alert){
                return {
                    success: function(message) {
                        $alert({
                            title: message,
                            placement: 'top',
                            type: 'success',
                            show: true,
                            container: '#alerts-container',
                            duration: '5',
                            animation: "am-fade-and-slide-top"
                        });
                    },
                    showNotification: function(message) {
                        $alert({
                            title: message,
                            placement: 'top',
                            type: 'success',
                            show: true,
                            container: '#alerts-container',
                            duration: '5',
                            animation: "am-fade-and-slide-top"
                        });
                    },
                    showError : function (message) {
                        $alert({
                            title: message,
                            placement: 'top',
                            type: 'danger',
                            show: true,
                            container: '#alerts-container',
                            duration: '5',
                            animation: "am-fade-and-slide-top"
                        });
                    }
                }
            })
            .factory('Auth', function ($resource) {
                var Auth = $resource('comunicacion/auth/:id',
                    { id:   1 });

                return Auth;
            })
            .factory('Cargo', function ($resource) {
                var Cargo = $resource('comunicacion/cargos/:id',
                    { id:   1 });

                return Cargo;
            })
            .factory('Mensaje', function($resource){
                var Comunicacion = $resource('comunicacion/comunicacion/:id',
                    { id:'@id' },
                    {
                    query: {
                        method: 'GET',
                        isArray: true
                    }
                });

                Object.defineProperty(Comunicacion.prototype, 'fecha_ago', {
                    get: function () {
                        moment.locale('es');
                        return moment(this.created_at).fromNow();
                    }
                });

                return Comunicacion;

            })
            .factory('TipoAcceso', function($resource){
                var TipoAcceso = $resource('comunicacion/tipoacceso/:id',
                    { id:'@id' },
                    {
                        query: {
                            method: 'GET',
                            isArray: true
                        }
                    });
                return TipoAcceso;
            })
            .factory('Archivo', function($resource){
                var Archivo = $resource('comunicacion/archivos/:id',
                    { id:'@id' },
                    {
                        query: {
                            method: 'GET',
                            isArray: true
                        }
                    });
                return Archivo;
            })
            .factory('Nivel', function($resource){
                var Nivel = $resource('perfil/niveles/:id',
                    { id:'@id' },
                    {
                        query: {
                            method: 'GET',
                            isArray: true
                        }
                    });
                return Nivel;
            })
            .factory('Bandeja', function($resource){
                var Bandeja = $resource('comunicacion/bandeja/:id',
                    { id:'@id' },
                    {
                        query: {
                            method: 'GET',
                            isArray: true
                        }
                    });

                Object.defineProperty(Bandeja.prototype, 'fecha_ago', {
                    get: function () {
                        moment.locale('es');
                        return moment(this.created_at).fromNow();
                    }
                });
                Object.defineProperty(Bandeja.prototype, 'respondido_ago', {
                    get: function () {
                        moment.locale('es');
                        return moment(this.respondido_at).fromNow();
                    }
                });

                return Bandeja;
            })

            .factory('Service', function($http) {
                return {
                    getApoyos : function() {
                        return $http.get('perfil/apoyos');
                    },
                    getPerfil: function () {
                        return $http.get("perfil/activista");
                    },
                    getDistritos : function(id){
                        return $http.get('perfil/distritos', {params: {idprovincia: id}})
                    },
                    getRegion : function(id){
                        return $http.get('perfil/departamentos');
                    },
                    getProvincia : function(id){
                        return $http.get('perfil/provincias', {params: {iddepartamento: id}})
                    },
                    getSeguidores: function () {return $http.get("seguidor/seguidores");},
                    postSeguidor:function(data) {
                        return $http({
                            method: 'POST',
                            url: 'seguidor/seguidorguardar',
                            headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                            data: $.param(data)
                        });
                    }
                };
            })
            .factory('perfilSvc', function($http) {
                return {
                    getApoyos : function() {
                        return $http.get('perfil/apoyos');
                    },
                    getActivista : function() {
                        return $http.get('perfil/activista');
                    },
                    getLiderpadre : function() {
                        return $http.get('perfil/liderpadre');
                    },
                    postAsignarlider : function(id) {
                        return $http({
                            method: 'POST',
                            url: 'perfil/asignarlider',
                            headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                            data:  $.param({id_lider: id})
                        });
                    },
                    save : function(data) {
                        return $http({
                            method: 'POST',
                            url: 'perfil/guardarperfil',
                            headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                            data: $.param(data)
                        });
                    },
                    getDireccion : function (viewValue){
                        return $http.get('http://maps.googleapis.com/maps/api/geocode/json', {params: {address: viewValue, sensor: false}})
                    },
                    getDistritos : function(id){
                        return $http.get('perfil/distritos', {params: {idprovincia: id}})
                    },
                    getRegion : function(id){
                        return $http.get('perfil/departamentos');
                    },
                    getProvincia : function(id){
                        return $http.get('perfil/provincias', {params: {iddepartamento: id}})
                    },
                    getGruposbyid : function(id){
                        return $http.get('grupo/gruposbyid', {params: {activista_id: id}})
                    },
                    getActivistagrupo : function(){
                        return $http.get('grupo/activistagrupo')
                    },
                    getUnirgrupo : function(grupo_id){
                        return $http.get('grupo/unirgrupo', {params: {grupo_id: grupo_id}})
                    },
                    getSalirgrupo : function(grupo_id){
                        return $http.get('grupo/salirgrupo', {params: {grupo_id: grupo_id}})
                    }
                };
            })
            .factory('perfilSvc', function($http) {
                return {
                    getApoyos : function() {
                        return $http.get('perfil/apoyos');
                    },
                    getActivista : function() {
                        return $http.get('perfil/activista');
                    },
                    getLiderpadre : function() {
                        return $http.get('perfil/liderpadre');
                    },
                    postAsignarlider : function(id) {
                        return $http({
                            method: 'POST',
                            url: 'perfil/asignarlider',
                            headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                            data:  $.param({id_lider: id})
                        });
                    },
                    save : function(data) {
                        return $http({
                            method: 'POST',
                            url: 'perfil/guardarperfil',
                            headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                            data: $.param(data)
                        });
                    },
                    getDireccion : function (viewValue){
                        return $http.get('http://maps.googleapis.com/maps/api/geocode/json', {params: {address: viewValue, sensor: false}})
                    },
                    getDistritos : function(id){
                        return $http.get('perfil/distritos', {params: {idprovincia: id}})
                    },
                    getRegion : function(id){
                        return $http.get('perfil/departamentos');
                    },
                    getProvincia : function(id){
                        return $http.get('perfil/provincias', {params: {iddepartamento: id}})
                    },
                    getGruposbyid : function(id){
                        return $http.get('grupo/gruposbyid', {params: {activista_id: id}})
                    },
                    getUnirgrupo : function(grupo_id){
                        return $http.get('grupo/unirgrupo', {params: {grupo_id: grupo_id}})
                    },
                    getSalirgrupo : function(grupo_id){
                        return $http.get('grupo/salirgrupo', {params: {grupo_id: grupo_id}})
                    },
                    getActivistagrupo : function(){
                        return $http.get('grupo/activistagrupo')
                    }

                };
            })
            .filter('truncate', function () {
                return function (text, length, end) {
                    if (isNaN(length))
                        length = 10;

                    if (end === undefined)
                        end = "...";

                    if (text.length <= length || text.length - end.length <= length) {
                        return text;
                    }
                    else {
                        return String(text).substring(0, length-end.length) + end;
                    }

                };
            })
            .directive('uploadFile', function () {
                return  {
                    restrict: 'E',
                    templateUrl: 'modulos/comunicacion/uploadFile.html',
                    controller: function ($scope, Upload, Archivo) {
                        $scope.progress = 0;
                        $scope.file = undefined;
                        $scope.eliminar = function () {
                            $scope.file = undefined;
                            $scope.mensaje.archivo_id = '';
                        };
                        // Actuliza el file cuando cuando carga el mensaje
                        $scope.$watch('mensaje.id', function (n , o) {
                            if (n && $scope.mensaje.archivo_id  && $scope.mensaje.archivo_id > 0) {
                                $scope.file = Archivo.get({id: $scope.mensaje.archivo_id});
                            }
                        });

                        // upload on file select or drop
                        // https://github.com/danialfarid/ng-file-upload#install
                        $scope.upload = function (file) {
                            if (file) {
                                Upload.upload({
                                    url: 'comunicacion/comunicacionfile',
                                    data: {file: file}
                                }).then(function (resp) {
                                    $scope.progress = 0;
                                    console.log('Success ' + resp.config.data.file.name + 'uploaded. Response: ' + resp.data);
                                    if (resp.data && resp.data > 0)
                                        $scope.file = Archivo.get({id: resp.data});
                                    $scope.mensaje.archivo_id = resp.data;
                                }, function (resp) {
                                    console.log('Error status: ' + resp.status);
                                }, function (evt) {
                                    var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                                    $scope.progress = progressPercentage;
                                    console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
                                });
                            }
                        };
                        $scope.subirArchivo = function () {
                            $scope.upload($scope.file);
                        }
                    }
                }
            })
    })()

</script>