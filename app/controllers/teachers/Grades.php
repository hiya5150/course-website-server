<?php
//This is the Grades/submission controller, this page will recieve the input from the front end in form of post and/or parameters and if there are no errors/everything was filled out correctly then it will send the information to the grades model, to be processed with the database, it will then return the either the data or success/failure, which will be converted to JSON and sent back to front end
class Grades extends Controller {
    private $currentModel;
    public function __construct(){
        $this->currentModel = $this->model('teachers', 'grade');
    }

    public function viewOneSubmissionOneStudent($studentID, $asnID)
    {
        if (isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])) {
                $data = [
                    'student_id' => $studentID,
                    'asn_id' => $asnID
                ];
                $submission = $this->currentModel->viewOneSubmissionOneStudent($data);
                if ($submission) {
                    $data = [
                        'submission' => $submission,
                        'success' => true
                    ];
                    echo json_encode($data);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else{
                echo json_encode(['error'=>'Invalid token']);
            }
        } else {
            echo json_encode(['error' => "undefined token"]);
        }
    }

    public function viewAllSubmissionsOneStudent($studentID)
    {
        if (isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])) {
                $data = [
                    'student_id' => $studentID
                ];
                $submission = $this->currentModel->viewAllSubmissionsOneStudent($data);
                if ($submission) {
                    $data = [
                        'submission' => $submission,
                        'success' => true
                    ];
                    echo json_encode($data);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else{
                echo json_encode(['error'=>'Invalid token']);
            }
        } else {
            echo json_encode(['error' => "undefined token"]);
        }
    }

    public function viewAllSubmissionsOneAssignment($asnID)
    {
        if (isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])) {
                $data = [
                    'asn_id' => $asnID
                ];
                $submission = $this->currentModel->viewAllSubmissionsOneAssignment($data);
                if ($submission) {
                    $data = [
                        'submission' => $submission,
                        'success' => true
                    ];
                    echo json_encode($data);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else{
                echo json_encode(['error'=>'Invalid token']);
            }
        } else {
            echo json_encode(['error' => "undefined token"]);
        }
    }

    public function editGrade($studentID, $asnID)
    {
        if (isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    $data = [
                        'teacher_id' => $id,
                        'student_id' => $studentID,
                        'asn_id' => $asnID,
                        'grade' => trim($_POST['grade']),
                        'success' => true
                    ];
                    if ($this->currentModel->editGrade($data)) {
                        echo json_encode($data);
                    } else {
                        echo json_encode(['success' => false]);
                    }
                } else {
                    echo json_encode(['error' => 'Invalid input type']);
                }
            } else{
                echo json_encode(['error'=>'Invalid token']);
            }
        } else {
            echo json_encode(['error' => "undefined token"]);
        }
    }
}