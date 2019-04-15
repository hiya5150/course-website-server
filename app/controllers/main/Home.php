<?php
//This is the Home controller, this page will receive the input from the front end in form of post and/or parameters
// and if there are no errors/everything was filled out correctly then it will send the information to the assignments model,
// to be processed with the database, it will then return the either the data or success/failure, which will be converted to JSON and sent back to front end
class Home extends Controller
{
    private $currentModel;
    public function __construct()
    {
        $this->currentModel = $this->model('main', 'Main');
    }

    // this function returns all the announcements from the database, since anyone can see the announcements page it doesnt check for a token first
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
// every time a function is called from one of the teachers controllers it will first test this to make sure it is actually a teacher trying to use the function
    public function verifyTeacherToken()
    {
        if(isset($GLOBALS['headers']['Authorization'])) {
            if(parent::verifyTokenUserType($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR']) === 'teacher'){
                echo json_encode(true);
            }else{
                echo json_encode(false);
            }
        } else {
            echo json_encode(false);
        }
    }

    // every time a function is called from one of the students controllers it will first test this to make sure it is actually a student trying to use the function
    public function verifyStudentToken()
    {
        if(isset($GLOBALS['headers']['Authorization'])) {
            if(parent::verifyTokenUserType($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR']) === 'student'){
                echo json_encode(true);
            }else{
                echo json_encode(false);
            }
        } else {
            echo json_encode(false);
        }
    }
}