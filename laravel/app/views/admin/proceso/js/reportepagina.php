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
    $.each(datos.pentot,function(index,data){
        html+=  "<tr>"+
                    "<td>"+
                        data.id+
                    "</td>"+
                "</tr>";
    });
    $("#table tbody").html(html);

    html='';
    $("#table2 tbody").html(html);
    $.each(datos.pen200,function(index,data){
        if( data.fin!==data.maximo ) {
            data.fin=data.maximo;
        }
        html+=  "<tr>"+
                    "<td>"+
                        data.inicio+
                    "</td>"+
                    "<td>"+
                        data.fin+
                    "</td>"+
                    "<td>"+
                        data.vacios+
                    "</td>"+
                "</tr>";
    });
    $("#table2 tbody").html(html);
}
</script>
