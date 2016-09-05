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
        alert('El DNI debe contener 8 caracteres, no '+d.length+' caracteres');
    }
}
</script>
