// VALIDATIONS - Validaciones de los datos de los formularios
$(document).ready(function(){

  if ($("#js-categories-management").length){
    $(".edit-category-form").validate();
    $("#new-category-form").validate();
  }

  if ($("#js-product-new").length){
    $("#new-product-form").validate();
  }

  if ($("#js-products-management").length){
    $(".edit-product-form").validate();
  }

  if ($("#js-user-edit").length){
    $("#user-edit-form").validate();

    $("#change-pass-form").validate({
      rules: {
        nueva_clave_repetida: {
          equalTo: nueva_clave
        }
      }
    });
  }

  if ($("#js-user-login").length){
    $("#user-login-form").validate();
  }

  if ($("#js-user-registration").length){
    $("#user-registration-form").validate({
      rules: {
        email_repetido: {
          equalTo: email
        },
        clave_repetida: {
          equalTo: clave
        }
      }
    });
  }

});
