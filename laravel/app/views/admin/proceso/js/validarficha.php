<script type="text/javascript">
var cabeceraP=[];
var columnDefsP=[];
var targetsP=-1;
var OrdenG=0; // inicializa el orden
var IdEscalafonG=0; // Id Global del ecalafon
$(document).ready(function() {
    //$("[data-toggle='offcanvas']").click();
    $(".ocultar").css("display","none");
});

BuscarFicha=function(){
    var data={ficha:$("#txt_ficha").val()};
    ValidarFicha.BuscarFicha(data,BuscarFichaHTML);
}

BuscarDNI=function(){
    if( $.trim( $("#txt_dni_b").val() )=='' ){
        alert('Ingrese el dni a validar');
    }
    else if( $("#txt_dni_b").val().length<8 ){
        alert('DNI Inválido, Ingrese los 8 caracteres del DNI');
    }
    else{
    var data={dni:$("#txt_dni_b").val(),ficha:$("#txt_ficha").val()};
    ValidarFicha.BuscarDNI(data,BuscarDNIHTML);
    }
}

BuscarDNIHTML=function(obj){
    Limpiar();
    if( obj.length>0 ){
        $("#txt_paterno").val($.trim( obj[0].paterno) );
        $("#txt_materno").val($.trim( obj[0].materno) );
        $("#txt_nombres").val($.trim( obj[0].nombres) );
        $("#txt_dni").val($.trim( obj[0].dni) );
        $("#txt_ficha_id").val($.trim( obj[0].ficha_id) );
        $("#txt_reniec").val($.trim( obj[0].id) );
    }
}

BuscarFichaHTML=function(obj){
    if(obj.rst==1){
        $("#div_ficha").addClass("has-success");
        $("#div_ficha").text(obj.msj);
        $("#h2_ficha").html("Validar Ficha Nro: <font size=+4>"+$("#txt_ficha").val()+"</font>");
        $("#th_ficha").html("Firmas de la Ficha Nro: "+$("#txt_ficha").val()+"");
        msjG.mensaje('success',obj.msj,4000);
        $(".ocultar").css("display","");

        $("#t_mensaje_final>tbody>tr:eq(0)>td:eq(0)").text('');
        $("#t_mensaje_final>tbody>tr:eq(0)>td:eq(1)").text('');
        if(obj.estado.length>0){
        $("#t_mensaje_final>tbody>tr:eq(0)>td:eq(0)").text(obj.estado[0].buenas);
        $("#t_mensaje_final>tbody>tr:eq(0)>td:eq(1)").text(obj.estado[0].malas);
        }
    }
    else{
        $("#div_ficha").addClass("has-danger");
        $("#div_ficha").text(obj.msj);
        msjG.mensaje('warning',obj.msj,4000);
        $(".ocultar").css("display","");
    }
}

Limpiar=function(){
    $(".lim").val('');
}

GuadarDatos=function(){
    if( ValidarFichas() ){
        var data={
                        reniec      : $("#txt_reniec").val(),
                        ficha_id    : $("#txt_ficha_id").val(),
                        ficha       : $("#txt_ficha").val(),
                        paternon    : $("#txt_paternon").val(),
                        maternon    : $("#txt_maternon").val(),
                        nombresn    : $("#txt_nombresn").val(),
                        paterno     : $("#txt_paterno").val(),
                        materno     : $("#txt_materno").val(),
                        nombres     : $("#txt_nombres").val(),
                        dni         : $("#txt_dni").val(),
                    }
        ValidarFicha.GuardarFichas(data,Limpiar);
        $("#txt_dni_b").val("");
    }
}

ValidarFichas=function(tr){
    var r=true;
    if( $.trim( $("#txt_ficha").val() )=='' ){
        alert('Ingrese su Nro de Ficha');
        $("#txt_ficha").focus();
        r=false;
    }
    else if( $.trim( $("#txt_paternon").val() )=='' ){
        alert('Ingrese su Paterno a validar');
        $("#txt_paternon").focus();
        r=false;
    }
    else if( $.trim( $("#txt_maternon").val() )=='' ){
        alert('Ingrese su Materno a validar');
        $("#txt_maternon").focus();
        r=false;
    }
    else if( $.trim( $("#txt_nombresn").val() )=='' ){
        alert('Ingrese su Nombre(s) a validar');
        $("#txt_nombresn").focus();
        r=false;
    }
    return r;
}

</script>
