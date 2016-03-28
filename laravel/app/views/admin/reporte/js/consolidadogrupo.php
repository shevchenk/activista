<script type="text/javascript">
$(document).ready(function() {
    $('#fecha').daterangepicker({
        format: 'YYYY-MM-DD',
        singleDatePicker: false
    });

    $("#t_reporte").dataTable();

    var data = {estado:1};
    var ids = [];
    slctGlobal.listarSlctFuncion('grupop','listar','slct_nivel','simple',ids,data);
    

    $("#generar").click(function (){
        var nivel=$("#slct_nivel").val();
        if ( nivel!=="") {
                data = {nivel_id:nivel};
               Accion.mostrar(data,HTMLreporte);
        } else if(nivel==="") {
            alert("Seleccione Grupo");
        } 
    });
});

HTMLreporte=function(obj){
    var html="";
    $('#t_reporte').dataTable().fnDestroy();

    $("#th_reporte,#tf_reporte").html(obj.cabecera);
    $("#tb_reporte").html(obj.datos);
    $("#t_reporte").dataTable(
        {
            "order": [[ obj.nro, "desc" ]],
        }
    ); 
    
};
</script>
