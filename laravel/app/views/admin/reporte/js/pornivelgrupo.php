<script type="text/javascript">
$(document).ready(function() {
    $('#fecha').daterangepicker({
        format: 'YYYY-MM-DD',
        singleDatePicker: false
    });
    var data = {estado:1};
    var ids = [];
    slctGlobal.listarSlctFuncion('grupop','listar','slct_grupos','simple',ids,data);

    $("#generar").click(function (){
        var grupo=$("#slct_grupos").val();

        if ( grupo!=="") {
                data = { grupo:grupo };
               Accion.mostrar(data,HTMLreporte);
        } else if(grupo==="") {
            alert("Seleccione Equipo");
        }
    });
});

HTMLreporte=function(obj){
    $(".reportes").show();
    var html="";
    $('#t_reporte').dataTable().fnDestroy();

    $("#tb_reporte").html(obj.datos);
    $("#t_reporte").dataTable(); 
};
</script>
