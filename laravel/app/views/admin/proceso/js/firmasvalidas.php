<script type="text/javascript">
var cabeceraP=[];
var columnDefsP=[];
var targetsP=-1;
var OrdenG=0; // inicializa el orden
var IdEscalafonG=0; // Id Global del ecalafon
$(document).ready(function() {
    $("[data-toggle='offcanvas']").click();
    //$("#t_resultado").dataTable();
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
    var resG=dataTableG.CargarBtn(columnDefsP,targetsP,1,'EstadoFirmas','t_personas_equipos','fa-search');
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
    $(".oculta").css('display','none');
});

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

EstadoFirmas=function(btn,id){
 var data={escalafon_id:id};
 FirmasValidas.Cargar(data,EstadoFirmasHTML);
}

EstadoFirmasHTML=function(datos){
    var html="";
    //$("#t_resultado").dataTable().fnDestroy();
    $("#t_resultado tbody").html('');
    $.each(datos,function(index,data){

        html+="<tr>"+
            "<td>"+data.ficha+"</td>"+
            "<td>"+data.buenas+"</td>"+
            "<td>"+data.malas+"</td>"+
            "<td>"+data.ndni+"</td>"+
            "<td>"+data.total+"</td>";
        html+="</tr>";
    });
    $("#t_resultado tbody").html(html);

    if(html==''){
        msjG.mensaje('warning','<b>No hay firmas ingresas.',4000);
    }

    /*$("#t_resultado>tbody").dataTable({
            "scrollY": "400px",
            "scrollCollapse": true,
            "scrollX": true,
            "bPaginate": false,
            "bLengthChange": false,
            "bInfo": false,
            "visible": false,
    });*/
}
</script>
