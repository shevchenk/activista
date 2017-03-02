<script type="text/javascript">
$(document).ready(function() {
   $("#valida").click(Eliminar);
});

Eliminar=function(){
    if( confirm("Esta apunto de eliminar la página nro "+$("#txt_pagina").val()) ){
        var data=$("#form_validacion").serialize().split("txt_").join("").split("slct_").join("");
        Elimina.Elimina(data);
    }
}

Limpiar=function(){
    $("#txt_pagina").val('');
    $("#txt_pagina").focus();
}

</script>
