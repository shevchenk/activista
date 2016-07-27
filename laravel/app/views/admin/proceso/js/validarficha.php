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
        return "<input type='text' onKeyPress='return msjG.validaNumeros(event);' class='form-control' name='txt_ficha' value='"+$.trim(row.ficha)+"' />";
    }
    else if(fn==5){
        return "<input type='text' onKeyPress='return msjG.validaLetras(event);' class='form-control' name='txt_paternon' value='"+$.trim(row.paternon)+"' />";
    }
    else if(fn==6){
        return "<input type='text' onKeyPress='return msjG.validaLetras(event);' class='form-control' name='txt_maternon' value='"+$.trim(row.maternon)+"' />";
    }
    else if(fn==7){
        return "<input type='text' onKeyPress='return msjG.validaLetras(event);' class='form-control' name='txt_nombresn' value='"+$.trim(row.nombresn)+"' />";
    }
}

ValidarPersona=function(btn,id){
    var tr = btn.parentNode.parentNode;
    var trs = tr.parentNode.children;
    if( ValidarFichas() ){
    ValidarFicha.GuardarFichas(tr);
    }
}

ValidarFichas=function(tr){
    var r=true;
    if( $(tr).find('input [name="ficha"]').val()=='' ){
        alert('Ingrese su Nro de Ficha');
        $(tr).find('input [name="ficha"]').focus();
        r=false;
    }
    else if( $(tr).find('input [name="paternon"]').val()=='' ){
        alert('Ingrese su Paterno a validar');
        $(tr).find('input [name="paternon"]').focus();
        r=false;
    }
    else if( $(tr).find('input [name="maternon"]').val()=='' ){
        alert('Ingrese su Materno a validar');
        $(tr).find('input [name="maternon"]').focus();
        r=false;
    }
    else if( $(tr).find('input [name="nombresn"]').val()=='' ){
        alert('Ingrese su Nombre(s) a validar');
        $(tr).find('input [name="nombresn"]').focus();
        r=false;
    }
    return r;
}

</script>
