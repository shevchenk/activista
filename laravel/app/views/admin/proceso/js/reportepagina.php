<script type="text/javascript">
$(document).ready(function() {
   $("#valida").click(Cargar);
});

Cargar=function(){
    Paginas.PaginasPendientes(CargarHtml);
}

CargarHtml=function(datos){
    html='';
    $("#table tbody").html(html);
    $.each(datos,function(index,data){
        html+=  "<tr>"+
                    "<td>"+
                        data.id+
                    "</td>"+
                "</tr>";
    });
    $("#table tbody").html(html);
}
</script>
