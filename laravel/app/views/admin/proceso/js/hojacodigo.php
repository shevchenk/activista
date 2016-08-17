<script type="text/javascript">

$(document).ready(function() {
    //$("[data-toggle='offcanvas']").click();
    //$(".ocultar").css("display","none");
    var tr="";
    for (var i = 1; i < 21; i++) {
        tr="<tr>";
        tr+="<td>"+i+"</td>";
        tr+="<td><input type=text class='form-control' id='hoja"+i+"' name='hoja"+i+"' onKeyPress='return msjG.validaNumeros(event);'></td>";
        tr+="<td><input type=text class='form-control' id='ficha"+i+"' name='ficha"+i+"' onKeyPress='return msjG.validaNumeros(event);'></td>";
        tr+="<td></td>";
        tr+="</tr>";
        $("#t_fichas tbody").append(tr);
    }
});

Guardar=function(){
    if( Validar()==true ){
    var data=$("#form_validacion_personas").serialize().split("txt_").join("").split("slct_").join("");
    Ajax.Guardar(data,Resultado);
    }
}

Resultado=function(){

}

Validar=function(){
    var r=true;
    var a= "";
    var b= "";
    var vacio=0;

    for (var i = 1; i < 21; i++) {
        a= $.trim( $("#hoja"+i).val() );
        b= $.trim( $("#ficha"+i).val() );
        if( a=='' && b=='' ){
            vacio++;
        }
        else if( a=='' || b=='' ){
            r=false;
            if( a=='' ){
                alert("Ingrese hoja");
                $("#hoja"+i).focus();
            }
            else{
                alert("Ingrese ficha");
                $("#ficha"+i).focus();
            }

        }
    }
    return r;
}
</script>
