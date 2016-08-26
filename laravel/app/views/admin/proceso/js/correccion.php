<script type="text/javascript">
$(document).ready(function() {

});

LimpiaText=function(id){
    $("#"+id).val('');
}

Listar=function(){
    var t="";
    var v="";
    v= $("#txt_ficha").val();
    t= "f";
    if( $("#txt_pagina").val()!='' ){
        v=$("#txt_pagina").val();
        t="p";
    }

    var data={ tipo:t,valor:t };
    Accion.Validar(data,ValidarHTML);
}

ValidarHTML=function(obj){
    var html='';
    $('#t_fichas').dataTable().fnDestroy();
    $.each(datos,function(index,data){
        html+=  "<tr>"+
                    "<td>"+data.orden+"</td>"+
                    "<td><input type='text' disabled class='fecha form-control' name='txt_fecha_entrega[]' value='"+data.fecha_entrega+"'></td>"+
                    "<td><input type='text' disabled class='form-control' name='txt_desde[]' value='"+data.desde+"'></td>"+
                    "<td><input type='text' disabled class='form-control' name='txt_hasta[]' value='"+data.hasta+"'></td>"+
                    "<td><input disabled type='text' class='form-control' value='"+data.total+"'></td>"+
                    "<td>"+
                        "<a class='btn btn-primary' onclick='DetalleRecepcion(this,"+data.id+");'><i class='fa fa-lg fa-edit'></i></a>"+
                    "</td>"+
                "</tr>";
    });

    $("#t_fichas>tbody").html(html); 
    $("#t_fichas").dataTable();
    $(".fecha").daterangepicker(
        {
            format: 'YYYY-MM-DD',
            singleDatePicker: true,
            showDropdowns: true
        }
    );
}

</script>
