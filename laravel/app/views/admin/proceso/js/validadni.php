<script type="text/javascript">
$(document).ready(function() {

});

ValidaDNI=function(){
    var d=$("#txt_dni").val();
    if( $.trim( d )!='' && d.length==8 ){
        var data={dni:d};
        Accion.ValidaDNI(data);
    }
    else if( $.trim( d )=='' ){
        alert('Ingrese DNI');
    }
    else if( d.length!=8 ){
        alert('Complete su dni a 8 caracteres');
    }
}
</script>
