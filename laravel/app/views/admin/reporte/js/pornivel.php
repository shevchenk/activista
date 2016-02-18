<script type="text/javascript">
$(document).ready(function() {
    $('#fecha').daterangepicker({
        format: 'YYYY-MM-DD',
        singleDatePicker: false
    });
    var data = {estado:1};
    var ids = [];
    slctGlobal.listarSlctFuncion('cargo','nivel','slct_nivel','simple',ids,data);
    slctGlobalHtml('slct_persona','simple');
    

    $("#generar").click(function (){
        var nivel=$("#slct_nivel").val();
        var persona= $("#slct_persona").val();

        if ( nivel!=="" && persona!=="") {
                data = {nivel:nivel, persona:persona};
               Accion.mostrar(data,HTMLreporte);
        } else if(nivel==="") {
            alert("Seleccione Nivel");
        } else if(persona===""){
            alert("Seleccione un Miembro del Nivel");
        }
    });
});

DetalleNivel=function(){
    var val = $("#slct_nivel").val();
    var data={estado:1, nivel_id:val};
    if(val==""){
        val=0;
    }

    $("#slct_persona").multiselect('destroy');
    slctGlobal.listarSlctFuncion('persona','nivel','slct_persona','simple',null,data);
}

HTMLreporte=function(obj){
    $(".reportes").show();
    var html="";
    $('#t_reporte').dataTable().fnDestroy();
    $('#t_reporte2').dataTable().fnDestroy();

    /*$.each(obj,function(index,data){
        html+="<tr>"+
            "<td>"+data.tramite+"</td>"+
            "<td>"+data.tipo_persona+"</td>"+
            "<td>"+data.persona+"</td>"+
            "<td>"+data.sumilla+"</td>"+
            "<td>"+data.estado+"</td>"+
            "<td>"+data.ultimo_paso_area+"</td>"+
            "<td>"+data.total_pasos+"</td>"+
            "<td>"+data.fecha_tramite+"</td>"+
            "<td>"+data.fecha_inicio+"</td>"+
            "<td>"+data.ok+"</td>"+
            "<td>"+data.errorr+"</td>"+
            "<td>"+data.corregido+"</td>"+
            '<td><a onClick="detalle('+data.id+',this)" class="btn btn-primary btn-sm" data-id="'+data.id+'" data-titulo="Editar"><i class="fa fa-search fa-lg"></i> </a></td>';
        html+="</tr>";
    });*/

    $("#tb_reporte").html(obj.datos);
    $("#t_reporte").dataTable(
        {
            "scrollCollapse": true,
            "paging":   false,
            "ordering": false,
            "scrollY":        "600px",
        }
    ); 

    html="";
    var totalnivel=0;
    var totalpagina=0;
    for(i=($("#slct_nivel").val()*1+1); i<obj.niveles.length; i++){
        totalnivel+=obj.niveles[i];
        totalpagina+=obj.paginas[i];
        html+="<tr style='background-color: "+obj.fondo[i]+";color: "+obj.texto[i]+";'>"+
            "<td>"+obj.cargos[i]+"</td>"+
            "<td>"+obj.niveles[i]+"</td>"+
            "<td>"+obj.paginas[i]+"</td>";
        html+="</tr>";
    }
        html+="<tr>"+
            "<td><b>Totales:</b></td>"+
            "<td>"+totalnivel+"</td>"+
            "<td>"+totalpagina+"</td>";
        html+="</tr>";

    $("#tb_reporte2").html(html);
    $("#t_reporte2").dataTable(
        {
            "order": [[ 0, "desc" ]],
        }
    ); 
    
};

detalle=function(ruta_id, boton){
    var tr = boton.parentNode.parentNode;
    var trs = tr.parentNode.children;
    for(var i =0;i<trs.length;i++)
        trs[i].style.backgroundColor="#f9f9f9";
    tr.style.backgroundColor = "#9CD9DE";
    var data={id:ruta_id};
    Accion.mostrar_detalle(data);
};
</script>
