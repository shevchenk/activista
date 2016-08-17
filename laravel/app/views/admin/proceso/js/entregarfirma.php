<script type="text/javascript">
var cabeceraP=[];
var columnDefsP=[];
var targetsP=-1;
var OrdenG=0; // inicializa el orden
var IdEscalafonG=0; // Id Global del ecalafon
var BottonDblClick=true;
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
    $(".oculta").css('display','none');
});

BtnDblClick=function(){
    $("#t_personas_equipos>tbody>tr").attr("OnDblClick","BtnDbl(this)");
}

BtnDbl=function(t){
    $(t).find("a").click();
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

    var texto= '<b>Persona:</b> '+$(tr).find("td:eq(0)").text()+' '+$(tr).find("td:eq(1)").text()+' '+$(tr).find("td:eq(2)").text();
    texto+=' <b>| Cargo:</b> '+$(tr).find("td:eq(5)").text();
    texto+=' <b>| Equipo:</b> '+$(tr).find("td:eq(7)").text();
    $("#t_fichas small").html(texto);
    
    IdEscalafonG=id;
    CargarEntregas();
}

CargarEntregas=function(){
    var data={ id:IdEscalafonG };
    EntregaFirma.CargarEntregas(data,CargarEntregasHTML);
}

CargarEntregasHTML=function(datos){
    var html='';
    OrdenG=0;
    $('#t_fichas').dataTable().fnDestroy();
    $.each(datos,function(index,data){
        html+=  "<tr>"+
                    "<td>"+data.orden+"</td>"+
                    "<td><input type='text' class='fecha form-control' name='txt_fecha_entrega[]' value='"+data.fecha_entrega+"'></td>"+
                    "<td><input type='text' class='form-control' name='txt_desde[]' onBlur='ValidaMenorMayor();' onKeyUp='CalTot(this);' onKeyPress='return msjG.validaNumeros(event);' value='"+data.desde+"'></td>"+
                    "<td><input type='text' class='form-control' name='txt_hasta[]' onBlur='ValidaMenorMayor();' onKeyUp='CalTot(this);' onKeyPress='return msjG.validaNumeros(event);' value='"+data.hasta+"'></td>"+
                    "<td><input type='text' class='form-control' name='txt_desdeh[]' onBlur='ValidaMenorMayor();' onKeyUp='CalTot(this);' onKeyPress='return msjG.validaNumeros(event);' value='"+data.desde+"'></td>"+
                    "<td><input type='text' class='form-control' name='txt_hastah[]' onBlur='ValidaMenorMayor();' onKeyUp='CalTot(this);' onKeyPress='return msjG.validaNumeros(event);' value='"+data.hasta+"'></td>"+
                    "<td><input disabled type='text' class='form-control' value='"+data.total+"'></td>";
        if( data.validar==0 ){
        html+=      "<td>"+
                        "<a class='btn btn-danger' onclick='RemoveTrFicha(this);'><i class='fa fa-lg fa-minus'></i></a>"+
                        "<input type='hidden' name='ids[]' value='"+data.id+"'>"+
                    "</td>";
        }
        else{
        html+=      "<td>"+data.validar+" Recep.</td>";
        }
        html+=  "</tr>";
        OrdenG=data.orden;
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

AddTrFicha=function(){
    OrdenG++;
    var html="";
    html+='<tr>';
        html+='<td>'+OrdenG+'</td>';
        html+='<td><input type="text" class="fecha form-control" name="txt_fecha_entrega[]"></td>';
        html+='<td><input type="text" class="form-control" onKeyUp="CalTot(this);" onBlur="ValidaMenorMayor();" onKeyPress="return msjG.validaNumeros(event);" name="txt_desde[]"></td>';
        html+='<td><input type="text" class="form-control" onKeyUp="CalTot(this);" onBlur="ValidaMenorMayor();" onKeyPress="return msjG.validaNumeros(event);" name="txt_hasta[]"></td>';
        html+='<td><input type="text" class="form-control" onKeyUp="CalTot(this);" onBlur="ValidaMenorMayor();" onKeyPress="return msjG.validaNumeros(event);" name="txt_desdeh[]"></td>';
        html+='<td><input type="text" class="form-control" onKeyUp="CalTot(this);" onBlur="ValidaMenorMayor();" onKeyPress="return msjG.validaNumeros(event);" name="txt_hastah[]"></td>';
        html+='<td><input disabled type="text" class="form-control"></td>';
        html+='<td>'+
                    '<a class="btn btn-danger" onclick="RemoveTrFicha(this);"><i class="fa fa-lg fa-minus"></i></a>'+
                    '<input type="hidden" name="ids[]" value="" >'+
              '</td>';
    html+='</tr>';

    $('#t_fichas').dataTable().fnDestroy();
    $("#t_fichas>tbody").append(html); 
    $("#t_fichas").dataTable();
    $(".fecha").daterangepicker(
        {
            format: 'YYYY-MM-DD',
            singleDatePicker: true,
            showDropdowns: true
        }
    );
}

RemoveTrFicha=function(btn){
    var tr = btn.parentNode.parentNode;
    if( confirm('Esta apunto de eliminar el registro con Nro Entrega:'+$(tr).find("td:eq(0)").text()+', confirme para continuar') ){
        $('#t_fichas').dataTable().fnDestroy();
        
        tr.remove();
        OrdenG=0;
        $("#t_fichas>tbody>tr").each( function( index ){
            $(this).find("td:eq(0)").html( (index+1) );
            OrdenG=index*1+1;
        });
        $("#t_fichas").dataTable();
        ValidaT();
    }
}

CalTot=function(btn){
    var tr = btn.parentNode.parentNode;
    var desde=$(tr).find("td:eq(2) input").val();
    var hasta=$(tr).find("td:eq(3) input").val();
    var total= ( (hasta*1-desde*1)+1 );
    $(tr).find("td:eq(6) input").val(total);
    ValidaT();
}

ValidaT=function(){
    var r=true;
    var desde=0;
    var hasta=0;
    var total=0;
    var total2=0; 

    $("#t_fichas tbody tr td").removeClass("has-error");
    $("#t_fichas tbody tr").each( function( index ){
        if( $.trim( $(this).find("td:eq(6) input").val() )!='' ){
            desde=$.trim($(this).find("input:eq(1)").val());
            hasta=$.trim($(this).find("input:eq(2)").val());
            desdeh=$.trim($(this).find("input:eq(3)").val());
            hastah=$.trim($(this).find("input:eq(4)").val());
                $(this).removeClass("danger");
            if(desde!='' && hasta!=''){
                if( r==true && desde*1>hasta*1 ){
                    r=false;
                    $(this).find("td:eq(2)").addClass("has-error");
                    $(this).addClass("danger");
                }
            }

            if(desdeh!='' && hastah!=''){
                if( r==true && desdeh*1>hastah*1 ){
                    r=false;
                    $(this).find("td:eq(4)").addClass("has-error");
                    $(this).addClass("danger");
                }
            }

            if(desde!='' && hasta!='' && desdeh!='' && hastah!='' && r==true){
            total= ( (hasta*1-desde*1)+1 );
            total2= ( (hastah*1-desdeh*1)+1 );
                if(total!=total2){
                    r=false;
                    $(this).find("td:eq(4)").addClass("has-error");
                    $(this).addClass("danger");
                }
            }
        }
    });
}

ValidaMenorMayor=function(){
    var r=true;
    var desde=0;
    var hasta=0;
    var desdeh=0;
    var hastah=0;
    var total=0;
    var total2=0;
    var mensaje="";
    $("#t_fichas tbody tr").each( function( index ){
        desde=$.trim($(this).find("input:eq(1)").val());
        hasta=$.trim($(this).find("input:eq(2)").val());
        desdeh=$.trim($(this).find("input:eq(3)").val());
        hastah=$.trim($(this).find("input:eq(4)").val());

        if(desde!='' && hasta!=''){
            if( r==true && desde*1>hasta*1 ){
                r=false;
                mensaje="La ficha de inicio no puede ser mayor a la ficha final";
            }
        }

        if(desdeh!='' && hastah!=''){
            if( r==true && desdeh*1>hastah*1 ){
                r=false;
                mensaje="La hoja de inicio no puede ser mayor a la hoja final";
            }
        }

        if(desde!='' && hasta!='' && desdeh!='' && hastah!='' && r==true){
            total= ( (hasta*1-desde*1)+1 );
            total2= ( (hastah*1-desdeh*1)+1 );
            if(total!=total2){
                r=false;
                mensaje="El total de fichas("+total+") no es igual al total de hojas("+total2+") ";
            }
        }
    });

    if(r==false){
        alert(mensaje);
    }
}

Guardar=function(){
    if( ValidarFichas() ){
        $("#form_escalafon_fichas input[name='escalafon_id']").remove();
        $("#form_escalafon_fichas").append('<input type="hidden" name="escalafon_id" value="'+IdEscalafonG+'">');
        var data=$("#form_escalafon_fichas").serialize().split("txt_").join("").split("slct_").join("");
        EntregaFirma.GuardarFichas(data,CargarEntregas);
    }
}

ValidarFichas=function(){
    var r=true;
    if( $("#t_fichas tbody tr td.has-error").length>0 ){
        alert('Verifique los casilleros con alerta(Borde Rojo)');
        r=false;
    }
    else{
        if( $("#t_fichas>tbody>tr>td>input").length>0 ){
            $("#t_fichas>tbody>tr").each( function( index ){
                if( r==true && $.trim($(this).find("input:eq(0)").val())=='' ){
                    alert('Ingrese Fecha de Entrega de la Posición:'+(index+1));
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
                else if( r==true && $.trim($(this).find("input:eq(3)").val())=='' ){
                    alert('Ingrese El inicio de la hoja de la Posición:'+(index+1));
                    $(this).find("input:eq(3)").focus();
                    r=false;
                }
                else if( r==true && $.trim($(this).find("input:eq(4)").val())=='' ){
                    alert('Ingrese El fin de la hoja de la Posición:'+(index+1));
                    $(this).find("input:eq(4)").focus();
                    r=false;
                }
            });
        }
    }

    return r;
}

</script>
