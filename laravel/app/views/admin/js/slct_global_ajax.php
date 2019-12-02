<script type="text/javascript">
var slctGlobal={
    /**
     * mostrar un mulselect
     * @param:
     * 1 controlador..nombre del controlador   modulo
     * 2 slct         nombre del multiselect   slct_modulos
     * 3 tipo         simple o multiple
     * 4 valarray     valores que se seleccionen
     * 5 data         valores a enviar por ajax
     * 6 afectado     si es afectado o no (1,0)
     * 7 afectados    a quien afecta (slct_submodulos)
     * 8 slct_id      identificador que se esta afectando ('M')
     * 9 slctant
     * 10 slctant_id
     * 11 funciones   evento a ejecutar al hacer hacer changed
     *
     * @return string
     */
    listarSlct:function(controlador,slct,tipo,valarray,data,afectado,afectados,slct_id,slctant,slctant_id, funciones){
        $.ajax({
            url         : controlador+'/listar',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : data,
            beforeSend : function() {
                //$("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                if(obj.rst==1){
                    htmlListarSlct(obj,slct,tipo,valarray,afectado,afectados,slct_id,slctant,slctant_id, funciones);
                    if (funciones!=='' && funciones!==undefined) {
                        if (funciones.success!=='' && funciones.success!==undefined) {
                            funciones.success(obj.datos);
                        }
                    }
                }
            },
            error: function(){
                Psi.mensaje('danger', '<?php echo trans("greetings.mensaje_error"); ?>', 6000);
            }
        });
    },
    listarSlctFuncion:function(controlador,funcion,slct,tipo,valarray,data,afectado,afectados,slct_id,slctant,slctant_id, funciones){
        $.ajax({
            url         : controlador+'/'+funcion,
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : data,
            beforeSend : function() {
                //$("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                if(obj.rst==1){
                    htmlListarSlct(obj,slct,tipo,valarray,afectado,afectados,slct_id,slctant,slctant_id, funciones);
                    if (funciones!=='' && funciones!==undefined) {
                        if (funciones.success!=='' && funciones.success!==undefined) {
                            funciones.success(obj.datos);
                        }
                    }
                }
            },
            error: function(){
                Psi.mensaje('danger', '<?php echo trans("greetings.mensaje_error"); ?>', 6000);
            }
        });
    },
    listarSlctFijo:function(controlador,slct,val,data){
        $.ajax({
            url         : controlador+'/listar',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : data,
            beforeSend : function() {
                //$("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                var html="";
                var selected="";
                html += "<option value=''>Seleccione</option>";
                if(obj.rst==1){
                    $.each(obj.datos,function(index,data){
                        selected="";
                        dat="";
                        if(typeof(val)!='undefined' && val==data.id){
                            selected="selected";
                        }
                        if(typeof(data.dat)!='undefined'){
                            dat="data-dat='"+data.dat+"'";
                        }
                        html += "<option "+dat+" value=\"" + data.id + "\" "+selected+">" + data.nombre + "</option>";
                    });
                }
                $("#"+slct).html(html);
            },
            error: function(){
                Psi.mensaje('danger', '<?php echo trans("greetings.mensaje_error"); ?>', 6000);
            }
        });
    },
    listarSlctFijo2:function(controlador,evento,slct,datos,val,accion){
        $.ajax({
            url         : controlador+'/'+evento,
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : datos,
            beforeSend : function() {
                //$("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                var html="";
                var selected="";
                html += "<option value=''>Seleccione</option>";
                if(obj.rst==1){
                    $.each(obj.datos,function(index,data){
                        selected="";
                        dat="";
                        if(typeof(val)!='undefined' && val==data.id){
                            selected="selected";
                        }
                        if(data.dat!='undefined'){
                            dat="data-dat='"+data.dat+"'";
                        }
                        html += "<option "+dat+" value=\"" + data.id + "\" "+selected+">" + data.nombre + "</option>";
                    });
                }
                $("#"+slct).html(html);
                accion(slct);
            },
            error: function(){
                Psi.mensaje('danger', '<?php echo trans("greetings.mensaje_error"); ?>', 6000);
            }
        });
    },
    listarSlctFijo3:function(controlador,evento,slct){
        $.ajax({
            url         : controlador+'/'+evento,
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            beforeSend : function() {
                //$("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                var html="";
                var selected="";
                html += "<option value=''>Seleccione</option>";
                if(obj.rst==1){
                    $.each(obj.datos,function(index,data){
                        html += "<option value=\"" + data.id + "\" >" + data.nombre + "</option>";
                    });
                }
                $("#"+slct).html(html);
            },
            error: function(){
                Psi.mensaje('danger', '<?php echo trans("greetings.mensaje_error"); ?>', 6000);
            }
        });
    }
};

var dataTableG={
    CargarCab:function(cab){
        var r=[];
        $.each(cab, 
            function(id, val) {
                var rand=Math.floor((Math.random() * 100) + 1);
                r.push({
                    'id'    : id,
                    'idide' :'th_'+id.substr(0,2)+id.substr(-2)+'_'+rand,
                    'nombre': val.split("|")[1],
                    'evento': val.split("|")[0],
                    'color' : val.split("|")[2],
                });
            }
        );
        return r;
    },

    CargarCol:function(cab,col,tar,trpos,ajax,table){
        var r=[];
        for(i=0; i<cab.length; i++){
            tar++;

            if(cab[i].evento*1>0){
            EventoG=cab[i].evento;
            col.push({
                        "targets": tar,
                        "data": function ( row, type, val, meta) {
                            return GeneraFn(row,meta.col);
                        },
                        "defaultContent": '',
                        "name": cab[i].id
                    });
            }
            else{
            col.push({
                        "targets": tar,
                        "data": cab[i].id,
                        "name": cab[i].id
                    });
            }

            if(cab[i].evento*1>0){
                $("#"+table+">tfoot>tr,#"+table+">thead>tr:eq("+trpos+")").append('<th style="background-color:'+cab[i].color+';" class="unread">'+cab[i].nombre+'</th>');
            }
            else{
                $("#"+table+">thead>tr:eq("+trpos+")").append('<th style="background-color:'+cab[i].color+';" class="unread" id="'+cab[i].idide+'">'+cab[i].nombre+
                                                '<input name="txt_'+cab[i].id+'" id="txt_'+cab[i].id+'" '+cab[i].evento+'="MostrarAjax(\''+ajax+'\');" onKeyPress="return enterGlobal(event,\''+cab[i].idide+'\',1)" type="text" class="form-control" placeholder="'+cab[i].nombre+'" />'+
                                                '</th>');
                $("#"+table+">tfoot>tr").append('<th style="background-color:'+cab[i].color+';" class="unread">'+cab[i].nombre+'</th>');
            }
            
        }
        r.push(col);
        r.push(tar);
        return r;
    },
    CargarBtn:function(col,tar,trpos,evento,table,btnfigure,btncolor){
        var r=[];
        if( typeof(btnfigure)=='undefined' ){
            alert('Ingrese su figura del botón para la tabla '+table);
            r.push([]);
            r.push([]);
            return r;
        }

        if( typeof(btncolor)=='undefined' ){
            btncolor='btn-primary'
        }
        tar++;
        $("#"+table+">tfoot>tr,#"+table+">thead>tr:eq("+trpos+")").append('<th class="unread">[]</th>');
        col.push({
                    "targets": tar,
                    "data": function ( row, type, val, meta ) {
                            return  '<a class="form-control btn '+btncolor+'" onClick="'+evento+'(this,\''+row.id+'\')">'+
                                        '<i class="fa fa-lg '+btnfigure+'"></i>'+
                                    '</a>';
                    },
                    "defaultContent": '',
                    "name": "id"
                });
        r.push(col);
        r.push(tar);
        return r;
    },
    CargarDatos:function(id,controlador,funcion,columnDefs){
        $('#t_'+id).dataTable().fnDestroy();
        $('#t_'+id)
            .on( 'page.dt',   function () { $("body").append('<div class="overlay"></div><div class="loading-img"></div>'); } )
            .on( 'search.dt', function () { $("body").append('<div class="overlay"></div><div class="loading-img"></div>'); } )
            .on( 'order.dt',  function () { $("body").append('<div class="overlay"></div><div class="loading-img"></div>'); } )
            .DataTable( {
                "processing": true,
                "serverSide": true,
                "stateSave": true,
                "searching": false,
                "ordering": false,
                "stateLoadCallback": function (settings) {
                    $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
                },
                "stateSaveCallback": function (settings) { // Cuando finaliza el ajax
                    $(".overlay,.loading-img").remove();
                    if( typeof(BottonDblClick)!='undefined' && BottonDblClick){
                        BtnDblClick();
                    }
                },
                "ajax": {
                        "url": controlador+"/"+funcion,
                        "type": "POST",
                        //"async": false,
                            "data": function(d){
                                datos=$("#form_"+id).serialize().split("txt_").join("").split("slct_").join("").split("%5B%5D").join("[]").split("+").join(" ").split("%7C").join("|").split("&");
                                
                                for (var i = datos.length - 1; i >= 0; i--) {
                                    if( datos[i].split("[]").length>1 ){
                                        d[ datos[i].split("[]").join("["+contador+"]").split("=")[0] ] = datos[i].split("=")[1];
                                        contador++;
                                    }
                                    else{
                                        d[ datos[i].split("=")[0] ] = datos[i].split("=")[1];
                                    }
                                };
                            },
                        },
                columnDefs
            } );
    },
};

var msjG = {
    /**
     * Muestra un mensaje al pie de la página
     * 
     * @param String tipo "success" para OK o "danger" para ERROR
     * @param String texto El mensaje a mostrar
     * @param Int tiempo Tiempo que tarda en desaparecer el mensaje
     * @returns {undefined}
     */
    mensaje: function (tipo, texto, tiempo) {
        if (tipo == 'danger' && texto.length == 0) {
            texto = 'Ocurrio una interrupción en el proceso, favor de intentar nuevamente.';
        }
        $("#msj").html('<div class="alert alert-dismissable alert-' + tipo + '">' +
                '<i class="fa fa-ban"></i>' +
                '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' +
                '<b>' + texto + '</b>' +
                '</div>');
        $("#msj").effect('shake');
        $("#msj").fadeOut(tiempo);
    },
    validaDni:function(e,t){ 
        tecla = (document.all) ? e.keyCode : e.which;//captura evento teclado
        if (tecla==8 || tecla==0) return true;//8 barra, 0 flechas desplaz
        if($(t).val().length==8)return false;
        patron = /\d/; // Solo acepta números
        te = String.fromCharCode(tecla); 
        return patron.test(te);
    },
    validaLetras:function(e) { // 1
        tecla = (document.all) ? e.keyCode : e.which; // 2
        if (tecla==8 || tecla==0) return true;//8 barra, 0 flechas desplaz
        patron =/[A-Za-zñÑáéíóúÁÉÍÓÚ\s]/; // 4 ,\s espacio en blanco, patron = /\d/; // Solo acepta números, patron = /\w/; // Acepta números y letras, patron = /\D/; // No acepta números, patron =/[A-Za-z\s]/; //sin ñÑ
        te = String.fromCharCode(tecla); // 5
        return patron.test(te); // 6
    },
    validaAlfanumerico:function(e) { // 1
        tecla = (document.all) ? e.keyCode : e.which; // 2
        if (tecla==8 || tecla==0 || tecla==46) return true;//8 barra, 0 flechas desplaz
        patron =/[A-Za-zñÑáéíóúÁÉÍÓÚ@.,_\-\s\d]/; // 4 ,\s espacio en blanco, patron = /\d/; // Solo acepta números, patron = /\w/; // Acepta números y letras, patron = /\D/; // No acepta números, patron =/[A-Za-z\s]/; //sin ñÑ
        te = String.fromCharCode(tecla); // 5
        return patron.test(te); // 6
    },
    validaNumeros:function(e) { // 1
        tecla = (document.all) ? e.keyCode : e.which; // 2
        if (tecla==8 || tecla==0 || tecla==46) return true;//8 barra, 0 flechas desplaz
        patron = /\d/; // Solo acepta números
        te = String.fromCharCode(tecla); // 5
        return patron.test(te); // 6
    },
};
</script>
