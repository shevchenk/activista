<script type="text/javascript">
$(document).ready(function() {
    $("#valida").click(Validar);
});

Validar=function(){
    var data=$("#form_validacion").serialize().split("txt_").join("").split("slct_").join("");
    Accion.Validar(data);
}

</script>
