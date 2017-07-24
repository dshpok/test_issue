var registrationObj = null;

var Registration = function() { console.log('object create!!');
    var self = this;

    this.body = {
        button:{
            registration: $('#submitRegistration'),
            close:$('.close')
        },
        input: {
            email: $('#email'),
            password : $('#password'),
            repeat:$('#repeatPassword')

        },
        form: {
            newCustomer:$('#new_customer')
        }
    };

    this.rules = {
        'email': {
            required: true,
            validationEmail: true,
            remote: {
                url: '/auth/checkExistsUserForAjax/',
                type: 'post',
                data: {
                    email: function () {
                        return self.body.input.email.val();
                    }
                }
            }
        },
        'password': {
            required: true
        },
        repeatPassword: {
            equalTo: "#password"
        },

    };


    $.validator.addMethod('validationEmail', function (value, element) {
        return this.optional(element) || self.checkValidEmail(value);
    }, 'Please enter a valid email address');

    //$.validator.addMethod('checkDate', function (value, element) {
    //    var compareDate = (new Date($(element).val()).getFullYear() < (new Date().getFullYear() - minAge));
    //    return this.optional(element) || compareDate;
    //}, 'New user is too young!');


    //this.body.form.newCustomer.validate({
    //    ignore: [],
    //    onkeyup: false,
    //    onfocusout: function (element) {
    //        $(element).valid();
    //    },
    //    onsubmit: function (element) {
    //        console.log('SUBMIT', element);
    //        $(element).valid();
    //    },
    //    rules: self.rules,
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


    this.body.button.registration.on('click', function (e) {

        //var validator = self.body.form.newCustomer.validate();
        //var errors = validator.errors();
        //console.log('RERROR', errors, self.body.input.email.val());
        var email    = $.trim(self.body.input.email.val());
        var password = $.trim(self.body.input.password.val());
        var repeat    = $.trim(self.body.input.repeat.val());


        if(!self.checkValidEmail(email) ||
            password !== repeat) {
            return;
        }

        //e.preventDefault();
        //e.stopPropagation();
        //if(self.body.form.newCustomer.valid()) {
        //    self.body.form.newCustomer.submit();
        //}
    });

    self.body.button.close.on('click', function() {
        $(this)
            .parent()
            .css({visibility: 'hidden'});

    });

    this.checkValidEmail  = function(email) {
        var pattern = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/;
        return pattern.test(email);
    }
};
//document ready
$(function() {
    registrationObj = new Registration();
})

