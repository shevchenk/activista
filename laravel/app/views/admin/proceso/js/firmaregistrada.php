<script type="text/javascript">
$(document).ready(function() {
$("[data-toggle='offcanvas']").click();
$("#t_personas").dataTable();
    $('.fecha').daterangepicker({
        format: 'YYYY-MM-DD',
        singleDatePicker: false,
        showDropdowns: true
    });
    slctGlobal.listarSlct('digitador','slct_digitador','multiple');
    slctGlobal.listarSlct('grupop','slct_equipo','multiple');
});

Listar=function(){
    var digitador="";
    var fecha="";
    digitador= $("#slct_digitador").val();
    fecha=$("#txt_fecha").val();
    equipo= $("#slct_equipo").val();
    pini= $("#txt_pinicio").val();
    pfin= $("#txt_pfinal").val();
    
    var data={ digitador:digitador,fecha:fecha,equipo:equipo,pini:pini,pfin:pfin };
    Accion.Registrados(data,RegistradosHTML);
}

RegistradosHTML=function(obj){
    var html=''; var total=0; var pagar=0;
    $('#t_personas').dataTable().fnDestroy();
    $.each(obj.data,function(index,data){
        html+='<tr>';
        html+='<td>'+data.digitador+'</td>';
        html+='<td>'+data.fecha+'</td>';
        html+='<td>'+data.paginas+'</td>';
        html+='</tr>';
    });

    $("#t_personas>tbody").html(html); 
    $("#t_personas").dataTable();
}

</script>
