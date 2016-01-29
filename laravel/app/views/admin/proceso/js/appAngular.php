<script>

    (function(){
        angular.module("app", [
            'mgcrea.ngStrap',
            'ngSanitize',
            'ngAnimate',
            'toggle-switch',
            'adaptv.adaptStrap',
            'ngRoute',
            'ngResource'
        ])
            .factory('notificaciones', function($alert){
                return {
                    showNotification: function(message) {
                        $alert({
                            title: message,
                            placement: 'top',
                            type: 'success',
                            show: true,
                            container: '#alerts-container',
                            duration: '3',
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
                            duration: '3',
                            animation: "am-fade-and-slide-top"
                        });
                    }
                }
            })
            .factory('Mensaje', function($resource){
                var Comunicacion = $resource('comunicacion/comunicacion/:id', {id:'@id'}, {
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
    })()

</script>