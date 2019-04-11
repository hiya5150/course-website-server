<?php
//This is the assignments controller, this page will recieve the input from the front end in form of post and/or parameters and if there are no errors/everything was filled out correctly then it will send the information to the assignments model, to be processed with the database, it will then return the either the data or success/failure, which will be converted to JSON and sent back to front end

class Assignments extends Controller
{
    private $currentModel;
    public function __construct()
    {
        $this->currentModel = $this->model('students', 'Assignment');
    }


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

    public function viewAssignments()
    {
        $assignments = $this->currentModel->getAssignments();

        if ($assignments) {
            echo json_encode($assignments);
        }
        else{
            echo json_encode(['success'=>false]);
        }
    }

    public function viewOneAssignment($asnID){
        $data = [
            'asn_id'=>$asnID
        ];
        if($assignment = $this->currentModel->getOneAssignment($data)){
            echo json_encode($assignment);
        }
        else{
            echo json_encode(['success'=>false]);
        }
    }
}