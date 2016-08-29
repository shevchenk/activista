<script type="text/javascript">
$(document).ready(function() {
$("#t_personas").dataTable();
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

    var data={ tipo:t,valor:v };
    Accion.Validar(data,ValidarHTML);
}

ValidarHTML=function(obj){
    var html='';
    var analizado='';
    var conteo='';
    $('#t_personas').dataTable().fnDestroy();
    $.each(obj.data,function(index,data){
        $("#responsable").text(data.recolector);

        if( data.conteo==1 ){
            conteo='Validado';
        }
        else if( data.conteo==2 ){
            conteo='Inválido';
        }
        else if( data.conteo==3 ){
            conteo='Blanco';
        }

        html+=  "<tr>"+
                    "<td>"+data.ficha+"</td>"+
                    "<td>"+data.fila+"</td>";
        if( data.valida==0 ){
            analizado='Falta Validar';
        html+=      "<td>"+data.dni+"</td>"+
                    "<td>"+data.paterno+"</td>"+
                    "<td>"+data.materno+"</td>"+
                    "<td>"+data.nombre+"</td>";
        }
        else{
            analizado='Se Validó';
        html+=      "<td><input type='text' class='form-control' name='txt_dni[]' value='"+data.dni+"'></td>"+
                    "<td><input type='text' class='form-control' name='txt_paterno[]' value='"+data.paterno+"'></td>"+
                    "<td><input type='text' class='form-control' name='txt_materno[]' value='"+data.materno+"'></td>"+
                    "<td><input type='text' class='form-control' name='txt_nombre[]' value='"+data.nombre+"'></td>";
        }
        html+=      "<td>"+''+"</td>"+
                    "<td>"+data.rst.split("|").join("<br>")+"</td>"+
                    "<td>"+conteo+"</td>"+
                    "<td>"+analizado+"</td>"+
                "</tr>";
    });

    $("#t_personas>tbody").html(html); 
    $("#t_personas").dataTable();
}

</script>
