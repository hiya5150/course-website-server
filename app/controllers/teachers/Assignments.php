<?php
//This is the assignments controller, this page will receive the input from the front end in form of post and/or parameters
// and if there are no errors/everything was filled out correctly then it will send the information to the aassignments model,
// to be processed with the database, it will then return the either the data or success/failure, which will be converted to JSON and sent back to front end
//each function checks to make sure the user is logged in and it will check to make sure that user is allowed access to that page
class Assignments extends Controller {
    private  $currentModel;
    public function __construct(){
        $this->currentModel = $this->model('teachers', 'assignment');
    }
// This function will return all assignments from all teachers
    public function viewAssignments()
    {
        if (isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])) {
                $assignments = $this->currentModel->viewAssignments();
                if ($assignments) {
                    echo json_encode($assignments);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['success' => false, 'error' => "invalid token"]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => "undefined token"]);
        }
    }
// This function returns all assignments given from the teacher that is logged in
    public function viewPrivateAssignments()
    {
        if (isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])) {
                $data = [
                    'teacher_id' => $id
                ];
                $assignments= $this->currentModel->viewPrivateAssignments($data);

                if ($assignments) {
                    echo json_encode($assignments);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['success' => false, 'error' => "invalid token"]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => "undefined token"]);
        }
    }

// This function returns one specific assignment it takes the assignment id as a parameter
    public function viewOneAssignment($asnID){
        if(isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])){
                $data = [
                    'asn_id'=>$asnID
                ];
                $assignment = $this->currentModel->viewOneAssignment($data);
                if($assignment){
                    echo json_encode($assignment);
                } else{
                    echo json_encode(['success'=>false]);
                }
            } else{
                echo json_encode(['success'=>false, 'error'=>'invalid token']);
            }
        } else{
            echo json_encode(['success'=>false, 'error'=>'undefined token']);
        }
    }
// this function creates a new assignment it will take the title, body, due date, and grade as post info it will then call the viewPrivateAssignments function to update the view
    public function createAssignment()
    {
        if (isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    $data = [
                        'teacher_id' => $id,
                        'asn_title' => trim($_POST['asnTitle']),
                        'asn_body' => trim($_POST['asnBody']),
                        'asn_due_date' => trim($_POST['asnDueDate']),
                        'asn_grade' => trim($_POST['asnGrade'])
                    ];
                    if ($this->currentModel->createAssignment($data)) {
                        $this->viewPrivateAssignments();
                    } else {
                        echo json_encode(['success' => false]);
                    }
                } else {
                    echo json_encode(['error:' => 'invalid input type']);
                }
            } else {
                echo json_encode(['success' => false, 'error' => "invalid token"]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => "undefined token"]);
        }
    }

// this function will delete an assignment it will check the id to make sure that only the teacher who created the assignment can delete it and it will take the assignment id as a parameter to know which assignment should be deleted, it will then return true or false
    public function deleteAssignment($asnID)
    {
        if (isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])) {
                $data = [
                    'teacher_id' => $id,
                    'asn_id' => $asnID
                ];
                if ($this->currentModel->deleteAssignment($data)) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['success' => false, 'error' => "invalid token"]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => "undefined token"]);
        }
    }
//this function will update an assignment it can only be updated by the teacher who created it. it will take the assignment id as a parameter to tell the database which assignment should be updated. it will also take the title, body, due date and grade as post with the info of what should be updated
    public function editAssignment($asnID)
    {
        if (isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    $data = [
                        'teacher_id' => $id,
                        'asn_id' => $asnID,
                        'asn_title' => trim($_POST['asnTitle']),
                        'asn_body' => trim($_POST['asnBody']),
                        'asn_due_date' => trim($_POST['asnDueDate']),
                        'asn_grade' => trim($_POST['asnGrade']),
                    ];
                    if ($this->currentModel->editAssignment($data)) {
                        $this->viewAssignments();
                    } else {
                        echo json_encode(['success' => false]);
                    }
                } else {
                    echo json_encode(['error' => 'invalid input type']);
                }
            } else {
                echo json_encode(['success' => false, 'error' => "invalid token"]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => "undefined token"]);
        }
    }
}