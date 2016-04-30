$(document).ready(function(){


	// MESSAGES - Animación de las notificaciones
	message = $("#message-wrapper");
	message.slideDown('slow', function(){
		message.removeClass('hidden');
	});
	message.delay(2000);
	message.slideUp('slow', function(){
		message.addClass('hidden');
	});


	// USER EDIT - Botón de cambio de contraseña
	$("#change-pass-form").hide();
	$("#change-pass-btn").on('click', function(){
		button = $("#change-pass-btn");
		button_text = button.text();
		
		if (button_text == "CANCELAR CAMBIO DE CONTRASEÑA")
			button_text = "¿CAMBIAR CONTRASEÑA?";
		else
			button_text = "CANCELAR CAMBIO DE CONTRASEÑA";

		//Cuando se hace click en el botón, se muestra o se oculta el formulario y se cambia el texto del mismo.
		$("#change-pass-btn").text(button_text);
		$("#change-pass-form").slideToggle();
	});



});