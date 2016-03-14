<script type="text/javascript">
$(document).ready(function() {  
    Grupo.CargarGrupo(activarTabla);
    slctGlobal.listarSlctFijo('tgrupo','slct_grupo');

    $('#grupoModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // captura al boton
        var titulo = button.data('titulo'); // extrae del atributo data-
        grupo_id = button.data('id'); //extrae el id del atributo data
        //var data = {grupo_id: grupo_id};
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this); //captura el modal
        modal.find('.modal-title').text(titulo+' Tipo Grupo');
        $('#form_grupo [data-toggle="tooltip"]').css("display","none");
        $("#form_grupo input[type='hidden']").remove();
        var data={};
        
        if(titulo=='Nuevo'){
            data={cid:"0"};
            modal.find('.modal-footer .btn-primary').text('Guardar');
            modal.find('.modal-footer .btn-primary').attr('onClick','Agregar();');
            $('#form_grupo #slct_estado').val(1); 
            $('#form_grupo #slct_grupo').val(''); 
            $('#form_grupo #txt_nombre').focus();
        }
        else{
            data={cid:grupo_id};
            
            modal.find('.modal-footer .btn-primary').text('Actualizar');
            modal.find('.modal-footer .btn-primary').attr('onClick','Editar();');

            $('#form_grupo #txt_nombre').val( GrupoObj[grupo_id-1].nombre );
            $('#form_grupo #slct_grupo').val( GrupoObj[grupo_id-1].tipo_grupo_id );
            $('#form_grupo #slct_estado').val( GrupoObj[grupo_id-1].estado );
            $("#form_grupo").append("<input type='hidden' value='"+button.data('id')+"' name='id'>");
        }

        $( "#form_grupo #slct_estado" ).trigger('change');
        $( "#form_grupo #slct_estado" ).change(function() {
            if ($( "#form_grupo #slct_estado" ).val()==1) {
                $('fieldset').removeAttr('disabled');
            }
            else {
                $('fieldset').attr('disabled', 'disabled');
            }
        });

    });

    $('#grupoModal').on('hide.bs.modal', function (event) {
        var modal = $(this); //captura el modal
        modal.find('.modal-body input').val(''); // busca un input para copiarle texto
        $("#t_opcionGrupo").html('');
        menus_selec=[];
    });
});

opcionesHTML=function(datos){
    var html="";

    $.each(datos,function(index,data){
        estadohtml='<span id="s_'+data.id+'" onClick="activarOpcion('+data.id+')" class="btn btn-danger">Sin Acceso</span>';
        if(data.estado==1){
            estadohtml='<span id="s_'+data.id+'" onClick="desactivarOpcion('+data.id+')" class="btn btn-success">Con Acceso</span>';
        }

        html+="<tr>"+
            "<td >"+data.nombre+"<input type='hidden' value='"+data.estado+"_"+data.id+"' name='opciones[]'' id='o_"+data.id+"'></td>"+
            "<td >"+estadohtml+"</td>";
        html+="</tr>";
    });
    $("#tb_opciones tbody").html(html); 
}

activarOpcion=function(id){
    //alert("activiando");
    $("span#s_"+id).attr("onClick","desactivarOpcion("+id+")");
    $("span#s_"+id).removeClass("btn-danger").addClass('btn-success');
    $("span#s_"+id).html('Con Acceso');
    $("#o_"+id).val("1_"+id);
}

desactivarOpcion=function(id){
    //alert("desactiviando");
    $("span#s_"+id).attr("onClick","activarOpcion("+id+")");
    $("span#s_"+id).removeClass("btn-success").addClass('btn-danger');
    $("span#s_"+id).html('Sin Acceso');
    $("#o_"+id).val("0_"+id);
}

activarTabla=function(){
    $("#t_grupo").dataTable(); // inicializo el datatable    
};

Editar=function(){
    if(validaGrupo()){
        Grupo.AgregarEditarGrupo(1);
    }
};

activar=function(id){
    Grupo.CambiarEstadoGrupo(id,1);
};
desactivar=function(id){
    Grupo.CambiarEstadoGrupo(id,0);
};

Agregar=function(){
    if(validaGrupo()){
        Grupo.AgregarEditarGrupo(0);
    }
};

EliminarOpcion=function(obj){
    //console.log(obj);
    var valor= obj.id;
    obj.parentNode.parentNode.parentNode.remove();
    var index = menus_selec.indexOf(valor);
    menus_selec.splice( index, 1 );
};
validaGrupo=function(){
    $('#form_grupo [data-toggle="tooltip"]').css("display","none");
    var a=[];
    a[0]=valida("txt","nombre","");
    var rpta=true;

    for(i=0;i<a.length;i++){
        if(a[i]===false){
            rpta=false;
            break;
        }
    }
    return rpta;
};

valida=function(inicial,id,v_default){
    var texto="Seleccione";
    if(inicial=="txt"){
        texto="Ingrese";
    }

    if( $.trim($("#"+inicial+"_"+id).val())==v_default ){
        $('#error_'+id).attr('data-original-title',texto+' '+id);
        $('#error_'+id).css('display','');
        return false;
    }   
};

HTMLCargarGrupo=function(datos){
    var html="";
    $('#t_grupo').dataTable().fnDestroy();

    $.each(datos,function(index,data){
        estadohtml='<span id="'+data.id+'" onClick="activar('+data.id+')" class="btn btn-danger">Inactivo</span>';
        if(data.estado==1){
            estadohtml='<span id="'+data.id+'" onClick="desactivar('+data.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr>"+
            "<td >"+data.grupo+"</td>"+
            "<td >"+data.nombre+"</td>"+
            "<td id='estado_"+data.id+"' data-estado='"+data.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#grupoModal" data-id="'+data.id+'" data-titulo="Editar"><i class="fa fa-edit fa-lg"></i> </a></td>';

        html+="</tr>";
    });
    $("#tb_grupo").html(html); 
    activarTabla();
};
</script>

