$(document).ready(function(){

	// USER EDIT - Botón de cambio de contraseña
	$("#change-pass-btn").on('click', function(){

		var button = $("#change-pass-btn");
		var button_text = button.text();

		if (button_text == "CANCELAR CAMBIO DE CONTRASEÑA")
			button_text = "¿CAMBIAR CONTRASEÑA?";
		else
			button_text = "CANCELAR CAMBIO DE CONTRASEÑA";

		//Cuando se hace click en el botón, se muestra o se oculta el formulario y se cambia el texto del mismo.
		$("#change-pass-btn").text(button_text);
		$("#change-pass-form").slideToggle();
	});

});