<script type="text/javascript">
var cabeceraP=[];
var columnDefsP=[];
var targetsP=-1;
var OrdenG=0; // inicializa el orden
var IdEscalafonG=0; // Id Global del ecalafon
var IdEscalafonFichaG=0; // Id Global del ecalafon ficha
var TotalEntregadoG=0; // Total de entregados a validar
var DesdeEntregadoG=0;
var HastaEntregadoG=0;
var BottonDblClick=true;
$(document).ready(function() {
    $("[data-toggle='offcanvas']").click();
    var data = {estado:1};
    var ids = [];

    var idG={ paterno       :'onBlur|Paterno|#DCE6F1',
              materno       :'onBlur|Materno|#DCE6F1',
              nombres       :'onBlur|Nombres|#DCE6F1',
              dni           :'onBlur|DNI|#DCE6F1',
              celular       :'onBlur|Celular|#DCE6F1',
              cargo         :'onBlur|Cargo|#DCE6F1',
              fecha_inicio  :'onChange|Fecha Inicio|#DCE6F1',
              equipo        :'onBlur|Equipo|#F2DCDB',
              departamento  :'onBlur|Departamento|#F2DCDB',
              provincia     :'onBlur|Provincia|#F2DCDB',
              distrito      :'onBlur|Distrito|#F2DCDB',
              localidad     :'onBlur|Localidad|#F2DCDB',
             };

    var resG=dataTableG.CargarCab(idG);
    cabeceraP=resG; // registra la cabecera
    var resG=dataTableG.CargarCol(cabeceraP,columnDefsP,targetsP,1,'personas_equipos','t_personas_equipos');
    columnDefsP=resG[0]; // registra las columnas del datatable
    targetsP=resG[1]; // registra los contadores
    var resG=dataTableG.CargarBtn(columnDefsP,targetsP,1,'DetalleEntrega','t_personas_equipos','fa-edit');
    columnDefsP=resG[0]; // registra la colunmna adiciona con boton
    targetsP=resG[1]; // registra el contador actualizado
    MostrarAjax('personas_equipos');

    $("#txt_fecha_inicio").daterangepicker(
        {
            format: 'YYYY-MM-DD',
            singleDatePicker: true,
            showDropdowns: true
        }
    );
    $(".oculta,.oculta2").css('display','none');
});

BtnDblClick=function(){
    $("#t_personas_equipos>tbody>tr").attr("OnDblClick","BtnDbl(this)");
}

BtnDbl=function(t){
    $(t).find("a").click();
}

ListarFicha=function(v){
    $("#t_fichas tbody").html('');
}

MostrarAjax=function(t){
    if( t=="personas_equipos" ){
        if( columnDefsP.length>0 ){
            dataTableG.CargarDatos(t,'grupop','cargarpe',columnDefsP);
        }
        else{
            alert('Faltas datos');
        }
    }
}

DetalleEntrega=function(btn,id){
    var tr = btn.parentNode.parentNode;
    var trs = tr.parentNode.children;
    for(var i =0;i<trs.length;i++)
        $(trs[i]).removeAttr("style");
    tr.style.backgroundColor = "#9CD9DE";

    $(".oculta").css("display","");
    $(".oculta2").css("display","none");

    var texto= '<h2><b>Persona:</b> '+$(tr).find("td:eq(0)").text()+' '+$(tr).find("td:eq(1)").text()+' '+$(tr).find("td:eq(2)").text();
    texto+=' <b>| Cargo:</b> '+$(tr).find("td:eq(5)").text();
    texto+=' <b>| Equipo:</b> '+$(tr).find("td:eq(7)").text()+'</h2>';
    $("#t_fichas span").html(texto);
    
    IdEscalafonG=id;
    
}

CargarEntregas=function(){
    var data={ id:IdEscalafonG };
    ValidacionFirma.CargarEntregas(data,CargarEntregasHTML);
}

CargarEntregasHTML=function(datos){
    var html='';
    $('#t_fichas').dataTable().fnDestroy();
    $.each(datos,function(index,data){
        html+=  "<tr>"+
                    "<td>"+data.orden+"</td>"+
                    "<td><input type='text' disabled class='fecha form-control' name='txt_fecha_entrega[]' value='"+data.fecha_entrega+"'></td>"+
                    "<td><input type='text' disabled class='form-control' name='txt_desde[]' value='"+data.desde+"'></td>"+
                    "<td><input type='text' disabled class='form-control' name='txt_hasta[]' value='"+data.hasta+"'></td>"+
                    "<td><input disabled type='text' class='form-control' value='"+data.total+"'></td>"+
                    "<td>"+
                        "<a class='btn btn-primary' onclick='DetalleRecepcion(this,"+data.id+");'><i class='fa fa-lg fa-edit'></i></a>"+
                    "</td>"+
                "</tr>";
    });

    $("#t_fichas>tbody").html(html); 
    $("#t_fichas").dataTable();
    $(".fecha").daterangepicker(
        {
            format: 'YYYY-MM-DD',
            singleDatePicker: true,
            showDropdowns: true
        }
    );
}

ValidarTotal=function(){
    var r=true;
    var total=0;
    var buena=0;

    $("#t_fichas_recepcionadas tbody tr td").removeClass("has-error");
    $("#t_fichas_recepcionadas tbody tr").removeClass("danger");
    $("#t_fichas_recepcionadas tbody tr").each( function( index ){
        
    });
}

Guardar=function(){
    if( ValidarFichas() ){
        var data=$("#form_escalafon_fichas_recepcionadas").serialize().split("txt_").join("").split("slct_").join("");
        ValidacionFirma.GuardarFichasValidacion(data,CargarRecepcion);
    }
}

</script>
