<script type="text/javascript">

$(document).ready(function() {
    //$("[data-toggle='offcanvas']").click();
    //$(".ocultar").css("display","none");
    var tr="";
    for (var i = 1; i < 21; i++) {
        tr="<tr>";
        tr+="<td>"+i+"</td>";
        tr+="<td><input type=text class='form-control limpia' id='hoja"+i+"' name='hoja"+i+"' onKeyPress='return msjG.validaNumeros(event);'></td>";
        tr+="<td><input type=text class='form-control limpia' id='ficha"+i+"' name='ficha"+i+"' onKeyPress='return msjG.validaNumeros(event);'></td>";
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

Resultado=function(obj){
    var mensajea=obj.mensajea.split(",");
    var mensajeb=obj.mensajeb.split(",");
    
    for (var i = 1; i < mensajea.lenght; i++) {
        
    }
}

Limpiar=function(){
    $(".limpia").val('');
    msjG.mensaje('warning',"Se limpiaron los datos",4000);
}

Validar=function(){
    var r=true;
    var a= "";
    var b= "";
    var lleno=0;

    for (var i = 1; i < 21; i++) {
        a= $.trim( $("#hoja"+i).val() );
        b= $.trim( $("#ficha"+i).val() );
        if( a=='' && b=='' ){
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
        else if(a!='' && b!=''){
            lleno++;
        }
    }

    if(r==true && lleno==0){
        r=false;
        alert('Almenos realice 1 registro');
    }
    return r;
}
</script>
