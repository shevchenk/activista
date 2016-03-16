<script type="text/javascript">
$(document).ready(function() {  
    Persona.CargarPersonas(activarTabla);
    slctGlobal.listarSlctFijo('cargo','slct_cargos');
    slctGlobal.listarSlctFijo('grupop','slct_grupos');

    $('#personaModal').on('show.bs.modal', function (event) {
        
        $('#txt_fecha_nac').daterangepicker({
            format: 'YYYY-MM-DD',
            singleDatePicker: true
        });

        var button = $(event.relatedTarget); // captura al boton
        var titulo = button.data('titulo'); // extrae del atributo data-
        var persona_id = button.data('id'); //extrae el id del atributo data
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this); //captura el modal
        modal.find('.modal-title').text(titulo+' Persona');
        $('#form_personas [data-toggle="tooltip"]').css("display","none");
        $("#form_personas input[type='hidden']").remove();
        
        if(titulo=='Nuevo'){
            
            modal.find('.modal-footer .btn-primary').text('Guardar');
            modal.find('.modal-footer .btn-primary').attr('onClick','Agregar();');
            $('#form_personas #slct_estado').val(1); 
            $('#form_personas #txt_nombres').focus();
            var datos={estado:1};
            $('#form_personas #slct_cargos,#form_personas #slct_grupos').val( '' );
            $('.editar').css('display','none');
        }
        else{
            modal.find('.modal-footer .btn-primary').text('Actualizar');
            modal.find('.modal-footer .btn-primary').attr('onClick','Editar();');
            //PersonaObj[persona_id]
            $('#form_personas #txt_nombres').val( PersonaObj[persona_id].nombres );
            $('#form_personas #txt_paterno').val( PersonaObj[persona_id].paterno );
            $('#form_personas #txt_materno').val( PersonaObj[persona_id].materno );
            $('#form_personas #txt_fecha_nac').val( PersonaObj[persona_id].fecha_nacimiento );
            $('#form_personas #txt_dni').val( PersonaObj[persona_id].dni );
            $('#form_personas #txt_password').val( '' );
            $('#form_personas #txt_email').val( PersonaObj[persona_id].email );
            $('#form_personas #slct_sexo').val( PersonaObj[persona_id].sexo );
            $('#form_personas #slct_estado').val( PersonaObj[persona_id].estado );
            $('#form_personas #slct_cargos').val( PersonaObj[persona_id].cargo_id );
            $('#form_personas #slct_grupos').val( PersonaObj[persona_id].grupo_persona_id );
            $("#form_personas").append("<input type='hidden' value='"+PersonaObj[persona_id].id+"' name='id'>");
            $('.editar').css('display','');
            var datos={estado:1};
        }


        $( "#form_personas #slct_estado" ).trigger('change');
    });

    $('#personaModal').on('hide.bs.modal', function (event) {
        var modal = $(this); //captura el modal
        modal.find('.modal-body input').val(''); // busca un input para copiarle texto
        $("#t_cargoPersona").html('');
    });
});

eventoSlctGlobalSimple=function(){
}

activarTabla=function(){
    $("#t_personas").dataTable(); // inicializo el datatable    
};

Editar=function(){
    if(validaPersonas()){
        Persona.AgregarEditarPersona(1);
    }
};

activar=function(id){
    Persona.CambiarEstadoPersonas(id,1);
};
desactivar=function(id){
    Persona.CambiarEstadoPersonas(id,0);
};

Agregar=function(){
    if(validaPersonas()){
        Persona.AgregarEditarPersona(0);
    }
};

validaPersonas=function(){
    $('#form_personas [data-toggle="tooltip"]').css("display","none");
    var a=[];
    a[0]=valida("txt","nombres","");
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

HTMLCargarPersona=function(datos){
    var html="";
    $('#t_personas').dataTable().fnDestroy();

    $.each(datos,function(index,data){
        estadohtml='<span id="'+data.id+'" onClick="activar('+data.id+')" class="btn btn-danger">Inactivo</span>';
        if(data.estado==1){
            estadohtml='<span id="'+data.id+'" onClick="desactivar('+data.id+')" class="btn btn-success">Activo</span>';
        }
        html+="<tr>"+
            "<td >"+data.nivel+"</td>"+
            "<td >"+data.paterno+' '+"</td>"+
            "<td >"+data.materno+"</td>"+
            "<td >"+data.nombres+"</td>"+
            "<td >"+data.email+"</td>"+
            "<td >"+data.dni+"</td>"+
            "<td id='estado_"+data.id+"' data-estado='"+data.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#personaModal" data-id="'+index+'" data-titulo="Editar"><i class="fa fa-edit fa-lg"></i> </a></td>';

        html+="</tr>";
    });
    $("#tb_personas").html(html);
    activarTabla();
};
</script>
