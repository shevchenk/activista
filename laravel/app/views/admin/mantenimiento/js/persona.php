<script type="text/javascript">
var cabeceraP=[];
var columnDefsP=[];
var targetsA=-1;
var ValorBuscadoF='';
$(document).ready(function() {  
    //Persona.CargarPersonas(activarTabla);
    slctGlobal.listarSlctFijo('cargo','slct_cargos');
    slctGlobal.listarSlctFijo('grupop','slct_grupos');

    cabeceraP=  [{
                'id'    :'nivel',
                'idide' :'th_ni',
                'nombre':'Nivel',
                'evento':'onBlur',
                },
                {
                'id'    :'paterno',
                'idide' :'th_pa',
                'nombre':'Paterno',
                'evento':'onBlur',
                },
                {
                'id'    :'materno',
                'idide' :'th_ma',
                'nombre':'Materno',
                'evento':'onBlur',
                },
                {
                'id'    :'nombres',
                'idide' :'th_no',
                'nombre':'Nombres',
                'evento':'onBlur',
                },
                {
                'id'    :'email',
                'idide' :'th_em',
                'nombre':'EMAIL',
                'evento':'onBlur',
                },
                {
                'id'    :'dni',
                'idide' :'th_dni',
                'nombre':'DNI',
                'evento':'onBlur',
                }
                ];
    for(i=0; i<cabeceraP.length; i++){
            targetsA++;
            columnDefsP.push({
                                "targets": targetsA,
                                "data": cabeceraP[i].id,
                                "name": cabeceraP[i].id
                            });

            $("#t_personas>thead>tr").append('<th class="unread" id="'+cabeceraP[i].idide+'"><label>'+cabeceraP[i].nombre+'</label>'+
                                            '<input name="txt_'+cabeceraP[i].id+'" id="txt_'+cabeceraP[i].id+'" '+cabeceraP[i].evento+'="MostrarAjax(\'persona\');" onKeyPress="return enterGlobal(event,\''+cabeceraP[i].idide+'\',1)" type="text" placeholder="'+cabeceraP[i].nombre+'" />'+
                                            '</th>');
            $("#t_personas>tfoot>tr").append('<th class="unread">'+cabeceraP[i].nombre+'</th>');
        }
            targetsA++;
            $("#t_personas>thead>tr").append('<th class="unread" id="th_es"><label>Estado</label>'+
                                                '<select name="slct_estado" id="slct_estado" onChange="MostrarAjax(\'persona\');" >'+
                                                 '<option value="" selected>.::Todo::.</option>'+
                                                 '<option value="1">Activo</option>'+
                                                 '<option value="0">Inactivo</option>'+
                                                 '</select>'+
                                             '</th>');
            $("#t_personas>tfoot>tr").append('<th class="unread"><label>Estado</label></th>');

            columnDefsP.push({
                                "targets": targetsA,
                                "data": function ( row, type, val, meta ) {
                                        estadohtml='<span id="'+row.id+'" onClick="activar('+row.id+')" class="btn btn-danger">Inactivo</span>';
                                        if(row.estado==1){
                                            estadohtml='<span id="'+row.id+'" onClick="desactivar('+row.id+')" class="btn btn-success">Activo</span>';
                                        }
                                        return estadohtml;
                                },
                                "defaultContent": '',
                                "name": "estado"
                            });
            targetsA++;
            $("#t_personas>tfoot>tr,#t_personas>thead>tr").append('<th class="unread">[]</th>');
            columnDefsP.push({
                                "targets": targetsA,
                                "data": function ( row, type, val, meta ) {
                                        PersonaObj.push(row);
                                        console.log(PersonaObj);
                                        return  '<a class="btn btn-primary btn-sm" data-toggle="modal" onClick="CargarPersonaT()" data-target="#personaModal" data-id="'+row.id+'" data-titulo="Editar">'+
                                                    '<i class="fa fa-edit fa-lg"></i>'+
                                                '</a>';
                                },
                                "defaultContent": '',
                                "name": "id"
                            });

    $('#personaModal').on('show.bs.modal', function (event) {
        
        $('#txt_fecha_nac').daterangepicker({
            format: 'YYYY-MM-DD',
            singleDatePicker: true,
            showDropdowns: true
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
            PersonaObj[persona_id]
            ValorBuscadoF=persona_id; // para encontrar valor real
            var arrPorID = PersonaObj.filter(filtrarPorID);
            
            $('#form_personas #txt_nombres').val( arrPorID[0].nombres );
            $('#form_personas #txt_paterno').val( arrPorID[0].paterno );
            $('#form_personas #txt_materno').val( arrPorID[0].materno );
            $('#form_personas #txt_fecha_nac').val( arrPorID[0].fecha_nacimiento );
            $('#form_personas #txt_dni').val( arrPorID[0].dni );
            $('#form_personas #txt_password').val( '' );
            $('#form_personas #txt_email').val( arrPorID[0].email );
            $('#form_personas #slct_sexo').val( arrPorID[0].sexo );
            $('#form_personas #slct_estado').val( arrPorID[0].estado );
            $('#form_personas #slct_cargos').val( arrPorID[0].cargo_id );
            $('#form_personas #slct_grupos').val( arrPorID[0].grupo_persona_id );
            $("#form_personas").append("<input type='hidden' value='"+arrPorID[0].id+"' name='id'>");
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

    MostrarAjax('persona');
});

CargarPersonaT=function(){
console.log(PersonaObj);
}

MostrarAjax=function(t){
    if( t=="persona" ){
        Persona.CargarPersonasTotal(columnDefsP);
    }
}

function filtrarPorID(obj) {
  if ('id' in obj && obj.id==ValorBuscadoF ) {
    return true;
  } else {
    return false;
  }
}


eventoSlctGlobalSimple=function(){
}

/*activarTabla=function(){
    $("#t_personas").dataTable(); // inicializo el datatable    
};*/

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

/*HTMLCargarPersona=function(datos){
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
};*/
</script>
