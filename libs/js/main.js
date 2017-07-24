;
( function () {

    var shedulersTable = $('#schedulers_table tbody');
    //var rules = {
    //    'new_email': {
    //        required: true,
    //        validationEmail: true,
    //        remote: {
    //            url: '/auth/checkExistsUser/',
    //            type: 'post',
    //            data: {
    //                email: function () {
    //                    return $('#email').val();
    //                }
    //            }
    //        }
    //    },
    //    'new_password': {
    //        required: true
    //    },
    //    repeatPassword: {
    //        equalTo: "#password"
    //    }
    //};
    //
    //
    //$.validator.addMethod('validationEmail', function (value, element) {
    //    return this.optional(element) || checkValidEmail(value);
    //}, 'Please enter a valid email address');
    //
    //$.validator.addMethod('checkDate', function (value, element) {
    //    var compareDate = (new Date($(element).val()).getFullYear() < (new Date().getFullYear() - minAge));
    //    return this.optional(element) || compareDate;
    //}, 'New user is too young!');
    //
    //
    //$('#new_customer').validate({
    //    ignore: [],
    //    onkeyup: false,
    //    onfocusout: function (element) {
    //        $(element).valid();
    //    },
    //    onsubmit: function (element) {
    //        $(element).valid();
    //    },
    //    rules: rules,
    //    //messages : messages,
    //    success: function (s, element) {
    //        console.log('SUCCESS', element);
    //        $(element).removeClass('error').parent().find('.help-block').remove();
    //    },
    //    errorPlacement: function (error, element) {
    //        console.log('ERROR ', error);
    //        $(element).removeClass('error').parent().find('.help-block').remove();
    //
    //        var name    = $(element).attr('name');
    //        var pattern = '/(/[\[\]])/g';
    //        name        = name.replace(pattern, '\\$1');
    //        if (typeof error[0].innerText != 'undefined' && error[0].innerText != '') {
    //            $(element)
    //                .addClass('error')
    //                .after('<span class="help-block">'
    //                + '<strong>' + error[0].innerText + '</strong></span>');
    //        }
    //    }
    //});

    $('#submit_login').on('click', function (e) {
        e.preventDefault();

        var email    = $('#email').val();
        var password = $.trim($('#password').val());


        if (email && password) {
            $.ajax({
                url: '/auth/login',
                type: 'post',
                dataType: 'json',
                data: {
                    email: email,
                    password: password
                },
                success: function (response) {
                    if (response.error) {
                        $('#error-message')
                            .css('visibility', 'visible')
                            .find('h4').text(response.error);

                        $('#registration').css('visibility', 'visible');
                    } else if (response.success) {
                        //if exists user
                        window.location = '/auth/userSchedulers';
                    }
                },
                error: function (err) {
                    console.error('ERROR LOGIN!!!', err);
                }
            });
        }
    });

    $('#myModalAdd').on('click', function() {
        $(this).modal('open');
    });


    $('#myModalEdit').on('click', function() {
        $(this).modal('open');

    });

    //$('#addSchedulerSubmit').on('click', function(e) {
    //    e.preventDefault();
    //    var formData = $('#addSchedulerForm').serializeArray();
    //    $(this).modal('open');
    //    $.ajax({
    //        url: '/schedule/updateSchedule',
    //    });
    //});


    //$('#submitRegistration').on('click', function (e) {
    //
    //
    //    var email    = $('#email').val();
    //    var password = $.trim($('#password').val());
    //    var repet    = $.trim($('#repeatPassword').val());
    //
    //
    //    if(!checkValidEmail(email) ||
    //        password !== repet) {
    //        return;
    //    }
    //});
    //
    //$('.close').on('click', function() {
    //    $(this)
    //        .parent()
    //        .css({visibility: 'hidden'});
    //
    //});
    //
    //function checkValidEmail (email) {
    //    var pattern = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/;
    //    return pattern.test(email);
    //}

})();
