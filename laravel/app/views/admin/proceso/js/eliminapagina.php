<script type="text/javascript">
$(document).ready(function() {
   $("#valida").click(Eliminar);
});

Eliminar=function(){
    var data=$("#form_validacion").serialize().split("txt_").join("").split("slct_").join("");
    Elimina.Elimina(data);
}

Limpiar=function(){
    $("#txt_pagina").val('');
    $("#txt_pagina").focus();
}

</script>
