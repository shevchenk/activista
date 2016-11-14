<script type="text/javascript">
$(document).ready(function() {
$("[data-toggle='offcanvas']").click();
$("#t_personas,#t_personasg").dataTable();
    $('.fecha').daterangepicker({
        format: 'YYYY-MM-DD',
        singleDatePicker: false,
        showDropdowns: true
    });
    slctGlobal.listarSlct('digitador','slct_digitador','multiple');
    slctGlobal.listarSlct('grupop','slct_equipo,#slct_equipog','multiple');
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
        html+='<td>'+data.equipo+'</td>';
        html+='<td>'+data.digitador+'</td>';
        html+='<td>'+data.fecha+'</td>';
        html+='<td>'+data.paginas+'</td>';
        html+='<td>'+data.firmas+'</td>';
        html+='</tr>';
    });

    $("#t_personas>tbody").html(html); 
    $("#t_personas").dataTable();
}

ListarG=function(){
    var digitador="";
    var fecha="";
    fecha=$("#txt_fechag").val();
    equipo= $("#slct_equipog").val();
    /*pini= $("#txt_pinicio").val();
    pfin= $("#txt_pfinal").val();*/
    
    var data={ fecha:fecha,equipo:equipo };
    Accion.RegistradosG(data,RegistradosHTMLG);
}

RegistradosHTMLG=function(obj){
    var html=''; var total=0; var pagar=0;
    $('#t_personasg').dataTable().fnDestroy();
    $.each(obj.data,function(index,data){
        html+='<tr>';
        html+='<td>'+data.equipo+'</td>';
        html+='<td>'+data.digitador+'</td>';
        html+='<td>'+data.fecha+'</td>';
        html+='<td>'+data.paginas+'</td>';
        html+='<td>'+data.firmas+'</td>';
        html+='</tr>';
    });

    $("#t_personasg>tbody").html(html); 
    $("#t_personasg").dataTable();
}

</script>
