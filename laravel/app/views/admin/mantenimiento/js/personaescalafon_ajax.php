<script type="text/javascript">
var persona_id, cargos_selec=[], PersonaObj=[];
var Persona={
    CargarPersonasTotal:function(columnDefs){
        $('#t_personas').dataTable().fnDestroy();
        $('#t_personas')
            .on( 'page.dt',   function () { $("body").append('<div class="overlay"></div><div class="loading-img"></div>'); } )
            .on( 'search.dt', function () { $("body").append('<div class="overlay"></div><div class="loading-img"></div>'); } )
            .on( 'order.dt',  function () { $("body").append('<div class="overlay"></div><div class="loading-img"></div>'); } )
            .DataTable( {
                "processing": true,
                "serverSide": true,
                "stateSave": true,
                "searching": false,
                "ordering": false,
                "stateLoadCallback": function (settings) {
                    $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
                },
                "stateSaveCallback": function (settings) { // Cuando finaliza el ajax
                    $(".overlay,.loading-img").remove();
                },
                "ajax": {
                        "url": "persona/cargar",
                        "type": "POST",
                        //"async": false,
                            "data": function(d){
                                datos=$("#form_filtros").serialize().split("txt_").join("").split("slct_").join("").split("%5B%5D").join("[]").split("+").join(" ").split("%7C").join("|").split("&");
                                
                                for (var i = datos.length - 1; i >= 0; i--) {
                                    if( datos[i].split("[]").length>1 ){
                                        d[ datos[i].split("[]").join("["+contador+"]").split("=")[0] ] = datos[i].split("=")[1];
                                        contador++;
                                    }
                                    else{
                                        d[ datos[i].split("=")[0] ] = datos[i].split("=")[1];
                                    }
                                };
                            },
                        },
                columnDefs
            } );
    },
    CargarEscalafon:function(persona_id){
        //getOpciones
        $.ajax({
            url         : 'persona/cargarescalafon',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : {persona_id:persona_id},
            async       : false,
            beforeSend : function() {
                
            },
            success : function(obj) {
                //CARGAR areas
                if(obj.datos[0].DATA !== null){
                    var cargos = obj.datos[0].DATA.split("|"); 

                    var html="";

                    $.each(cargos, function(i,opcion){
                        var data = opcion.split("-");
                        html+="<li class='list-group-item'><div class='row'>";
                        html+="<div class='col-sm-4' id='cargo_"+data[0]+"'><h5>"+$("#slct_cargos option[value=" +data[0] +"]").text()+"</h5></div>";
                        var areas = data[1].split(",");
                        html+="<div class='col-sm-6'><select class='form-control' multiple='multiple' name='slct_areas"+data[0]+"[]' id='slct_areas"+data[0]+"'></select></div>";
                        //var envio = {cargo_id: data[0]};
                        var envio = {cargo_id: data[0],estado:1};
                        slctGlobal.listarSlct('area','slct_areas'+data[0],'multiple',areas,envio);

                        html+='<div class="col-sm-2">';
                        html+='<button type="button" id="'+data[0]+'" Onclick="EliminarArea(this)" class="btn btn-danger btn-sm" >';
                        html+='<i class="fa fa-minus fa-sm"></i> </button></div>';
                        html+="</div></li>";
                        cargos_selec.push(data[0]);
                    });
                    $("#t_cargoPersona").html(html); 
                }
            },
            error: function(){
            }
        });
    },
};
</script>
