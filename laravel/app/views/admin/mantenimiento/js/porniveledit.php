<script type="text/javascript">
$(document).ready(function() {
    Mostrar();
});

AutoCheck=function(id){
    $("#tr_"+id+" input[type='checkbox']").attr("checked","true");
}

Mostrar=function(){
    Accion.mostrarEdit(HTMLreporte);
}

Guardar=function(){
    var datos=$("#formEdit").serialize().split("txt_").join("").split("slct_").join("");
    Accion.Edit(datos,Mostrar);
}

HTMLreporte=function(obj){
    $(".reportes").show();
    $("#tb_reporte").html(obj.datos);
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
