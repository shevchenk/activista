<script type="text/javascript">
$(document).ready(function() {
$("[data-toggle='offcanvas']").click();
$("#t_personas").dataTable();
    $('.fecha').daterangepicker({
        format: 'YYYY-MM-DD',
        singleDatePicker: false,
        showDropdowns: true
    });
    slctGlobal.listarSlct('operador','slct_operador','multiple');
});

Guardar=function(){
    var data=$("#form_reniec_validacion").serialize().split("txt_").join("").split("slct_").join("");
    Accion.Actualizar(data,Listar);
}

LimpiaText=function(id){
    $("#"+id).val('');
}

Listar=function(){
    var operador="";
    var fecha="";
    operador= $("#slct_operador").val();
    fecha=$("#txt_fecha").val();
    
    var data={ operador:operador,fecha:fecha };
    Accion.Consolidado(data,ConsolidadoHTML);
}

ConsolidadoHTML=function(obj){
    var html=''; var total=0; var pagar=0;
    $('#t_personas').dataTable().fnDestroy();
    $.each(obj.data,function(index,data){
        html+='<tr>';
        html+='<td>'+data.operador+'</td>';
        html+='<td>'+data.fecha+'</td>';
        html+='<td>'+data.fichas+'</td>';
        html+='<td>'+data.blancos+'</td>';
        html+='<td>'+data.duplicado+'</td>';
        html+='<td>'+data.no_valido+'</td>';
        html+='<td>'+data.pago+'</td>';
        total+=data.pago*1;

        if( index+1==obj.data.length ){
            pagar=total*0.6;
            html+='<td>'+total+'</td>';
            html+='<td>'+Math.round(pagar * 100) / 100+'</td>';
            total=0;
        }
        else if( obj.data[index].id!=obj.data[(index+1)].id ){
            pagar=total*0.6;
            html+='<td>'+total+'</td>';
            html+='<td>'+Math.round(pagar * 100) / 100+'</td>';
            total=0;
        }
        else{
            html+='<td>&nbsp;</td>';
            html+='<td>&nbsp;</td>';
        }
        html+='</tr>';
    });

    $("#t_personas>tbody").html(html); 
    $("#t_personas").dataTable();
}

</script>
