<?php


class ScheduleController extends BaseController {




    public function getSchedule() {

        if(!AuthController::isAuth()) {
            header('location:/auth/getLoginForm/');
            exit;
        }
        if(empty($_GET['id'])) {
            return;
        }

        $id = $_GET['id'];
        $userId = $_COOKIE['isAuthUser'];
        $info = OrganizerModel::getOneSchedule($id, $userId);

        $info = array_map('UtilsController::clean',$info[0]);
        echo json_encode($info);
    }


    public function deleteSchedule() {
        if(empty($_GET['id'])) {
            return;
        }
        if(!AuthController::isAuth()) {
            header('location:/auth/getLoginForm/');
            exit;
        }


        $id = $_GET['id'];
        $userId = $_COOKIE['isAuthUser'];
        $res = OrganizerModel::deleteSchedule($id, $userId);

        echo json_encode($res);
    }


    public function makeAsDone() {
        if(!AuthController::isAuth()) {
            header('location:/auth/getLoginForm/');
            exit;
        }
        if(empty($_GET['id'])) {
            return false;
        }


        $id = $_GET['id'];
        $userId = $_COOKIE['isAuthUser'];
        $res = OrganizerModel::makeAsDoneSchedule($id, $userId);

        echo json_encode($res);
    }

    public function updateSchedule() {

        if(!AuthController::isAuth()) {
            header('location:/auth/getLoginForm/');
            exit;
        }
        if ( empty($_POST['date_start'])
          || empty($_POST['title'])
          || empty($_POST['body'])
          || empty($_POST['id'])
            || strtotime( $_POST['date_start'] < date('Y-m-d H:i:s') )
        ) {
            return false;
        }

        $res = OrganizerModel::updateSchedule($_POST);
        if($res) {
            $userId = $_COOKIE['isAuthUser'];
            $allUsersSchedulers = OrganizerModel::getAllUserSchedule($userId);

            $content = $this->_prepareAllSchedulers($allUsersSchedulers);
            echo $content;
        }
    }




    public function addSchedule() {

        if(!AuthController::isAuth()) {
            header('location:/auth/getLoginForm/');
            exit;
        }

        if (empty($_POST['date_start'])
          || empty($_POST['title'])
          || empty($_POST['body'])
          || strtotime($_POST['date_start'] > date('Y-m-d H:i:s'))
        ) {
            return false;
        }

        $res   = OrganizerModel::addSchedule($_POST);
        if($res) {

            $allUsersSchedulers = OrganizerModel::getAllUserSchedule($_POST['user_id']);

            $content = $this->_prepareAllSchedulers($allUsersSchedulers);
            echo $content;
        }
    }


    private function _prepareAllSchedulers($schedulers) {
        $items = '';
        if(count($schedulers) > 0) {
            foreach($schedulers as $key => $one) {
                $disabled = (int) $one['is_done'] === 1 ? 'disabled' : '';
                $makeDone = (int) $one['is_done'] === 1 ? 'Done!' : 'Make as  done';
                $items .= '<tr><td>' . ++$key . ' </td>'
                  . '<td>' . UtilsController::clean($one['title']) . '</td>'
                  . '<td> <button  type="button" class="btn btn-default pull-right myModalEdit" data-toggle="modal"
                   data-target="#myModal" data-schedule_id="' . $one['id'] . '" >Edit note</a></button> </td>'
                  . '<td><button  type="button" class="btn btn-default pull-right deleteSchedule" data-schedule_id="'
                  . $one['id'] . '">Delete note</button></td>'
                  . '<td> <button  type="button" class="btn btn-default pull-right makeDone" data-schedule_id="'
                  . $one['id'] . '">' . $makeDone . '</button></td>'
                  . '<td>'.date('d  F,  Y H:i', strtotime($one['date_start']) ).'</td>'
                  . '</tr>';
            }
        }

        return $items;
    }
}