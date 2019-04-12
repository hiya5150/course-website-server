<?php
class Home extends Controller
{
    private $currentModel;
    public function __construct()
    {
        $this->currentModel = $this->model('main', 'Main');
    }
    public function loadAnnouncements()
    {

        if ($announcements = $this->currentModel->viewAnnouncements()) {

            echo json_encode($announcements);
        }
        else{
            echo json_encode(['success'=>false]);
        }
    }
    // if the url api request not found this will run
    public function notFound(){
        echo json_encode(["error" => '404 - not found']);
    }

    public function verifyTeacherToken()
    {
        if(parent::verifyTokenUserType($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR']) === 'teacher'){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

    public function verifyStudentToken()
    {
        if(parent::verifyTokenUserType($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR']) === 'student'){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }
}