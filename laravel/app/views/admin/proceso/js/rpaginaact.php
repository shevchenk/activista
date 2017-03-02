<script type="text/javascript">
var cabeceraP=[];
var columnDefsP=[];
var targetsP=-1;
var OrdenG=0; // inicializa el orden
var IdEscalafonG=0; // Id Global del ecalafon
var IdEscalafonFichaG=0; // Id Global del ecalafon ficha
var TotalEntregadoG=0; // Total de entregados a validar
var DesdeEntregadoG=0;
var HastaEntregadoG=0;
var BottonDblClick=true;
$(document).ready(function() {
    $("[data-toggle='offcanvas']").click();
    var data = {estado:1};
    var ids = [];

    slctGlobal.listarSlctFijo('grupop','slct_equipo_id');

    var idG={ paterno       :'onBlur|Paterno|#DCE6F1',
              materno       :'onBlur|Materno|#DCE6F1',
              nombres       :'onBlur|Nombres|#DCE6F1',
              cargo         :'onBlur|Cargo|#DCE6F1',
              equipo        :'onBlur|Equipo|#F2DCDB',
              departamento  :'onBlur|Departamento|#F2DCDB',
              provincia     :'onBlur|Provincia|#F2DCDB',
              distrito      :'onBlur|Distrito|#F2DCDB',
              localidad     :'onBlur|Localidad|#F2DCDB',
             };

    var resG=dataTableG.CargarCab(idG);
    cabeceraP=resG; // registra la cabecera
    var resG=dataTableG.CargarCol(cabeceraP,columnDefsP,targetsP,1,'personas_equipos','t_personas_equipos');
    columnDefsP=resG[0]; // registra las columnas del datatable
    targetsP=resG[1]; // registra los contadores
    var resG=dataTableG.CargarBtn(columnDefsP,targetsP,1,'DetalleEntrega','t_personas_equipos','fa-edit');
    columnDefsP=resG[0]; // registra la colunmna adiciona con boton
    targetsP=resG[1]; // registra el contador actualizado
});

CargarPersonas=function(){
    MostrarAjax('personas_equipos');
}

BtnDblClick=function(){
    $("#t_personas_equipos>tbody>tr").attr("OnDblClick","BtnDbl(this)");
}

BtnDbl=function(t){
    $(t).find("a").click();
}

ListarFicha=function(v){
    var tr="";
    if( v!='' && v*1>0 ){ 
        for (var i = 1; i < 11; i++) {
            tr+="<tr>";
                tr+="<td>"+v+"</td>";
                tr+="<td>"+i+"</td>";
                tr+="<td><input type='text' class='form-control' onKeyPress='return msjG.validaDni(event,this);' name='txt_dni[]'></td>";
                tr+="<td><input type='text' style='text-transform: uppercase;' class='form-control' onKeyPress='return msjG.validaLetras(event);' name='txt_paterno[]'></td>";
                tr+="<td><input type='text' style='text-transform: uppercase;' class='form-control' onKeyPress='return msjG.validaLetras(event);' name='txt_materno[]'></td>";
                tr+="<td><input type='text' style='text-transform: uppercase;' class='form-control' onKeyPress='return msjG.validaLetras(event);' name='txt_nombre[]'></td>";
            tr+="</tr>";
        }
    }
    $("#t_fichas tbody").html(tr);
    //$("#txt_pag").html('');
    var data={ficha:v};
    Rpagina.ValidarV(data);
}

MostrarAjax=function(t){
    if( t=="personas_equipos" ){
        if( columnDefsP.length>0 ){
            dataTableG.CargarDatos(t,'grupop','cargarpe',columnDefsP);
        }
        else{
            alert('Faltas datos');
        }
    }
}

DetalleEntrega=function(btn,id){
    var tr = btn.parentNode.parentNode;
    var trs = tr.parentNode.children;
    for(var i =0;i<trs.length;i++)
        $(trs[i]).removeAttr("style");
    tr.style.backgroundColor = "#9CD9DE";

    $(".oculta").css("display","");
    $(".oculta2").css("display","none");

    var texto= '<h2><b>Equipo:</b> '+$(tr).find("td:eq(4)").text()+' <b>Persona:</b> '+$(tr).find("td:eq(0)").text()+' '+$(tr).find("td:eq(1)").text()+' '+$(tr).find("td:eq(2)").text();
    /*texto+=' <b>| Cargo:</b> '+$(tr).find("td:eq(5)").text();
    texto+=' <b>| Equipo:</b> '+$(tr).find("td:eq(7)").text()*/
    texto+='</h2>';
    $("#t_fichas span").html(texto);
    IdEscalafonG=id;
    $("#form_personas_equipos").hide("slow");
    $("#form_firmas").show("slow");
    $("#txt_nro_ficha").val('');
    var n1 = prompt("Ingrese nro de Página");
    var data={p:n1};
    $("#txt_pag").html(n1);
    $("#txt_pag_id").val(n1);
    if( n1 ){
        Rpagina.ValidarPagina(data,ValidarPaginaJS);
    }
    else{
        Cancelar();
    }
}

ValidarPaginaJS=function(obj){
    if(obj.rst==1){
        msjG.mensaje('success',obj.msj,5000);
    }
    else{
        msjG.mensaje('warning',obj.msj,5000);
        Cancelar();
    }
}

CargarEntregas=function(){
    var data={ id:IdEscalafonG };
    ValidacionFirma.CargarEntregas(data,CargarEntregasHTML);
}

CargarEntregasHTML=function(datos){
    var html='';
    $('#t_fichas').dataTable().fnDestroy();
    $.each(datos,function(index,data){
        html+=  "<tr>"+
                    "<td>"+data.orden+"</td>"+
                    "<td><input type='text' disabled class='fecha form-control' name='txt_fecha_entrega[]' value='"+data.fecha_entrega+"'></td>"+
                    "<td><input type='text' disabled class='form-control' name='txt_desde[]' value='"+data.desde+"'></td>"+
                    "<td><input type='text' disabled class='form-control' name='txt_hasta[]' value='"+data.hasta+"'></td>"+
                    "<td><input disabled type='text' class='form-control' value='"+data.total+"'></td>"+
                    "<td>"+
                        "<a class='btn btn-primary' onclick='DetalleRecepcion(this,"+data.id+");'><i class='fa fa-lg fa-edit'></i></a>"+
                    "</td>"+
                "</tr>";
    });

    $("#t_fichas>tbody").html(html); 
    $("#t_fichas").dataTable();
    $(".fecha").daterangepicker(
        {
            format: 'YYYY-MM-DD',
            singleDatePicker: true,
            showDropdowns: true
        }
    );
}

ValidarTotal=function(){
    var r=true;
    var total=0;
    var buena=0;

    $("#t_fichas_recepcionadas tbody tr td").removeClass("has-error");
    $("#t_fichas_recepcionadas tbody tr").removeClass("danger");
    $("#t_fichas_recepcionadas tbody tr").each( function( index ){
        
    });
}

Guardar=function(){
    var rs=ValidarFichas();
    var vacios=rs.split("|")[0]*1;
    var incompletos=rs.split("|")[1]*1;
    var validacion=rs.split("|")[2]*1;

    if( validacion==0 ){
        if( $("#txt_nro_ficha").val()!='' ){
            if( vacios>0 || incompletos>0 ){
                if(vacios>0 && incompletos>0){
                    if( confirm("Se encontraron:\n "+vacios+" registro(s) vacio(s)\n "+incompletos+" registro(s) incompleto(s)\n Esta todo ok?") ){
                        GuardarV();
                    }
                }
                else if(vacios>0){
                    if( confirm("Se encontraron:\n "+vacios+" registro(s) vacio(s)\n Esta todo ok?") ){
                        GuardarV();
                    }
                }
                else if(incompletos>0){
                    if( confirm("Se encontraron:\n "+incompletos+" registro(s) incompleto(s)\n Esta todo ok?") ){
                        GuardarV();
                    }
                }
            }
            else{
                GuardarV();
            }
        }
        else{
            alert("Ingrese Nro Ficha a Validar");
        }
    }
}

GuardarV=function(){
    $("#form_firmas #txt_escalafon_id").remove();
    $("#form_firmas").append("<input type='hidden' id='txt_escalafon_id' name='txt_escalafon_id' value='"+IdEscalafonG+"'>");
    var data=$("#form_firmas").serialize().split("txt_").join("").split("slct_").join("");
    Rpagina.GuardarFirmas(data);
}

Cancelar=function(){
    $("#t_fichas tbody").html("");
    $("#txt_nro_ficha").val("");
    $("#form_personas_equipos").show("slow");
    $("#form_firmas").hide("slow");
}

ValidarFichas=function(){
    var vacio=0;
    var incompleto=0;
    var validacion=0;
    $("#t_fichas tbody tr").each(function(index,value){
        if( validacion==0 && $.trim( $(this).find("input:eq(0)").val() )!='' && $(this).find("input:eq(0)").val().length<8 ){
            validacion++;
            alert("El casillero del dni debe contener 8 caracteres o estar vacio");
            $(this).find("input:eq(0)").focus();
        }

        if( $.trim( $(this).find("input:eq(0)").val() )=='' && $.trim( $(this).find("input:eq(1)").val() )=='' && 
            $.trim( $(this).find("input:eq(2)").val() )=='' && $.trim( $(this).find("input:eq(3)").val() )==''
        )
        {
            vacio++;
        }
        else if( $.trim( $(this).find("input:eq(0)").val() )!='' && $.trim( $(this).find("input:eq(1)").val() )!='' && 
            $.trim( $(this).find("input:eq(2)").val() )!='' && $.trim( $(this).find("input:eq(3)").val() )!=''
        )
        {}
        else{
            incompleto++;
        }
    });
    return vacio+"|"+incompleto+"|"+validacion;
}

</script>
