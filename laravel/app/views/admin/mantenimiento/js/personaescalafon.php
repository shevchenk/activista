<script type="text/javascript">
var contadorG=0;
var cabeceraP=[];
var columnDefsP=[];
var targetsA=-1;
var ValorBuscadoF='';
$(document).ready(function() {  
    //Persona.CargarPersonas(activarTabla);
    slctGlobal.listarSlctFijo('cargo','slct_cargos');
    slctGlobal.listarSlctFijo2('grupop','listargrupoe','slct_grupos');

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
                                        estadohtml='<span id="'+row.id+'" class="btn btn-danger">Inactivo</span>';
                                        if(row.estado==1){
                                            estadohtml='<span id="'+row.id+'" class="btn btn-success">Activo</span>';
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
                                        return  '<a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#personaModal" data-id="'+row.id+'" data-titulo="Editar">'+
                                                    '<i class="fa fa-edit fa-lg"></i>'+
                                                '</a>';
                                },
                                "defaultContent": '',
                                "name": "id"
                            });

    $('#personaModal').on('show.bs.modal', function (event) {
        
        /*$('#txt_fecha_nac').daterangepicker({
            format: 'YYYY-MM-DD',
            singleDatePicker: true,
            showDropdowns: true
        });*/

        var button = $(event.relatedTarget); // captura al boton
        var titulo = button.data('titulo'); // extrae del atributo data-
        var persona_id = button.data('id'); //extrae el id del atributo data
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this); //captura el modal
        modal.find('.modal-title').text(titulo+' Escalafon de la Persona');
        $('#form_personas [data-toggle="tooltip"]').css("display","none");
        $("#form_personas input[type='hidden']").remove();
        
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

            Persona.CargarEscalafon(arrPorID[0].id);

        $( "#form_personas #slct_estado" ).trigger('change');
    });

    $('#personaModal').on('hide.bs.modal', function (event) {
        var modal = $(this); //captura el modal
        modal.find('.modal-body input').val(''); // busca un input para copiarle texto
        $("#t_cargoPersona tbody").html('');
    });

    MostrarAjax('persona');
});

AgregarEscalafon=function(val){
    contadorG++;
    html='';
    html+='<tr>';
    html+='<td><select name="slct_grupo[]" id="slct_grupo_'+contadorG+'" onChange="CargarCargoEscalafon(this.value,'+contadorG+');"></select></td>';
    html+='<td><input name="txt_escalafon_id[]" id="txt_escalafon_id_'+contadorG+'" type="hidden" value="0"><select name="slct_cargo[]" id="slct_cargo_'+contadorG+'"></select></td>';
    html+='<td><input name="txt_fecha_inicio[]" id="txt_fecha_inicio_'+contadorG+'" type="text" class="form-control fecha"></td>';
    html+='<td><input name="txt_documento_inicio[]" id="txt_documento_inicio_'+contadorG+'" type="text" class="form-control"></td>';
    html+='<td><input name="txt_fecha_final[]" id="txt_fecha_final_'+contadorG+'" type="text" class="form-control fecha"></td>';
    html+='<td><input name="txt_documento_final[]" id="txt_documento_final_'+contadorG+'" type="text" class="form-control"></td>';
    html+="<td><button type='button' onClick='EliminarEscalafon(this);' class='btn btn-sm btn-danger'><i class='fa fa-lg fa-minus'></i></button></td>";
    html+='</tr>';
    $("#t_cargoPersona").append(html);
    $("#slct_grupo_"+contadorG).html( $("#slct_grupos").html() );
    $('.fecha').daterangepicker({
        format: 'YYYY-MM-DD',
        singleDatePicker: true,
        showDropdowns: true
    });

    if(typeof(val)!='undefined' ){
        $("#slct_grupo_"+contadorG).val( val.grupo_persona_id );
        CargarCargoEscalafon(val.grupo_persona_id,contadorG,val.cargo_estrategico_id);
        $("#txt_fecha_inicio_"+contadorG).val( val.fecha_inicio );
        $("#txt_fecha_final_"+contadorG).val( val.fecha_final );
        $("#txt_documento_inicio_"+contadorG).val( val.documento_inicio );
        $("#txt_documento_final_"+contadorG).val( val.documento_final );
        $("#txt_escalafon_id_"+contadorG).val( val.id );
    }
}

EliminarEscalafon=function(btn){
    var tr = btn.parentNode.parentNode;
    $(tr).remove();
}

CargarCargoEscalafon=function(val,cont,id){
    var data={grupo_persona_id:val};
    slctGlobal.listarSlctFijo2('grupop','listarcargoe','slct_cargo_'+cont,data,id);
}

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
    Persona.AddEditEscalafon();
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
</script>
