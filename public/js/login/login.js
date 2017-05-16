var clickbtn="btnIniciar";
$(document).ready(function() {
	//$('.formNotice span').click(function() {
		$("body").attr("onkeyup","return validaEnter(event,'"+clickbtn+"')");
	//});

	$("#btnIniciar").click(IniciarSession);
	$("#mensaje_msj").fadeOut(3500);

	$("#btnRegistrar").click(Registrar);
	$("#btnNuevo").click(Nuevo);
	$("#btnRegresar").click(Regresar);

    $("#imagenppkModal").draggable({
        handle: ".modal-header"
    });

	$('#imagenppkModal').on('shown.bs.modal', function (event) {

        var button = $(event.relatedTarget); // captura al boton
        var modal = $(this); //captura el modal
        variables=button.data('img');
        /*
        $(".visibles").css("display","none");
        $("#visible"+variables).css("display","");
        */
        $("#imagenppk").attr('src','img/imagenppk/img'+variables+'.png?nocache=' + (new Date()).getTime());
        //$("#imagenppk").fadeOut(3000,function(){
        //    $("#imagenppk").fadeIn(3000);
        //});

    });

    $('#imagenppkModal').on('hide.bs.modal', function (event) {
			$("#imagenppk").attr('src','');
    });
});

validaEnter=function(e){
	tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==13){
    	$("#"+clickbtn).click();	
    }	    
}

Nuevo=function(){
	if( $("[name='rdb_check']").is(':checked')==false ){
        alert("Seleccione un tipo de PPKausa");
    }
    else if( $("#paterno").val()=='' ){
		alert("Ingrese Paterno");
		$("#paterno").focus();
	}
	else if( $("#materno").val()=='' ){
		alert("Ingrese Materno");
		$("#materno").focus();
	}
	else if( $("#nombre").val()=='' ){
		alert("Ingrese Nombre");
		$("#nombre").focus();
	}
	else if( $("#email").val()=='' ){
		alert("Ingrese Email");
		$("#email").focus();
	}
	else if( $("#dni").val()=='' ){
		alert("Ingrese Dni");
		$("#dni").focus();
	}
	else if( $("#passwordn").val()=='' ){
		alert("Ingrese Contraseña");
		$("#passwordn").focus();
	}
	else if( $("#passwordc").val()=='' ){
		alert("Ingrese Confirmacion de la Contraseña");
		$("#passwordc").focus();
	}
	else if( $("#passwordc").val()!=$("#passwordn").val() ){
		alert("Contraseña no coinciden");
		$("#passwordn").focus();
	}
	else{
		Login.Registrar();
	}
}

Regresar=function(){
	$("#newForm").css("display","none");
	$("#logForm").css("display","");
}

Registrar=function(){
	$("#newForm").css("display","");
	$("#logForm").css("display","none");
}

IniciarSession=function(){
	if($.trim($("#usuario").val())==''){
		MostrarMensaje("Ingrese su <strong>Usuario</strong>");
	}
	else if($.trim($("#password").val())==''){
		MostrarMensaje("Ingrese su <strong>Password</strong>");
	}
	else{
		Login.IniciarLogin();
	}
}

MostrarMensaje=function(msj){

	$("#mensaje_error").html(msj);

    $("#mensaje_inicio").fadeOut(1500, function()
    {
		$("#mensaje_error").fadeIn(1500,function()
		{
	    	$("#mensaje_error").fadeOut(6000,function()
	    	{
	    		$("#mensaje_inicio").fadeIn(1500);
	    		$("#mensaje_error").attr("class","label-danger");
	    	});	    	
    	});
	}); 
}
