/**
 * Created by Rohan on 26-12-2016.
 */

$(document).ready(function() {
    $('#institute').on('change', function() {
        var institute_id = $(this).val();
        if(institute_id) {
            $.ajax({
                url: '/programmes/'+institute_id,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('#programme').empty();
                    $.each(data, function(index,obj) {
                        $('#programme').append('<option value="'+ obj.id +'">'+ obj.name +'</option>');
                    });
                }
            });
        }else{
            $('#programme').empty();
        }
    });
});
$(document).ready(function() {
    $('.friendBtn').on('click', function(e) {
        e.preventDefault();

        $(this).html('<i class="fa fa-thumbs-up" aria-hidden="true"></i> Request Sent').addClass('disabled');

        var regno = $(this).attr("href");
        var Regno = regno.split('/');
        var friendregno = Regno.pop();

            $.ajax({
                url: '/addfriend/'+friendregno,
                type: 'get',
                dataType: "json",
                success:function(data) {

                    if(data.status == 'success'){

                        $.notify({

                            // custom notification message
                            message: "Friend Request Sent!",

                            // 'default', 'info', 'error', 'warning', 'success'
                            status: "success",

                            // timeout in ms
                            timeout: 1000,

                            // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                            pos: 'top-center',

                            // z-index style for alert container
                            zIndex: 10400
                        });

                        /*location.reload();*/
                    }

                    if(data.status == 'error')
                    {
                        $.notify({

                            // custom notification message
                            message: "That person has already sent you request. Please reload this page to see the pending request",

                            // 'default', 'info', 'error', 'warning', 'success'
                            status: "error",

                            // timeout in ms
                            timeout: 5000,

                            // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                            pos: 'top-center',

                            // z-index style for alert container
                            zIndex: 10400
                        });
                    }
                }
            });

    });
});
$(document).ready(function() {
    $('.pendingRequestBtn li a').on('click', function (e) {
        e.preventDefault();

        if($(this).text() === 'Accept')
        {
            $(this).parent().parent().parent().children().html('<i class="fa fa-check" aria-hidden="true"></i> Request Accepted').addClass('disabled');
        }
        else
        {
            $(this).parent().parent().parent().children().html('<i class="fa fa-times" aria-hidden="true"></i> Request Rejected').addClass('disabled');
        }

        var regno = $(this).attr("href");
        var Regno = regno.split('?');
        var friendregno = Regno.pop();
        
        $.ajax({
            url: '/pendingrequest?'+friendregno,
            type: 'get',
            dataType: "json",
            success:function(data) {
                
                if(data.status == 'success'){
                    
                    $.notify({

                        // custom notification message
                        message: "Successfull",

                        // 'default', 'info', 'error', 'warning', 'success'
                        status: "success",

                        // timeout in ms
                        timeout: 1000,

                        // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                        pos: 'top-center',

                        // z-index style for alert container
                        zIndex: 10400
                    });

                }

                if(data.status == 'error'){

                    $.notify({

                        // custom notification message
                        message: "Request has already been deleted by Sender",

                        // 'default', 'info', 'error', 'warning', 'success'
                        status: "error",

                        // timeout in ms
                        timeout: 5000,

                        // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                        pos: 'top-center',

                        // z-index style for alert container
                        zIndex: 10400
                    });

                }

            }
        });
    });
});
$(document).ready(function() {
    $('.deleterequestBtn').on('click', function(e) {
        e.preventDefault();

        $(this).html('<i class="fa fa-check" aria-hidden="true"></i> Request Deleted').addClass('disabled');
        
        var regno = $(this).attr("href");
        var Regno = regno.split('/');
        var deleterequestregno = Regno.pop();

        $.ajax({
            url: '/deleterequest/'+deleterequestregno,
            type: 'get',
            dataType: "json",
            success:function(data) {

                if(data.status == 'success'){

                    $.notify({

                        // custom notification message
                        message: "Request deleted",

                        // 'default', 'info', 'error', 'warning', 'success'
                        status: "success",

                        // timeout in ms
                        timeout: 1000,

                        // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                        pos: 'top-center',

                        // z-index style for alert container
                        zIndex: 10400
                    });

                    
                }

                if(data.status == 'error')
                {
                    $.notify({

                        // custom notification message
                        message: "Something went wrong",

                        // 'default', 'info', 'error', 'warning', 'success'
                        status: "error",

                        // timeout in ms
                        timeout: 1000,

                        // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                        pos: 'top-center',

                        // z-index style for alert container
                        zIndex: 10400
                    });
                }
            }
        });
    });
});
$(document).ready(function() {
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();

        $('#registerFormSubmitBtn').attr('disabled', 'disabled');
        
        $('#register-loading-indicator').show();

        var form = $(this);
        var url = form.prop('action');
        
            $.ajax({
                url: url,
                type: "POST",
                data: form.serialize(),
                dataType: "json",
                success: function (data) {
                    
                    if(data.status == 'success') {

                        $('#register-loading-indicator').hide();

                        successHtml = '<div class="alert alert-success">Thank You! We have sent an <strong>Account Activation</strong> link to your Email</div>';
                        $('#register-form-success').html(successHtml);
                        
                    }

                },
                error: function (data) {
                    
                    $('#register-loading-indicator').hide();
                    
                        /*//process validation errors here.
                        var errors = data.responseJSON; //this will get the errors response data.
                        /!*var errors = $.parseJSON(data.responseText);*!/

                        //show them somewhere in the markup
                        //e.g
                        errorsHtml = '<div class="alert alert-danger"><ul>';

                        $.each(errors, function (key, value) {
                            errorsHtml += '<li>' + value + '</li>'; //showing errors.
                        });
                        errorsHtml += '</ul></div>';

                        //appending to a <div id="form-errors"></div> inside form
                        $('#register-form-errors').html(errorsHtml).show();*/

                    var errors = data.responseJSON;

                    $.each(errors , function (key, value) {

                        errorsHtml = '<li>' + value + '</li>';

                        $.notify({

                            // custom notification message
                            message: errorsHtml,

                            // 'default', 'info', 'error', 'warning', 'success'
                            status: "error",

                            // timeout in ms
                            timeout: 2000,

                            // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                            pos: 'top-center',

                            // z-index style for alert container
                            zIndex: 10400,

                            // Function to call on alert close
                            onClose: function() {}

                        });
                    });

                    $('#registerFormSubmitBtn').removeAttr('disabled', 'disabled');
                }
            });
    });
});
$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        $('#login-loading-indicator').show();
        var form = $(this);
        var url = form.prop('action');

        $.ajax({
            url: url,
            type: "POST",
            data: form.serialize(),
            dataType: "json",
            success: function (data) {

                if(data.status == 'success') {

                    $('#login-loading-indicator').hide();
                    
                    /*$('#login-form-success').html($successHtml).show().fadeOut(3000);*/

                    $.notify({

                        // custom notification message
                        message: "Logging In",

                        // 'default', 'info', 'error', 'warning', 'success'
                        status: "success",

                        // timeout in ms
                        timeout: 1000,

                        // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                        pos: 'top-center',

                        // z-index style for alert container
                        zIndex: 10400
                    });

                    location.href = '/home';
                }

                if(data.status == 'error') {

                    $('#login-loading-indicator').hide();
                    
                    /*$('#login-form-errors').html(errorHtml).show().fadeOut(3000);*/

                    $.notify({

                        // custom notification message
                        message: "Invalid Credentials",

                        // 'default', 'info', 'error', 'warning', 'success'
                        status: "error",

                        // timeout in ms
                        timeout: 1000,

                        // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                        pos: 'top-center',

                        // z-index style for alert container
                        zIndex: 10400
                    });
                }
            },
            error: function (data) {

                $('#login-loading-indicator').hide();

                //process validation errors here.
                var errors = data.responseJSON; //this will get the errors response data.
                /*var errors = $.parseJSON(data.responseText);*/


                $.each(errors, function (key, value) {

                    errorsHtml = '<li>' + value + '</li>';

                    $.notify({

                        // custom notification message
                        message: errorsHtml,

                        // 'default', 'info', 'error', 'warning', 'success'
                        status: "error",

                        // timeout in ms
                        timeout: 2000,

                        // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                        pos: 'top-center',

                        // z-index style for alert container
                        zIndex: 10400
                    });
                });
            }
        });
    });
});
//this script is for image upload
$(document).ready(function() {

    var avatar = $('#avatar');

        avatar.guillotine({
            width: 500,
            height: 500
        });

        avatar.guillotine('fit');

        var data = avatar.guillotine('getData');

        /*data.scale = parseFloat(data.scale.toFixed(4));*/

        $.each(data, function (key, value) {

            /*$('#' + key).html(value);*/
            $('#' + key).attr('value', value);
        });


        $('#rotate_left').click(function () {
            avatar.guillotine('rotateLeft');
        });

        $('#rotate_right').click(function () {
            avatar.guillotine('rotateRight');
        });

        $('#fit').click(function () {
            avatar.guillotine('fit');
        });

        $('#zoom_in').click(function () {
            avatar.guillotine('zoomIn');
        });

        $('#zoom_out').click(function () {
            avatar.guillotine('zoomOut');
        });


    $('#image').on('change',function () {

        avatar.guillotine('remove');
        $('#progress').removeClass('progress');

        var file = this.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {

            $('#submit').attr('disabled', 'disabled');
            $.notify({

                // custom notification message
                message: "Invalid File",

                // 'default', 'info', 'error', 'warning', 'success'
                status: "error",

                // timeout in ms
                timeout: 3000,

                // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                pos: 'top-center',

                // z-index style for alert container
                zIndex: 10400
            });
        }
        else {
            avatar.hide();
            $('#avatarLoading').show();
            $('#submit').removeAttr('disabled', 'disabled');
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }

        function imageIsLoaded(e) {
            avatar.attr('src', e.target.result);
            avatar.one('load',function () {
                avatar.guillotine('remove');
                avatar.guillotine({
                    width: 500,
                    height: 500,
                    eventOnChange: 'guillotinechange'
                });
                avatar.guillotine('fit');
            });
            $('#avatarLoading').hide();
            avatar.show();
        }
    });

    avatar.on('guillotinechange', function (ev, data, action) {

        /*data.scale = parseFloat(data.scale.toFixed(4));*/

        $.each(data, function (key, value) {

            /*$('#' + key).html(value);*/
            $('#' + key).attr('value', value);
        });
    });

    $('#avatarUploadForm').on('submit', function(e) {
        /*e.preventDefault();*/

        $('#submit').attr('disabled', 'disabled');
        $('#progress').addClass('progress');

        var fd = new FormData($('#avatarUploadForm')[0]);
        var url = $(this).attr('action');

        $.ajax({
            xhr: function(){
                var xhr = new window.XMLHttpRequest();

                xhr.upload.addEventListener("progress", function(e){

                    if(e.lengthComputable)
                    {
                        var percent = Math.round((e.loaded/e.total)*100);
                        $('#progressBar').attr('aria-valuenow',percent).css('width',percent+'%').text(percent+'%');
                    }

                });
                return xhr;
            },
            url: url,
            type: 'post',
            data: fd,
            processData: false,
            contentType: false,
            cache: false,
            success: function(){

                $.notify({

                    // custom notification message
                    message: "Please Wait.. Finishing Up",

                    // 'default', 'info', 'error', 'warning', 'success'
                    status: "success",

                    // timeout in ms
                    timeout: 2000,

                    // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                    pos: 'top-center',

                    // z-index style for alert container
                    zIndex: 10400
                });

                /*location.reload();*/
            },
            error: function(data){

                var errors = data.responseJSON;

                $.each(errors , function (key, value) {

                    errorsHtml = '<li>' + value + '</li>';

                    $.notify({

                        // custom notification message
                        message: errorsHtml,

                        // 'default', 'info', 'error', 'warning', 'success'
                        status: "error",

                        // timeout in ms
                        timeout: 2000,

                        // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                        pos: 'top-center',

                        // z-index style for alert container
                        zIndex: 10400

                    });
                });

                /*location.reload();*/
            }
        });
    });
});
$(document).ready(function() {
    $('.delete').on('click', function(e) {
        e.preventDefault();

        var img = $(this).attr("href");
        var Img = img.split('/');
        var thisImg = Img.pop();

        if(thisImg) {
            $.ajax({
                url: '/deletephotos',
                type: 'post',
                data: {
                    image: thisImg,
                    _token: $('input[name=_token]').val()
                },
                success:function(data) {

                    if(data.status == 'success'){

                        $.notify({

                            // custom notification message
                            message: "Deleting..",

                            // 'default', 'info', 'error', 'warning', 'success'
                            status: "success",

                            // timeout in ms
                            timeout: 3000,

                            // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                            pos: 'top-center',

                            // z-index style for alert container
                            zIndex: 10400
                        });
                        location.reload();
                    }

                    if(data.status == 'error')
                    {
                        $.notify({

                            // custom notification message
                            message: "File doesn't exist",

                            // 'default', 'info', 'error', 'warning', 'success'
                            status: "error",

                            // timeout in ms
                            timeout: 3000,

                            // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                            pos: 'top-center',

                            // z-index style for alert container
                            zIndex: 10400
                        });
                    }
                }
            });
        }
    });
});
$(document).ready(function() {
    $('#passwordForm').on('submit', function(e) {
        e.preventDefault();

        $('#password-loading-indicator').show();
        var form = $(this);
        var url = form.prop('action');

        $.ajax({
            url: url,
            type: "POST",
            data: form.serialize(),
            dataType: "json",
            success: function (data) {
                
                if(data.status == 'success'){

                    $('#password-loading-indicator').hide();

                    successHtml = '<div class="alert alert-success">Password sent to your Email ID</div>';
                    $('#password-form-success').html(successHtml);
                    
                }
                
                if(data.status == 'error') {

                    $('#password-loading-indicator').hide();
                    
                    /*$('#login-form-errors').html(errorHtml).show().fadeOut(3000);*/

                    $.notify({

                        // custom notification message
                        message: "Invalid Credentials",

                        // 'default', 'info', 'error', 'warning', 'success'
                        status: "error",

                        // timeout in ms
                        timeout: 1000,

                        // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                        pos: 'top-center',

                        // z-index style for alert container
                        zIndex: 10400
                    });
                }
            },
            error: function (data) {

                $('#password-loading-indicator').hide();

                //process validation errors here.
                var errors = data.responseJSON; //this will get the errors response data.
                /*var errors = $.parseJSON(data.responseText);*/


                $.each(errors, function (key, value) {

                    errorsHtml = '<li>' + value + '</li>';

                    $.notify({

                        // custom notification message
                        message: errorsHtml,

                        // 'default', 'info', 'error', 'warning', 'success'
                        status: "error",

                        // timeout in ms
                        timeout: 2000,

                        // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                        pos: 'top-center',

                        // z-index style for alert container
                        zIndex: 10400
                    });
                });
            }
        });
    });
});
$(document).ready(function() {
    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        
        $('#editFormSubmit').attr('disabled', 'disabled');

        $('#edit-loading-indicator').show();
        var form = $(this);
        var url = form.prop('action');

        $.ajax({
            url: url,
            type: "PUT",
            data: form.serialize(),
            dataType: "json",
            success: function (data) {

                if(data.status == 'success'){

                    $('#edit-loading-indicator').hide();

                    /*successHtml = '<div class="alert alert-success">Profile Updated Successfully!</div>';
                    $('#edit-form-success').html(successHtml);*/
                    $.notify({

                        // custom notification message
                        message: "Please Wait.. Updating",

                        // 'default', 'info', 'error', 'warning', 'success'
                        status: "success",

                        // timeout in ms
                        timeout: 5000,

                        // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                        pos: 'top-center',

                        // z-index style for alert container
                        zIndex: 10400
                    });
                }
                window.location.reload();
                
            },
            error: function (data) {

                $('#edit-loading-indicator').hide();

                //process validation errors here.
                var errors = data.responseJSON; //this will get the errors response data.
                /*var errors = $.parseJSON(data.responseText);*/


                $.each(errors, function (key, value) {

                    errorsHtml = '<li>' + value + '</li>';

                    $.notify({

                        // custom notification message
                        message: errorsHtml,

                        // 'default', 'info', 'error', 'warning', 'success'
                        status: "error",

                        // timeout in ms
                        timeout: 2000,

                        // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                        pos: 'top-center',

                        // z-index style for alert container
                        zIndex: 10400
                    });
                });

                $('#editFormSubmit').removeAttr('disabled', 'disabled');
            }
        });
    });
});
$(document).ready(function() {
    $('#changePasswordForm').on('submit', function(e) {
        e.preventDefault();

        $('#changePasswordSubmitBtn').attr('disabled', 'disabled');

        $('#changePassword-loading-indicator').show();
        var form = $(this);
        var url = form.prop('action');

        $.ajax({
            url: url,
            type: "PUT",
            data: form.serialize(),
            dataType: "json",
            success: function (data) {

                if(data.status == 'success'){

                    $('#changePassword-loading-indicator').hide();

                    successHtml = '<div class="alert alert-success">Password Changed Successfully!</div>';
                     $('#passwordChangeAlert').html(successHtml);

                    $("#changePasswordForm").trigger("reset");
                }

                if(data.status == 'error'){

                    $('#changePassword-loading-indicator').hide();

                    errorHtml = '<div class="alert alert-danger">Current Password is Wrong, Try Again!</div>';
                    $('#passwordChangeAlert').html(errorHtml);

                    $('#changePasswordSubmitBtn').removeAttr('disabled', 'disabled');
                }

            },
            error: function (data) {
                
                $('#changePassword-loading-indicator').hide();

                //process validation errors here.
                var errors = data.responseJSON; //this will get the errors response data.
                /*var errors = $.parseJSON(data.responseText);*/


                $.each(errors, function (key, value) {

                    errorsHtml = '<li>' + value + '</li>';

                    $.notify({

                        // custom notification message
                        message: errorsHtml,

                        // 'default', 'info', 'error', 'warning', 'success'
                        status: "error",

                        // timeout in ms
                        timeout: 3000,

                        // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                        pos: 'top-center',

                        // z-index style for alert container
                        zIndex: 10400
                    });
                });

                $('#changePasswordSubmitBtn').removeAttr('disabled', 'disabled');
            }
        });
    });
});

$(document).ready(function() {
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();

        $('#contactFormSubmitBtn').attr('disabled', 'disabled');

        $('#contactForm-loading-indicator').show();
        
        var form = $(this);
        var url = form.prop('action');

        $.ajax({
            url: url,
            type: "POST",
            data: form.serialize(),
            dataType: "json",
            success: function (data) {

                if(data.status == 'success'){

                    $('#contactForm-loading-indicator').hide();

                    successHtml = '<div class="alert alert-success">Thank You. We will be in touch.</div>';
                    $('#contactform-alert').html(successHtml);

                    $("#contactForm").trigger("reset");
                }

                if(data.status == 'error'){

                    $('#contactForm-loading-indicator').hide();

                    errorHtml = '<div class="alert alert-danger">Something went wrong. Try again later</div>';
                    $('#contactform-alert').html(errorHtml);

                    $('#contactFormSubmitBtn').removeAttr('disabled', 'disabled');
                }

            },
            error: function (data) {

                $('#contactForm-loading-indicator').hide();

                //process validation errors here.
                var errors = data.responseJSON; //this will get the errors response data.
                /*var errors = $.parseJSON(data.responseText);*/


                $.each(errors, function (key, value) {

                    errorsHtml = '<li>' + value + '</li>';

                    $.notify({

                        // custom notification message
                        message: errorsHtml,

                        // 'default', 'info', 'error', 'warning', 'success'
                        status: "error",

                        // timeout in ms
                        timeout: 3000,

                        // 'top-center','top-right', 'bottom-right', 'bottom-center', 'bottom-left'
                        pos: 'top-center',

                        // z-index style for alert container
                        zIndex: 10400
                    });
                });

                $('#contactFormSubmitBtn').removeAttr('disabled', 'disabled');
            }
        });
        
    });
});
/*
$(document).ready(function() {
    $('#search_institute').multiselect({
        enableCollapsibleOptGroups: true,
        includeSelectAllOption: true,
        maxHeight: 200,
        buttonWidth: '200px',
        inheritClass: true,
        numberDisplayed: 0,
        nonSelectedText: 'Institute',
        templates:
        {
            button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown" style="border-radius:50px"><span class="multiselect-selected-text"></span> <b class="caret"></b></button>'
        }
    });

    $('#search_programme').multiselect({
        enableCollapsibleOptGroups: true,
        includeSelectAllOption: true,
        maxHeight: 200,
        buttonWidth: '200px',
        inheritClass: true,
        numberDisplayed: 0,
        nonSelectedText: 'Programme',
        templates:
        {
            button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown" style="border-radius:50px"><span class="multiselect-selected-text"></span> <b class="caret"></b></button>'
        }
    });

    $('#search_PassOutYear').multiselect({
        enableCollapsibleOptGroups: true,
        includeSelectAllOption: true,
        maxHeight: 200,
        buttonWidth: '200px',
        inheritClass: true,
        numberDisplayed: 0,
        nonSelectedText: 'PassOut Year',
        templates:
        {
            button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown" style="border-radius:50px"><span class="multiselect-selected-text"></span> <b class="caret"></b></button>'
        }
    });

    $('#search_relationship').multiselect({
        enableCollapsibleOptGroups: true,
        includeSelectAllOption: true,
        maxHeight: 200,
        buttonWidth: '200px',
        inheritClass: true,
        numberDisplayed: 0,
        nonSelectedText: 'Relationship Status',
        templates:
        {
            button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown" style="border-radius:50px"><span class="multiselect-selected-text"></span> <b class="caret"></b></button>'
        }
    });

    $('#search_gender').multiselect({
        enableCollapsibleOptGroups: true,
        includeSelectAllOption: true,
        maxHeight: 200,
        buttonWidth: '200px',
        inheritClass: true,
        numberDisplayed: 0,
        nonSelectedText: 'Gender',
        templates:
        {
            button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown" style="border-radius:50px"><span class="multiselect-selected-text"></span> <b class="caret"></b></button>'
        }
    });

});*/
