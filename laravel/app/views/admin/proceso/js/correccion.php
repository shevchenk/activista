<script type="text/javascript">
$(document).ready(function() {
$("[data-toggle='offcanvas']").click();
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
    var tconteo='';
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

        tconteo='';
        tr='';
        if( data.valida==1 && data.tconteo==0 ){
            tr='success';
        }
        else if( data.valida==1 ){
            tr='danger';
        }

        if( data.valida==1 && data.tconteo==1 ){
            tconteo='Aprox. Por DNI';
        }
        else if( data.valida==1 && data.tconteo==2 ){
            tconteo='Aprox. Por Nombres';
        }
        else if( data.valida==1 && data.tconteo==3 ){
            tconteo='No Existe en Reniec';
        }

        html+=  "<tr class='"+tr+"'>"+
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
        html+=      "<td>"+tconteo+"</td>"+
                    "<td>"+data.rst.split("|").join("<br>")+"</td>"+
                    "<td>"+conteo+"</td>"+
                    "<td>"+analizado+"</td>"+
                "</tr>";

        html+=  "<tr>"+
                    "<td>"+data.ficha+"</td>"+
                    "<td>&nbsp;</td>";
        if( data.tconteo==1 ){
        html+=      "<td>&nbsp;</td>"+
                    "<td>"+data.rpaterno+"</td>"+
                    "<td>"+data.rmaterno+"</td>"+
                    "<td>"+data.rnombres+"</td>";
        }
        else if( data.tconteo==2 ){
        html+=      "<td>"+data.rdni+"</td>"+
                    "<td>"+data.rpaterno+"</td>"+
                    "<td>"+data.rmaterno+"</td>"+
                    "<td>"+data.rnombres+"</td>";
        }
        else{
        html+=      "<td>&nbsp;</td>"+
                    "<td>&nbsp;</td>"+
                    "<td>&nbsp;</td>"+
                    "<td>&nbsp;</td>";
        }
        html+=      "<td>&nbsp;</td>"+
                    "<td>&nbsp;</td>"+
                    "<td>&nbsp;</td>"+
                    "<td>&nbsp;</td>"+
                "</tr>";
    });

    $("#t_personas>tbody").html(html); 
    $("#t_personas").dataTable();
}

</script>
