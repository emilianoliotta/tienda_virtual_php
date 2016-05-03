$(document).ready(function(){


	//PRODUCTS MANAGEMENT - Animacion para los formularios de edicion de productos y eliminacion de los mismos
	edit_product_buttons = $(".edit-product-button");
	$(".edit-product-form").hide();
	edit_product_buttons.on('click', function(){
		id = this.id;
		form_id = "#form-";
		form_id = form_id.concat(id);
		$(form_id).slideToggle();
	});

	delete_product_buttons = $(".delete-product-button");
	delete_product_buttons.on('click', function(){
		id = this.id;
		form_id = "#delete-product-form-"
		form_id = form_id.concat(id);
		$(form_id).submit();
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


	// FILTROS - Animacion para el panel de filtros
	filter_panel = $("#filter-panel");
	filter_panel.hide();
	filter_button = $("#filter-button");
	filter_button.on('click', function(){
		filter_panel = $("#filter-panel");
		filter_panel.slideToggle();
	});

	if($("#remove-filter-button").length){
		filter_button.removeClass("button");
		filter_button.addClass("btn-success");
		filter_button.text("Filtros aplicados");
	}
	if($("#remove-filter-button").length && $("table").length){
				filter_panel.show();
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


});
