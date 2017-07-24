<div>

    <table id="schedulers_table" class="table">
        <thead>
        <tr>
            <th><span>№</span></th>
            <th><span>Title</span></th>
            <th><span>Edit</span></th>
            <th><span>Delete</span></th>
            <th><span>Make as done</span></th>
            <th><span>Date schedule</span></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($info && count($info['all'])) {
            foreach($info['all'] as $key => $detail) {
                if(!empty($detail['title'])) {
                    $makeDone = (int)$detail['is_done'] === 1 ? 'Done!' : 'Make as  done';
                    echo '<tr><td>'.++ $key .' </td>'
                      . '<td>' . UtilsController::clean($detail['title']) . '</td>'
                      . '<td> <button  type="button" class="btn btn-default pull-right myModalEdit" data-toggle="modal"
                      data-schedule_id="'.$detail['id'].'">Edit note</button> </td>'
                      . '<td><button  type="button" class="btn btn-default pull-right deleteSchedule" data-schedule_id="'.$detail['id'].'">Delete note</button></td>'
                      . '<td> <button  type="button" class="btn btn-default pull-right makeDone" data-schedule_id="'.$detail['id'].'">'.$makeDone.'</button></td>'
                      . '<td>'.date('d  F,  Y H:i', strtotime($detail['date_start']) ).'</td>'
                      .'</tr>';

                }

            }
        } ?>
        </tbody>
    </table>


    <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModalAdd">Add
        note</button>
    <div>

        <!-- Modal -->
        <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                              aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabelEdit">Edit note</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="/schedule/addSchedule/" method="post"
                              id="editSchedulerForm">
                            <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Title</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_title" name="title"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edit_body" class="col-sm-2 control-label">Description</label>
                        <textarea class="form-control" rows="5" name="body" required="required" id="edit_body">

                        </textarea>
                            </div>
                            <div class="form-group">
                                <label for="start" class="col-sm-2 control-label">Date scheduler</label>

                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="edit_date" name="date_start"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                        <input type="hidden" name="schedule_id" id="schedule_id" >
                                        <button type="submit" class="btn btn-primary" id="editSchedulerSubmit">Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="myModalAdd" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                              aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabelAdd">Add</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="/schedule/addSchedule/" method="post"
                              id="addSchedulerForm">
                            <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Title</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="add_title" name="title"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="add_body" class="col-sm-2 control-label">Description</label>
                        <textarea class="form-control" rows="5" name="body" required="required" id="add_body">

                        </textarea>
                            </div>
                            <div class="form-group">
                                <label for="start" class="col-sm-2 control-label">Date scheduler</label>

                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="add_date" name="date_start"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                        <input type="hidden" name="user_id" id="addUserId"
                                               value="<?php echo $_COOKIE['isAuthUser'] ?>">
                                        <button type="submit" class="btn btn-primary" id="addSchedulerSubmit">Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/libs/js/schedulers.js"></script>