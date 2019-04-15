<?php
//This is the assignments controller, this page will receive the input from the front end in form of post and/or parameters
// and if there are no errors/everything was filled out correctly then it will send the information to the assignments model,
// to be processed with the database, it will then return the either the data or success/failure, which will be converted to JSON and sent back to front end
//each function checks to make sure the user is logged in and it will check to make sure that user is allowed access to that page
class Assignments extends Controller
{
    private $currentModel;
    public function __construct()
    {
        $this->currentModel = $this->model('students', 'Assignment');
    }

// this function submits the assignment and enters it into the database, it takes the teacher id and assignment id as parameters to identify which assignments submission has been added, it takes the submission text as a post submission, and will return true or false
    public function submitAssignment($teacherID, $asnID)
    {
        if(isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    $data = [
                        'teacher_id' => $teacherID,
                        'student_id' => $id,
                        'asn_id' => $asnID,
                        'submission' => trim($_POST['submission']),
                    ];
                    if ($this->currentModel->submit($data)) {
                        echo json_encode(['success' => true]);
                    } else {
                        echo json_encode(['success' => false]);
                    }
                }
            } else {
                echo json_encode(['success' => false, 'error' => "invalid token"]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => "token undefined"]);
        }
    }
// this function returns all the assignments from the database
    public function viewAssignments()
    {
        if(isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])){

                $assignments = $this->currentModel->getAssignments();

                if ($assignments) {
                    echo json_encode($assignments);
                }
                else{
                    echo json_encode(['success'=>false]);
                }
            } else {
                echo json_encode(['success' => false, 'error' => "invalid token"]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => "undefined token"]);
        }
    }
// this function returns one specific assignment selected through parameter as the assignment id
    public function viewOneAssignment($asnID){
        if(isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])){
                $data = [
                    'asn_id'=>$asnID
                ];
                if($assignment = $this->currentModel->getOneAssignment($data)){
                    echo json_encode($assignment);
                }
                else{
                    echo json_encode(['success'=>false]);
                }
            } else {
                echo json_encode(['success' => false, 'error' => "invalid token"]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => "undefined token"]);
        }
    }
}