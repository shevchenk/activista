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
$(document).ready(function() {
    $("[data-toggle='offcanvas']").click();
    var data = {estado:1};
    var ids = [];

    var idG={ paterno       :'onBlur|Paterno|#DCE6F1',
              materno       :'onBlur|Materno|#DCE6F1',
              nombres       :'onBlur|Nombres|#DCE6F1',
              dni           :'onBlur|DNI|#DCE6F1',
              celular       :'onBlur|Celular|#DCE6F1',
              cargo         :'onBlur|Cargo|#DCE6F1',
              fecha_inicio  :'onChange|Fecha Inicio|#DCE6F1',
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
    MostrarAjax('personas_equipos');

    $("#txt_fecha_inicio").daterangepicker(
        {
            format: 'YYYY-MM-DD',
            singleDatePicker: true,
            showDropdowns: true
        }
    );
    $(".oculta,.oculta2").css('display','none');
});

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

    var texto= '<b>Persona:</b> '+$(tr).find("td:eq(0)").text()+' '+$(tr).find("td:eq(1)").text()+' '+$(tr).find("td:eq(2)").text();
    texto+=' <b>| Cargo:</b> '+$(tr).find("td:eq(5)").text();
    texto+=' <b>| Equipo:</b> '+$(tr).find("td:eq(7)").text();
    $("#t_fichas small").html(texto);
    
    IdEscalafonG=id;
    CargarEntregas();
}

DetalleRecepcion=function(btn,id){
    var tr = btn.parentNode.parentNode;
    var trs = tr.parentNode.children;
    for(var i =0;i<trs.length;i++)
        $(trs[i]).removeAttr("style");
    tr.style.backgroundColor = "#9CD9DE";

    $(".oculta2").css("display","");

    var texto= '<b>Orden:</b> '+$(tr).find("td:eq(0)").text()+' '+$(tr).find("td:eq(1)").text()+' '+$(tr).find("td:eq(2)").text();
    texto+=' <b>| Desde:</b> '+$(tr).find("td:eq(2) input").val();
    texto+=' <b>| Hasta:</b> '+$(tr).find("td:eq(3) input").val();
    texto+=' <b>| Total:</b> '+$(tr).find("td:eq(4) input").val();

    DesdeEntregadoG=$(tr).find("td:eq(2) input").val();
    HastaEntregadoG=$(tr).find("td:eq(3) input").val();
    TotalEntregadoG=$(tr).find("td:eq(4) input").val();
    $("#t_fichas_recepcionadas small").html(texto);
    
    IdEscalafonFichaG=id;
    CargarRecepcion();
}

CargarEntregas=function(){
    var data={ id:IdEscalafonG };
    RecepcionFirma.CargarEntregas(data,CargarEntregasHTML);
}

CargarRecepcion=function(){
    var data={ id:IdEscalafonFichaG };
    RecepcionFirma.CargarRecepcion(data,CargarRecepcionHTML);
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

CargarRecepcionHTML=function(datos){
    var html='';
    OrdenG=0;
    $('#t_fichas_recepcionadas').dataTable().fnDestroy();
    $.each(datos,function(index,data){
        html+=  "<tr>"+
                    "<td>"+data.orden+"</td>"+
                    "<td><input type='text' class='fecha form-control' name='txt_fecha_recepcion[]' value='"+data.fecha_recepcion+"'></td>"+
                    "<td><input type='text' class='form-control' name='txt_desde[]' onBlur='ValidaMenorMayorRecepcionada();' onKeyUp='CalTotRecepcionada(this);' onKeyPress='return msjG.validaNumeros(event);' value='"+data.desde+"'></td>"+
                    "<td><input type='text' class='form-control' name='txt_hasta[]' onBlur='ValidaMenorMayorRecepcionada();' onKeyUp='CalTotRecepcionada(this);' onKeyPress='return msjG.validaNumeros(event);' value='"+data.hasta+"'></td>"+
                    "<td><input disabled type='text' class='form-control' value='"+data.total+"'></td>"+
                    "<td>"+
                        "<a class='btn btn-danger' onclick='RemoveTrFichaRecepcionada(this);'><i class='fa fa-lg fa-minus'></i></a>"+
                        "<input type='hidden' name='ids[]' value='"+data.id+"'>"+
                    "</td>"+
                "</tr>";
        OrdenG=data.orden;
    });

    $("#t_fichas_recepcionadas>tbody").html(html); 
    $("#t_fichas_recepcionadas").dataTable();
    $(".fecha").daterangepicker(
        {
            format: 'YYYY-MM-DD',
            singleDatePicker: true,
            showDropdowns: true
        }
    );
    ValidaTotalRF();
}

AddTrFichaRecepcionada=function(){
    OrdenG++;
    var html="";
    html+='<tr>';
        html+='<td>'+OrdenG+'</td>';
        html+='<td><input type="text" class="fecha form-control" name="txt_fecha_recepcion[]"></td>';
        html+='<td><input type="text" class="form-control" onKeyUp="CalTotRecepcionada(this);" onBlur="ValidaMenorMayorRecepcionada();" onKeyPress="return msjG.validaNumeros(event);" name="txt_desde[]"></td>';
        html+='<td><input type="text" class="form-control" onKeyUp="CalTotRecepcionada(this);" onBlur="ValidaMenorMayorRecepcionada();" onKeyPress="return msjG.validaNumeros(event);" name="txt_hasta[]"></td>';
        html+='<td><input disabled type="text" class="form-control"></td>';
        html+='<td>'+
                    '<a class="btn btn-danger" onclick="RemoveTrFichaRecepcionada(this);"><i class="fa fa-lg fa-minus"></i></a>'+
                    '<input type="hidden" name="ids[]" value="" >'+
              '</td>';
    html+='</tr>';

    $('#t_fichas_recepcionadas').dataTable().fnDestroy();
    $("#t_fichas_recepcionadas>tbody").append(html); 
    $("#t_fichas_recepcionadas").dataTable();
    $(".fecha").daterangepicker(
        {
            format: 'YYYY-MM-DD',
            singleDatePicker: true,
            showDropdowns: true
        }
    );
}

RemoveTrFichaRecepcionada=function(btn){
    var tr = btn.parentNode.parentNode;
    if( confirm('Esta apunto de eliminar el registro con Nro Recepción:'+$(tr).find("td:eq(0)").text()+', confirme para continuar') ){
        $('#t_fichas_recepcionadas').dataTable().fnDestroy();
        tr.remove();
        OrdenG=0;
        $("#t_fichas_recepcionadas>tbody>tr").each( function( index ){
            $(this).find("td:eq(0)").html( (index+1) );
            OrdenG=index*1+1;
        });
        $("#t_fichas_recepcionadas").dataTable();
        ValidaTotalRF();
    }
}

CalTotRecepcionada=function(btn){
    var tr = btn.parentNode.parentNode;
    var desde=$(tr).find("td:eq(2) input").val();
    var hasta=$(tr).find("td:eq(3) input").val();
    var total= ( (hasta*1-desde*1)+1 );

    $(tr).find("td:eq(4) input").val(total);
    ValidaTotalRF();
}

ValidaTotalRF=function(){
    var t=0; // Calcula el total acumulado
    var r=true;
    var desde=0;
    var hasta=0; 

    $("#t_fichas_recepcionadas tbody tr td").removeClass("has-error");
    $("#t_fichas_recepcionadas tbody tr").each( function( index ){
        if( $.trim( $(this).find("td:eq(4) input").val() )!='' ){
            t+=$(this).find("td:eq(4) input").val()*1;
            desde=$.trim($(this).find("input:eq(1)").val());
            hasta=$.trim($(this).find("input:eq(2)").val());
                $(this).removeClass("danger");
            if(desde!='' && hasta!=''){
                if( r==true && desde*1>hasta*1 ){
                    r=false;
                    $(this).find("td:eq(2)").addClass("has-error");
                    $(this).addClass("danger");
                }
            }

            if(desde!=''){
                if( DesdeEntregadoG*1>desde*1 || HastaEntregadoG*1<desde){
                    $(this).find("td:eq(2)").addClass("has-error");
                    $(this).addClass("danger");
                }
            }

            if(hasta!=''){
                if( DesdeEntregadoG*1>hasta*1 || HastaEntregadoG*1<hasta){
                    $(this).find("td:eq(3)").addClass("has-error");
                    $(this).addClass("danger");
                }
            }
        }
    });
    $("#txt_tr_f").val(t);
    $("#txt_tf_f").val(TotalEntregadoG-t);
}

ValidaMenorMayorRecepcionada=function(){
    var r=true; var r2=true;
    var desde=0;
    var hasta=0;
    $("#t_fichas_recepcionadas tbody tr").each( function( index ){
        desde=$.trim($(this).find("input:eq(1)").val());
        hasta=$.trim($(this).find("input:eq(2)").val());
        if(desde!='' && hasta!=''){
            if( r==true && desde*1>hasta*1 ){
                r=false;
            }
        }

        if(desde!=''){
            if( DesdeEntregadoG*1>desde*1 || HastaEntregadoG*1<desde){
                r2=false;
            }
        }

        if(hasta!=''){
            if( DesdeEntregadoG*1>hasta*1 || HastaEntregadoG*1<hasta){
                r2=false;
            }
        }
    });

    if( r==false && r2==false ){
        alert('La ficha de inicio no puede ser mayor a la ficha final;\n'+
              'Nro Inválido, Solo se puede ingresar un Nro entre el '+DesdeEntregadoG+' y '+HastaEntregadoG);
    }
    else if(r2==false){
        alert('Nro Inválido, Solo se puede ingresar un Nro entre el '+DesdeEntregadoG+' y '+HastaEntregadoG);
    }
    else if(r==false){
        alert('La ficha de inicio no puede ser mayor a la ficha final');
    }
}

Guardar=function(){
    if( ValidarFichas() ){
        $("#form_escalafon_fichas_recepcionadas input[name='escalafon_ficha_id']").remove();
        $("#form_escalafon_fichas_recepcionadas").append('<input type="hidden" name="escalafon_ficha_id" value="'+IdEscalafonFichaG+'">');
        var data=$("#form_escalafon_fichas_recepcionadas").serialize().split("txt_").join("").split("slct_").join("");
        RecepcionFirma.GuardarFichasRecepcion(data,CargarRecepcion);
    }
}

ValidarFichas=function(){
    var r=true;
    if( $("#t_fichas_recepcionadas tbody tr td.has-error").length>0 ){
        alert('Verifique los casilleros con alerta(Borde Rojo)');
        r=false;
    }
    else{
        if( $("#t_fichas_recepcionadas>tbody>tr>td>input").length>0 ){
            $("#t_fichas_recepcionadas>tbody>tr").each( function( index ){
                if( r==true && $.trim($(this).find("input:eq(0)").val())=='' ){
                    alert('Ingrese Fecha de Recepción de la Posición:'+(index+1));
                    $(this).find("input:eq(0)").focus();
                    r=false;
                }
                else if( r==true && $.trim($(this).find("input:eq(1)").val())=='' ){
                    alert('Ingrese El inicio de la ficha de la Posición :'+(index+1));
                    $(this).find("input:eq(1)").focus();
                    r=false;
                }
                else if( r==true && $.trim($(this).find("input:eq(2)").val())=='' ){
                    alert('Ingrese El fin de la ficha de la Posición:'+(index+1));
                    $(this).find("input:eq(2)").focus();
                    r=false;
                }
            });
        }
    }

    if( r==true && $("#txt_tf_f").val()*1<0 ){
        alert("El total de fichas faltantes no puede ser negativo, verifique y actualice sus fichas recepcionadas ");
        r=false;
    }

    return r;
}

</script>
