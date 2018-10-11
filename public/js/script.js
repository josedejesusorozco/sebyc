var route = "http://127.0.0.1:8000/";
var token = $("#estimacion_btn").val();

function bloqueo(form) {
	//alert("Aqui"); 
	$("#padre").removeClass('invisible');
	$(form).submit();
}

function bloqueo2() {
	$("#padre").removeClass('invisible');
}

function desbloqueo() {
	$("#padre").addClass('invisible');
}


function prepara_arboles() {

	bloqueo2();

	$.ajax({
		url: route + 'prepara_arboles',
		headers: {'X-CSRF-TOKEN': token},
		type: 'POST',
		dataType: 'json',
		data: {prueba: 'test'},
	    success: function (response) {
	    	//alert(response.mensaje);
	    	arbol_biomasa();
	    },
	    error: function(jqXHR, textStatus, errorThrown) {
	        console.log(JSON.stringify(jqXHR));
	        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
	    }
	});
}

function arbol_biomasa() {

	$.ajax({
		url: route + 'arbol_biomasa',
		headers: {'X-CSRF-TOKEN': token},
		type: 'POST',
		dataType: 'json',
		data: {prueba: 'test'},
	    success: function (response) {
	    	//alert(response.mensaje);
	    	arbol_densidad();
	    },
	    error: function(jqXHR, textStatus, errorThrown) {
	        console.log(JSON.stringify(jqXHR));
	        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
	    }
	});
}

function arbol_densidad() {

	$.ajax({
		url: route + 'arbol_densidad',
		headers: {'X-CSRF-TOKEN': token},
		type: 'POST',
		dataType: 'json',
		data: {prueba: 'test'},
	    success: function (response) {
	    	//alert(response.mensaje);
	    	arbol_carbono();
	    },
	    error: function(jqXHR, textStatus, errorThrown) {
	        console.log(JSON.stringify(jqXHR));
	        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
	    }
	});
}

function arbol_carbono() {

	$.ajax({
		url: route + 'arbol_carbono',
		headers: {'X-CSRF-TOKEN': token},
		type: 'POST',
		dataType: 'json',
		data: {prueba: 'test'},
	    success: function (response) {
	    	//alert(response.mensaje);
	    	calcula_biomasa();
	    },
	    error: function(jqXHR, textStatus, errorThrown) {
	        console.log(JSON.stringify(jqXHR));
	        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
	    }
	});
}

function calcula_biomasa() {

	$.ajax({
		url: route + 'calcula_biomasa',
		headers: {'X-CSRF-TOKEN': token},
		type: 'POST',
		dataType: 'json',
		data: {prueba: 'test'},
	    success: function (response) {
	    	//alert(response.mensaje);
	    	muestra_resultados();
	    },
	    error: function(jqXHR, textStatus, errorThrown) {
	        console.log(JSON.stringify(jqXHR));
	        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
	    }
	});
}

function muestra_resultados() {

	$.ajax({
		url: route + 'muestra_resultados',
		headers: {'X-CSRF-TOKEN': token},
		type: 'POST',
		//dataType: 'json',
		data: {prueba: 'test'},
	    success: function (response) {
	    	//alert(response);

	    	$('#tabla').html(response);
	    },
	    error: function(jqXHR, textStatus, errorThrown) {
	        console.log(JSON.stringify(jqXHR));
	        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
	    }
	});

	desbloqueo();
}

$("#estimacion_btn").click(function(){
	prepara_arboles();
	//arbol_biomasa();
	//arbol_densidad();
	//arbol_carbono();
	//calcula_biomasa();
	//muestra_resultados();
});

/*$( document ).ready(function() {

    $.ajax({
		url: route + 'cuenta_registros',
		headers: {'X-CSRF-TOKEN': token},
		type: 'POST',
		//dataType: 'json',
		data: {prueba: 'test'},
	    success: function (response) {
	    	alert(response[1].data);
	    },
	    error: function(jqXHR, textStatus, errorThrown) {
	        console.log(JSON.stringify(jqXHR));
	        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
	    }
	});
});*/