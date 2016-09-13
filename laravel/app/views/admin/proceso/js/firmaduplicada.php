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
    slctGlobal.listarSlct('grupop','slct_equipo','multiple');
});

Listar=function(){
    var operador="";
    var fecha="";
    operador= $("#slct_operador").val();
    fecha=$("#txt_fecha").val();
    equipo= $("#slct_equipo").val();
    pini= $("#txt_pinicio").val();
    pfin= $("#txt_pfinal").val();
    
    var data={ operador:operador,fecha:fecha,equipo:equipo,pini:pini,pfin:pfin };
    Accion.Duplicado(data,DuplicadoHTML);
}

DuplicadoHTML=function(obj){
    var html='';
    $('#t_personas').dataTable().fnDestroy();
    $.each(obj.data,function(index,data){
        html+='<tr>';
        html+='<td>'+data.dni+'</td>';
        html+='<td>'+data.adherente+'</td>';
        html+='<td>'+data.equipo+'</td>';
        html+='<td>'+data.operador+'</td>';
        html+='<td>'+data.fecha+'</td>';
        html+='<td>'+data.ficha+'</td>';
        html+='<td>'+data.pagina+'</td>';
        html+='<td>'+data.fila+'</td>';
        html+='</tr>';
    });

    $("#t_personas>tbody").html(html); 
    $("#t_personas").dataTable();
}

</script>
