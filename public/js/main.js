var loginObj = null;

var Login = function () {
    console.log('object create');
    var self = this;

    this.body =  {
        form: {
            submit: $('#submit_login'),
            errorMessage: $('#error-message'),
            close: $('.close'),
            registration:$('#registration')
        }
    };

    this.body.form.close.on('click', function() {
        this.body.form.errorMessage
           .css({visibility: 'hidden'});

    });

    this.body.form.submit.on('click', function (e) {
        e.preventDefault();

        var email    = $.trim($('#email').val());
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
                        self.body.form.errorMessage
                            .css('visibility', 'visible')
                            .find('h4').text(response.error);

                        self.body.form.registration.css('visibility', 'visible');
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


};


$(function () {
    loginObj = new Login();
});


