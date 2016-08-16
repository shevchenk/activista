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

ValidaT=function(inicio,fin,td){
    var desde=$.trim($("#"+inicio).val());
    var hasta=$.trim($("#"+fin).val());
    
    $(td.parentNode).removeClass("danger");

    if(desde!='' && hasta!=''){
        if( desde*1>hasta*1 ){
            $(td).addClass("has-error");
            $(td.parentNode).addClass("danger");
        }
    }
}

ValidaMenorMayor=function(inicio,fin,tr){
    var r=true;
    var desde=$.trim($("#"+inicio).val());
    var hasta=$.trim($("#"+fin).val());

    if(desde!='' && hasta!=''){
        if( desde*1>hasta*1 ){
            alert('La ficha de inicio no puede ser mayor a la ficha final');
        }
        else{
            $(tr).find("td").removeClass("has-error");
        }
    }
}


Limpiar=function(){
    $(".lim").val('');
}

GuadarDatos=function(){

}

ValidarFichas=function(tr){
    var r=true;

    return r;
}

</script>
