$(document).ready(function(){

	//PRODUCTS MANAGEMENT - Animacion para los formularios de edicion de productos
	edit_product_buttons = $(".edit-product-button");
	$(".edit-product-form").hide();
	edit_product_buttons.on('click', function(){
		id = this.id;
		form_id = "#form-";
		form_id = form_id.concat(id);
		$(form_id).slideToggle();
	});


	//CATEGORIES MANAGEMENT - Animacion para los formularios de edición de categorias y de nueva categoria
	edit_category_buttons = $(".edit-category-button");
	$(".edit-category-form").hide();
	edit_category_buttons.on('click', function(){
		id = this.id;
		form_id = "#form-";
		form_id = form_id.concat(id);
		$(form_id).fadeToggle('slow');
	});

	new_category_button = $("#new-category-button");
	$("#new-category-form").hide();
	new_category_button.on('click',function(){
		$("#new-category-form").slideToggle(function(){
				$("#new-category-input").focus();
		});
		button_text = $(this).text();
		if (button_text == "Agregar categoría"){
			button_text = "Cancelar";
		}else {
			button_text = "Agregar categoría";
		}
		$(this).text(button_text);
	});


	// CATEGORIES - Animacion para el panel de categorias
	categories_panel = $("#categories-panel");
	categories_panel.hide();
	categories_button = $("#categories-button");
	categories_button.on('click', function(){
		categories_panel = $("#categories-panel");
		categories_panel.slideToggle();
	});

	if($("#remove-filter-button").length){
		categories_button.removeClass("button");
		categories_button.addClass("btn-success");
		categories_button.text("Categoria seleccionada");
	}
	if($("#remove-filter-button").length && $("table").length){
				categories_panel.show();
	}


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
