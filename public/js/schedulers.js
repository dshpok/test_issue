var schedulerOqj = null;
var Scheduler = function() {

    var self = this;
    this.body= {
        tableBody:$('#schedulers_table tbody'),
        modal:{
            add: {
               modal:$('#myModalAdd'),
               form: $('#addSchedulerForm'),
                input:{
                    date:$('#add_date'),
                    title: $('#add_title'),
                    body: $('#add_body'),
                    userId: $('#addUserId'),
                },
                button: $('#addSchedulerSubmit')
            },
            edit: {

                modal:$('#myModalEdit'),
                form:$('#editSchedulerForm'),
                input: {
                    date:$('#edit_date'),
                    title: $('#edit_title'),
                    body: $('#edit_body'),
                    scheduleId: $('#schedule_id'),
                },
                button : $('#editSchedulerSubmit')
            },
            button: {
                delete: $('.deleteSchedule'),
                makeDone: $('.makeDone'),

            }

        },
    };

    //add schedule
    this.body.modal.add.button.on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var title = $.trim(self.body.modal.add.input.title.val());
        var body = $.trim(self.body.modal.add.input.body.val());
        var userId = self.body.modal.add.input.userId.val();
        var addDate = self.body.modal.add.input.date.val();

        if(title && body
            && ( new Date(addDate).getTime() >= (new Date().getTime() ) )
        ) {

            $.ajax({
                url: '/schedule/addSchedule',
                type: 'post',
                dataType: 'text',
                data: {
                    title:title,
                    body: body,
                    user_id: userId,
                    date_start: addDate
                },
                success: function (response) {

                    self.body.tableBody.html(response);
                    self.body.modal.add.form[0].reset();
                    self.body.modal.add.modal.modal('hide');

                },
                error: function (err) {
                    console.error('ERROR LOGIN!!!', err);
                }
            });
        }

    });


    //update schedule
    this.body.modal.edit.button.on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var title = $.trim(self.body.modal.edit.input.title.val());
        var body = $.trim(self.body.modal.edit.input.body.val());
        var scheduleId = self.body.modal.edit.input.scheduleId.val();
        var addDate = self.body.modal.edit.input.date.val();

        if(title && body
            && ( new Date(addDate).getDate() >= (new Date().getDate() ) )
        ) {

            $.ajax({
                url: '/schedule/updateSchedule',
                type: 'post',
                dataType: 'text',
                data: {
                    title:title,
                    body: body,
                    id: scheduleId,
                    date_start: addDate
                },
                success: function (response) {

                    self.body.tableBody.html(response);
                    self.body.modal.edit.form[0].reset();
                    self.body.modal.edit.modal.modal('hide');

                },
                error: function (err) {
                    console.error('ERROR LOGIN!!!', err);
                }
            });
        }

    });

    //edit schedule
    this.body.tableBody.on('click', '.myModalEdit', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var scheduleId = $(this).attr('data-schedule_id');

            $.ajax({
                url: '/schedule/getSchedule',
                type: 'get',
                dataType: 'json',
                data: {
                   id: scheduleId
                },
                success: function (res) {
                    if(res) {
                        var dateOld = new Date(res.date_start);

                        //var dateSchedule = dateOld.getFullYear() + '-' + ("0" + (dateOld.getMonth() + 1)).slice(-2)
                        //    + '-'  + dateOld.getDate() + ' ' + dateOld.getHours() + ':' + dateOld.getMinutes();

                        var dateSchedule = new Date( dateOld.getTime() -  (dateOld.getTimezoneOffset() * 60000) ).toJSON().slice(0,16);


                        self.body.modal.edit.input.title.val(res.title);
                        self.body.modal.edit.input.body.val(res.body);
                        self.body.modal.edit.input.date.val(dateSchedule);
                        self.body.modal.edit.input.scheduleId.val(scheduleId);
                        self.body.modal.edit.modal.modal('show');
                    } else {
                        console.error('ERROR GETTING SCHEDULER', res);
                    }

                },
                error: function (err) {
                    console.error('ERROR GET SCHEDULER!!!', err);
                }
            });
    });


    //delete schedule
    this.body.tableBody.on('click', '.deleteSchedule', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var scheduleId = $(this).attr('data-schedule_id');
        var button = $(this);

        var parentTr = button.parents('tr');


            $.ajax({
                url: '/schedule/deleteSchedule',
                type: 'get',
                dataType: 'json',
                data: {
                   id: scheduleId
                },
                success: function (res) {

                    var parentTr = button.parents('tr');

                    parentTr.remove();
                },
                error: function (err) {
                    console.error('ERROR DELETE SCHEDULER!!!', err);
                }
            });
    });

     //make as done schedule
    this.body.tableBody.on('click', '.makeDone', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var button = $(this);
        var scheduleId = $(this).attr('data-schedule_id');

            $.ajax({
                url: '/schedule/makeAsDone',
                type: 'get',
                dataType: 'json',
                data: {
                   id: scheduleId
                },
                success: function (res) {
                    button.text('Done!');
                },
                error: function (err) {
                    console.error('ERROR DELETE SCHEDULER!!!', err);
                }
            });
    });


};

$(function() {
    schedulerOqj = new Scheduler();


    schedulerOqj.body.modal.add.input.date.prop('min',function(){

        var date = new Date();
        return  new Date(date.getTime() - (date.getTimezoneOffset() * 60000)).toJSON().slice(0,16);
    } );
});
