<script type="text/javascript">
$(document).ready(function() {
$("[data-toggle='offcanvas']").click();
$("#t_personas").dataTable();
});

Guardar=function(){
    var data=$("#form_reniec_validacion").serialize().split("txt_").join("").split("slct_").join("");
    Accion.Actualizar(data,Listar);
}

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
            conteo='Válido';
        }
        else if( data.conteo==2 ){
            conteo='Inválido';
        }
        else if( data.conteo==3 ){
            conteo='Blanco';
        }
        else if( data.conteo==4 ){
            conteo='Subsanado';
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
        else if( data.valida==1 && data.tconteo==4 ){
            tconteo='Firma Existente';
        }

        chk='';
        if( data.valida==1 ){
            chk='<select name="actualiza[]"><option value="0" selected>No</option><option value="1|'+data.id+'">Si</option></select>';
            if( data.rst!='' || data.conteo==1 ){
                chk='<select name="actualiza[]"><option value="0" selected>No</option></select>';
            }
        }

        html+=  "<tr class='"+tr+"'>"+
                    "<td>"+data.ficha+"</td>"+
                    "<td>"+data.fila+chk+"</td>";
        if( data.valida==0 ){
        html+=      "<td>"+data.dni+"</td>"+
                    "<td>"+data.paterno+"</td>"+
                    "<td>"+data.materno+"</td>"+
                    "<td>"+data.nombre+"</td>";
        }
        else{
        html+=      "<td><input type='text' class='form-control' name='txt_dni[]' value='"+data.dni+"'></td>"+
                    "<td><input type='text' class='form-control' name='txt_paterno[]' value='"+data.paterno+"'></td>"+
                    "<td><input type='text' class='form-control' name='txt_materno[]' value='"+data.materno+"'></td>"+
                    "<td><input type='text' class='form-control' name='txt_nombre[]' value='"+data.nombre+"'></td>";
        }
        html+=      "<td>"+tconteo+"</td>"+
                    "<td>"+data.rst.split("|").join("<br>")+"</td>"+
                    "<td>"+conteo+"</td>"+
                "</tr>";

        html+=  "<tr>"+
                    "<td>"+data.ficha+"</td>"+
                    "<td>&nbsp;</td>";
        if( data.tconteo==1 || data.tconteo==2 ){
        html+=      "<td>"+data.rdni.split("|").join("<br>")+"</td>"+
                    "<td>"+data.rpaterno.split("|").join("<br>")+"</td>"+
                    "<td>"+data.rmaterno.split("|").join("<br>")+"</td>"+
                    "<td>"+data.rnombres.split("|").join("<br>")+"</td>";
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
                "</tr>";
    });

    $("#t_personas>tbody").html(html); 
    $("#t_personas").dataTable();
}

</script>
