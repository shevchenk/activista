<script type="text/javascript">
$(document).ready(function() {
    $('#fecha').daterangepicker({
        format: 'YYYY-MM-DD',
        singleDatePicker: false
    });

    $("#t_reporte").dataTable();

    var data = {estado:1};
    var ids = [];
    slctGlobal.listarSlctFuncion('cargo','nivel','slct_nivel','multiple',ids,data);
    slctGlobalHtml('slct_consolidado','simple');
    

    $("#generar").click(function (){
        var nivel=$("#slct_nivel").val();
        var consolidado=$("#slct_consolidado").val();
        if ( nivel!=="") {
                data = {nivel_id:nivel,consolidado:consolidado};
               Accion.mostrar(data,HTMLreporte);
        } else if(nivel==="") {
            alert("Seleccione Nivel de Red Social");
        } 
    });
});

ActualizaEstado=function(id){
    var data={id:id}
    Accion.ActualizaEstado(data,CargarDenuevo);
}

CargarDenuevo=function(){
    var nivel=$("#slct_nivel").val();
    var consolidado=$("#slct_consolidado").val();
    data = {nivel_id:nivel,consolidado:consolidado};
    Accion.mostrar(data,HTMLreporte);
}

HTMLreporte=function(obj){
    var html="";
    $('#t_reporte').dataTable().fnDestroy();
    $("#th_reporte,#tf_reporte").html(obj.cabecera);
    $("#tb_reporte").html(obj.datos);
    $("#t_reporte").dataTable(); 
    
};
</script>
