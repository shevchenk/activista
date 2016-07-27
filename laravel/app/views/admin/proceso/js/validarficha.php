<script type="text/javascript">
var cabeceraP=[];
var columnDefsP=[];
var targetsP=-1;
var OrdenG=0; // inicializa el orden
var IdEscalafonG=0; // Id Global del ecalafon
$(document).ready(function() {
    $("[data-toggle='offcanvas']").click();
    var data = {estado:1};
    var ids = [];

    var idG={ paterno       :'onBlur|Paterno de Reniec|#DCE6F1',
              materno       :'onBlur|Materno de Reniec|#DCE6F1',
              nombres       :'onBlur|Nombres de Reniec|#DCE6F1',
              dni           :'onBlur|DNI de Reniec|#DCE6F1',
              ficha         :'1|Ficha a Validar|#F2DCDB',
              paternon      :'1|Paterno a Validar|#F2DCDB',
              maternon      :'1|Materno a Validar|#F2DCDB',
              nombresn      :'1|Nombres a Validar|#F2DCDB',
             };

    var resG=dataTableG.CargarCab(idG);
    cabeceraP=resG; // registra la cabecera
    var resG=dataTableG.CargarCol(cabeceraP,columnDefsP,targetsP,1,'validacion_personas','t_validacion_personas');
    columnDefsP=resG[0]; // registra las columnas del datatable
    targetsP=resG[1]; // registra los contadores
    var resG=dataTableG.CargarBtn(columnDefsP,targetsP,1,'ValidarPersona','t_validacion_personas','fa-edit');
    columnDefsP=resG[0]; // registra la colunmna adiciona con boton
    targetsP=resG[1]; // registra el contador actualizado
    MostrarAjax('validacion_personas');
});

MostrarAjax=function(t){
    if( t=="validacion_personas" ){
        if( columnDefsP.length>0 ){
            console.log(columnDefsP)
            dataTableG.CargarDatos(t,'ficha','cargarpersonas',columnDefsP);
        }
    }
}

GeneraFn=function(row,fn){ // No olvidar q es obligatorio cuando queir efuncion fn
    if(fn==4){
        return "<input type='text' name='txt_ficha' value='"+$.trim(row.ficha)+"' />";
    }
    else if(fn==5){
        return "<input type='text' name='txt_paternon' value='"+$.trim(row.paternon)+"' />";
    }
    else if(fn==6){
        return "<input type='text' name='txt_maternon' value='"+$.trim(row.maternon)+"' />";
    }
    else if(fn==7){
        return "<input type='text' name='txt_nombresn' value='"+$.trim(row.nombresn)+"' />";
    }
}

ValidarPersona=function(btn,id){
    if( ValidarFichas() ){
    var tr = btn.parentNode.parentNode;
    var trs = tr.parentNode.children;

    /*var texto= '<b>Persona:</b> '+$(tr).find("td:eq(0)").text()+' '+$(tr).find("td:eq(1)").text()+' '+$(tr).find("td:eq(2)").text();
    texto+=' <b>| Cargo:</b> '+$(tr).find("td:eq(5)").text();
    texto+=' <b>| Equipo:</b> '+$(tr).find("td:eq(7)").text();*/
    ValidarFicha.GuardarFichas();
    }
}

ValidarFichas=function(){
    var r=true;
    if( $("#t_fichas tbody tr td.has-error").length>0 ){
        alert('Verifique los casilleros con alerta(Borde Rojo)');
        r=false;
    }
    else{
        if( $("#t_fichas>tbody>tr>td>input").length>0 ){
            $("#t_fichas>tbody>tr").each( function( index ){
                if( r==true && $.trim($(this).find("input:eq(0)").val())=='' ){
                    alert('Ingrese Fecha de Entrega de la Posición:'+(index+1));
                    $(this).find("input:eq(0)").focus();
                    r=false;
                }
                else if( r==true && $.trim($(this).find("input:eq(1)").val())=='' ){
                    alert('Ingrese El inicio de la ficha de la Posición :'+(index+1));
                    $(this).find("input:eq(1)").focus();
                    r=false;
                }
                else if( r==true && $.trim($(this).find("input:eq(2)").val())=='' ){
                    alert('Ingrese El fin de la ficha de la Posición:'+(index+1));
                    $(this).find("input:eq(2)").focus();
                    r=false;
                }
            });
        }
    }

    return r;
}

</script>
