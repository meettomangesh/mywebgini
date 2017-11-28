siteObjJs.frontend.authJs = function () {

    var init = function () {
        siteObjJs.validation.formValidateInit('#front-end-login', handleUsernameValidateAjaxRequest);
        siteObjJs.validation.formValidateInit('#registration_form', handleUsernameValidateAjaxRequest); 
    };
    var handleUsernameValidateAjaxRequest = function () {
        var formElement = $(this.currentForm);
        formElement.submit();
    }
    
    $.validator.addMethod("validEmail", function (value, element)
    {
        return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(value);
    }, "Please enter a valid Email Address.")

    var displayFormErrorPlacement = function (element, text) { // render error placement for each input type
        var error = $('<span/>', {
            class: 'help-block help-block-error',
            text: text
        });
        alert('displayFormErrorPlacement');
        return false;
        if (element.parent(".input-group").size() > 0) {
            error.insertAfter(element.parent(".input-group"));
        } else if (element.attr("data-error-container")) {
            error.appendTo(element.attr("data-error-container"));
        } else if (element.parents('.radio-list').size() > 0) {
            error.appendTo(element.parents('.radio-list').attr("data-error-container"));
        } else if (element.parents('.radio-inline').size() > 0) {
            error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
        } else if (element.parents('.checkbox-list').size() > 0) {
            error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
        } else if (element.parents('.checkbox-inline').size() > 0) {
            error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
        } else {
            error.insertAfter(element);
        }
        element.closest('.form-group').addClass('has-error');
    };
    return {
        'init': init,
        'displayFormErrorPlacement': displayFormErrorPlacement
    };
}();