// Puedes acceder a las variables globales de la página a través de "jsGlobals". La
// definición de este objeto global está registrada en la vista de autores "porPais".

var editDialog = $("#popup-edicion");

$(document).on("click", ".edit-link", function(e) {
	e.preventDefault();
	
	$.pjax({
		url: $(this).attr("href"), 
		container: '#edit-container',
		push: false, // do not pushState (set url).
		
		// Ejemplo 1: esta opción será recibida en los eventos pjax del contenedor.
//		abrirPopup: true
		
	});
});


$(document).on("pjax:success", "#edit-container", function(event, data, status, xhr, options) {
	
	// Ejemplo 1: se pueden pasar opciones personalizadas a pjax a través de la llamada $.pjas(opciones). Después
	// se extraen del parámetro options de la función que maneja el evento.
	// Ver: http://stackoverflow.com/questions/21679655/jquery-pjax-ajax-success-function
//	if (options.abrirPopup === true) {
//		editDialog.dialog("open");
//	} else {
//		$.pjax.reload("#listado", { url: jsGlobals.url });
//	}
	
	// Ejemplo 2: comprobar el contenido, en busca de un mensaje incluido desde el servidor.
	var serverResponse = $(this).find("input[data-server-response]").data("server-response");
	switch (serverResponse) {
	
	case 'success':
		editDialog.dialog("close");
		$.pjax.reload("#listado", { url: jsGlobals.url, push: false });
		break;
		
	default:
		editDialog.dialog("open");
		break
		
	}
	
});
	
