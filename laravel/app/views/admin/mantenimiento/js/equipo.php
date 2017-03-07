<script type="text/javascript">
var Pest=1;
var ValorBuscadoF='';
$(document).ready(function() { 
    $('.fecha').daterangepicker({
        format: 'YYYY-MM-DD',
        singleDatePicker: true,
        showDropdowns: true
    });

    Grupo.CargarGrupo(HTMLCargarGrupo);
    slctGlobal.listarSlctFijo('tgrupo','slct_grupo');
    //slctGlobalHtml('slct_cargo','multiple');
    $('#grupoModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // captura al boton
        var titulo = button.data('titulo'); // extrae del atributo data-
        grupo_id = button.data('id'); //extrae el id del atributo data
        //var data = {grupo_id: grupo_id};
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this); //captura el modal
        modal.find('.modal-title').text(titulo+' Equipo');
        $('#form_grupo [data-toggle="tooltip"]').css("display","none");
        $("#form_grupo input[type='hidden']").remove();
        $("#form_cargo input[type='text']").val('');
        var data={};
        $('#slct_provincia,#slct_distrito').html('');
        
        if(titulo=='Nuevo'){
            slctGlobal.listarSlctFijo2('ubigeo','cargarregion','slct_region');
            data={cid:"0"};
            modal.find('.modal-footer .btn-primary').text('Guardar');
            modal.find('.modal-footer .btn-primary').attr('onClick','Agregar();');
            $('#form_grupo #slct_estado').val(1); 
            $('#form_grupo #slct_grupo').val(''); 
            $('#form_grupo #txt_nombre').focus();
        }
        else{
            data={cid:grupo_id};
            ValorBuscadoF=grupo_id; // para encontrar valor real
            var arrPorID = GrupoObj.filter(filtrarPorID);
            
            modal.find('.modal-footer .btn-primary').text('Actualizar');
            modal.find('.modal-footer .btn-primary').attr('onClick','Editar();');

            slctGlobal.listarSlctFijo2('ubigeo','cargarregion','slct_region',null,arrPorID[0].departamento_id);
            CargarProvincia(arrPorID[0].departamento_id,arrPorID[0].provincia_id);
            CargarDistrito(arrPorID[0].provincia_id,arrPorID[0].distrito_id);

            $('#form_grupo #txt_nombre').val( arrPorID[0].nombre );
            $('#form_grupo #slct_grupo').val( arrPorID[0].tipo_grupo_id );
            $('#form_grupo #txt_localidad').val( arrPorID[0].localidad );
            $('#form_grupo #txt_direccion').val( arrPorID[0].direccion );
            $('#form_grupo #txt_telefono').val( arrPorID[0].telefono );
            $('#form_grupo #slct_estado').val( arrPorID[0].estado );
            $("#form_grupo").append("<input type='hidden' value='"+button.data('id')+"' name='id'>");
            
            ValidaTerritorial(arrPorID[0].tipo_grupo_id);
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
    });
});

function filtrarPorID(obj) {
  if ('id' in obj && obj.id==ValorBuscadoF ) {
    return true;
  } else {
    return false;
  }
}

CargarProvincia=function(id,val){
    var data={departamento_id:id};
    slctGlobal.listarSlctFijo2('ubigeo','cargarprovincia','slct_provincia',data,val);
}

CargarDistrito=function(id,val){
    var data={provincia_id:id};
    slctGlobal.listarSlctFijo2('ubigeo','cargardistrito','slct_distrito',data,val);
}

ActPest=function(nro){
    Pest=nro;
    if( Pest==1 ){
        Grupo.CargarGrupo(HTMLCargarGrupo);
    }
    else if( Pest==2 ){
        Grupo.CargarCargo(HTMLCargarCargo);
    }
    else if( Pest==3 ){
        //slctGlobal.listarSlct('cargo_estrategico','slct_cargo','multiple');
        Grupo.CargarGrupoCargo(HTMLCargarGrupoCargo);
    }
}

Agregar=function(){
    if( Pest==1 ){
        if(validaGrupo()){
        Grupo.AgregarEditarGrupo(0);
        }
    }
    else if( Pest==2 ){
        if(validaCargo()){
        Grupo.AgregarEditarCargo(0);
        }
    }
    else if( Pest==3 ){
        if(validaGrupoCargo()){
        Grupo.AgregarEditarGrupoCargo(0);
        }
    }
};

Editar=function(){
    if( Pest==1 ){
        if(validaGrupo()){
        Grupo.AgregarEditarGrupo(1);
        }
    }
    else if( Pest==2 ){
        if(validaCargo()){
        Grupo.AgregarEditarCargo(1);
        }
    }
    else if( Pest==3 ){
        if(validaGrupoCargo()){
        Grupo.AgregarEditarGrupoCargo(1);
        }
    }
};

activar=function(id){
    if( Pest==1 ){
    Grupo.CambiarEstadoGrupo(id,1);
    }
    else if( Pest==2 ){
    Grupo.CambiarEstadoCargo(id,1);
    }
    else if( Pest==3 ){
    Grupo.CambiarEstadoGrupoCargo(id,1);
    }
};

desactivar=function(id){
    if( Pest==1 ){
    Grupo.CambiarEstadoGrupo(id,0);
    }
    else if( Pest==2 ){
    Grupo.CambiarEstadoCargo(id,0);
    }
    else if( Pest==3 ){
    Grupo.CambiarEstadoGrupoCargo(id,0);
    }
};

ValidaTerritorial=function(val){
    $(".ocultar").css('display','');
    if( $("#slct_grupo option:selected").attr("data-dat")!=1 ){
        $(".ocultar").css('display','none');
    }
}

validaGrupo=function(){
    var rpta=true;

    if( $.trim($('#form_grupo #slct_grupo').val())=='' ){
        alert('Seleccione Tipo Grupo');
        rpta=false;
    }
    else if( $.trim($('#form_grupo #txt_nombre').val())=='' ){
        alert('Ingrese Nombre');
        rpta=false;
    }
    else if( $.trim($('#form_grupo #slct_grupo').val())==2 && $.trim($('#form_grupo #slct_region').val())=='' ){
        alert('Seleccione Region');
        rpta=false;
    }
    else if( $.trim($('#form_grupo #slct_grupo').val())==2 && $.trim($('#form_grupo #slct_provincia').val())=='' ){
        alert('Seleccione Provincia');
        rpta=false;
    }
    else if( $.trim($('#form_grupo #slct_grupo').val())==2 && $.trim($('#form_grupo #slct_distrito').val())=='' ){
        alert('Seleccione Distrito');
        rpta=false;
    }
    else if( $.trim($('#form_grupo #slct_grupo').val())==2 && $.trim($('#form_grupo #txt_localidad').val())=='' ){
        alert('Ingrese Localidad');
        rpta=false;
    }
    return rpta;
};

validaCargo=function(){
    var rpta=true;

    if( $.trim($('#form_cargo #txt_nombre').val())=='' ){
        alert('Ingrese Nombre');
        rpta=false;
    }
    return rpta;
};

validaGrupoCargo=function(){
    var rpta=true;

    if( $.trim($('#form_grupocargo #slct_grupop').val())=='' ){
        alert('Seleccione Zona de Influencia');
        rpta=false;
    }
    else if( $.trim($('#form_grupocargo #slct_cargo').val())=='' ){
        alert('Seleccione Cargo');
        rpta=false;
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
            "<td >"+$.trim(data.departamento)+"</td>"+
            "<td >"+$.trim(data.provincia)+"</td>"+
            "<td >"+$.trim(data.distrito)+"</td>"+
            "<td >"+$.trim(data.localidad)+"</td>"+
            "<td >"+$.trim(data.direccion)+"</td>"+
            "<td >"+$.trim(data.telefono)+"</td>"+
            "<td id='estado_"+data.id+"' data-estado='"+data.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#grupoModal" data-id="'+data.id+'" data-titulo="Editar"><i class="fa fa-edit fa-lg"></i> </a></td>';

        html+="</tr>";
    });
    $("#t_grupo>tbody").html(html); 
    $("#t_grupo").dataTable(); // inicializo el datatable    
};

HTMLCargarCargo=function(datos){
    var html="";
    $('#t_cargo').dataTable().fnDestroy();

    $.each(datos,function(index,data){
        estadohtml='<span id="'+data.id+'" onClick="activar('+data.id+')" class="btn btn-danger">Inactivo</span>';
        if(data.estado==1){
            estadohtml='<span id="'+data.id+'" onClick="desactivar('+data.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr>"+
            "<td >"+data.nombre+"</td>"+
            "<td id='estado_"+data.id+"' data-estado='"+data.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cargoModal" data-id="'+data.id+'" data-titulo="Editar"><i class="fa fa-edit fa-lg"></i> </a></td>';

        html+="</tr>";
    });
    $("#t_cargo>tbody").html(html); 
    $("#t_cargo").dataTable(); // inicializo el datatable    
};

HTMLCargarGrupoCargo=function(datos){
    var html="";
    $('#t_grupocargo').dataTable().fnDestroy();

    $.each(datos,function(index,data){
        estadohtml='<span id="'+data.id+'" onClick="activar('+data.id+')" class="btn btn-danger">Inactivo</span>';
        if(data.estado==1){
            estadohtml='<span id="'+data.id+'" onClick="desactivar('+data.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr>"+
            "<td >"+data.grupo+"</td>"+
            "<td >"+data.cargo+"</td>"+
            "<td >"+data.fecha_inicio+"</td>"+
            "<td id='estado_"+data.id+"' data-estado='"+data.estado+"'>"+estadohtml+"</td>"+
            '<td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#grupocargoModal" data-id="'+data.id+'" data-titulo="Editar"><i class="fa fa-edit fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#t_grupocargo>tbody").html(html); 
    $("#t_grupocargo").dataTable(); // inicializo el datatable    
};
</script>

