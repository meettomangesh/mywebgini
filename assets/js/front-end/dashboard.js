siteObjJs.frontend.dashboardJS = function () {

    var initializeListener = function () {
        /* $('.submit-enquiry').click(function(){
         $('#add-enquiry').submit();
         //siteObjJs.validation.formValidateInit('#add-enquiry', handleAjaxRequest);
         });*/
        alert();
        var editEnquiryForUtilizer = function (enquiryId, userId) {
        $.ajax(
                {
                    url: '/dashboard/getEditEnquiryForm',
                    cache: false,
                    type: 'POST',
                    data: {'enquiryId': enquiryId, 'userId': userId},
                    success: function (data)
                    {
                        alert('inside success');
                        data = JSON.parse(data);
                        if (data.status === "error") {
                        } else {
                            if (formId === 'add-enquiry') {
                                $('#editEnquiryDiv').html(data.editEnquiryForm);
                                //$('#add-enquiry')[0].reset();
                                //$('.collapsible').collapsible();
                            }
                        }
                    },
                    error: function (jqXhr, json, errorThrown)
                    {

                    }
                }
        );
    };
    };


    // Common method to handle add and edit ajax request and reponse
    var handleAjaxRequest = function () {
        var formElement = $(this.currentForm); // Retrive form from DOM and convert it to jquery object
        var formId = formElement.attr('id');
        var actionUrl = formElement.attr("action");
        var actionType = formElement.attr("method");
        var formData = formElement.serialize();
        var icon = "check";
        var messageType = "success";
        var message = '';
        $.ajax(
                {
                    url: actionUrl,
                    cache: false,
                    type: actionType,
                    data: formData,
                    success: function (data)
                    {
                        alert('inside success');
                        data = JSON.parse(data);
                        if (data.status === "error") {
                        } else {
                            if (formId === 'add-enquiry') {
                                $('#replacableEnquiryUl').html(data.enquiry);
                                $('#add-enquiry')[0].reset();
                                $('.collapsible').collapsible();
                            }
                        }
                    },
                    error: function (jqXhr, json, errorThrown)
                    {

                    }
                }
        );
    }

    
    return {
        //main function to initiate the module
        init: function () {
             alert(234);
       
            initializeListener();
            siteObjJs.validation.formValidateInit('#add-enquiry', handleAjaxRequest);
        }
    };
}();