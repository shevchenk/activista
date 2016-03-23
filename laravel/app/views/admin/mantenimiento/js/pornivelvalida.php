<script type="text/javascript">
$(document).ready(function() {
    $('#fecha').daterangepicker({
        format: 'YYYY-MM-DD',
        singleDatePicker: false
    });
    var data = {estado:1};
    var ids = [];
    slctGlobal.listarSlctFuncion('cargo','nivel','slct_nivel','simple',ids,data);
    slctGlobalHtml('slct_persona','simple');

    $("#generar").click(Mostrar);
});

Mostrar=function(){
    var nivel=$("#slct_nivel").val();
    var persona= $("#slct_persona").val();

    if ( nivel!=="" && persona!=="") {
            data = {nivel:nivel, persona:persona};
           Accion.mostrarValida(data,HTMLreporte);
    } else if(nivel==="") {
        alert("Seleccione Nivel");
    } else if(persona===""){
        alert("Seleccione un Miembro del Nivel");
    }
}

Guardar=function(){
    var datos=$("#formValidar").serialize().split("persona_td_").join("").split("txt_").join("").split("slct_").join("");
    Accion.Validar(datos,Mostrar);
}

ActivaCheck=function(id,valor){
    $("#persona_"+id).remove();

    var html='';
    if( $("#"+id).attr('class')=='checkbox-td' && id.split("_")[1]=='email' ){
        $("#"+id).removeClass('checkbox-td').addClass('checkbox-td-check');
        html="<input id='persona_"+id+"' type='hidden' value='"+id.split("_")[1]+"_"+id.split("_")[2]+"_1"+"' name=personas[]>";
    }
    else if( $("#"+id).attr('class')=='checkbox-td-check' && id.split("_")[1]=='email' ){
        $("#"+id).removeClass('checkbox-td-check').addClass('checkbox-td');
        html="<input id='persona_"+id+"' type='hidden' value='"+id.split("_")[1]+"_"+id.split("_")[2]+"_0"+"' name=personas[]>";
    }
    else if( valor!=undefined ){
        if( valor==0 && $("#"+id).attr('class')=='checkbox-td-check' ){
            $("#"+id).removeClass('checkbox-td-check').addClass('checkbox-td');
        }
        else if( valor==0 && $("#"+id).attr('class')=='checkbox-td' ){
        }
        else if( $("#"+id).attr('class')=='checkbox-td' ){
            $("#"+id).removeClass('checkbox-td').addClass('checkbox-td-check');
            html="<input id='persona_"+id+"' type='hidden' value='"+id.split("_")[1]+"_"+id.split("_")[2]+"_"+valor+"' name=personas[]>";
        }
        else{
            html="<input id='persona_"+id+"' type='hidden' value='"+id.split("_")[1]+"_"+id.split("_")[2]+"_"+valor+"' name=personas[]>";
        }
    }
    $("#"+id).append(html);
}

DetalleNivel=function(){
    var val = $("#slct_nivel").val();
    var data={estado:1, nivel_id:val};
    if(val==""){
        val=0;
    }

    $("#slct_persona").multiselect('destroy');
    slctGlobal.listarSlctFuncion('persona','nivel','slct_persona','simple',null,data);
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
