<?php
//This is the grades controller, this page will receive the input from the front end in form of post and/or parameters and if there are no errors/everything was filled out correctly then it will send the information to the grades model, to be processed with the database, it will then return the either the data or success/failure, which will be converted to JSON and sent back to front end
//each function checks to make sure the user is logged in and it will check to make sure that user is allowed access to that page
class Grades extends Controller
{
    private $currentModel;
    public function __construct()
    {
        $this->currentModel = $this->model('students', 'Grade');
    }
//uses getGradesByStudentId function to get all of the student who is logged in grades
    public function viewGrades(){
        if(isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])){
                $data = [
                    'student_id'=> $id
                ];
                $submission = $this->currentModel->getGradesByStudentId($data);
                if($submission){
                    echo json_encode($submission);
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
//uses getGradeByAssignment to get one specific grade for the student for one of their assignments
    public function viewGrade($asnID){
        if(isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])){
                $data = [
                    'student_id'=> $id,
                    'asn_id'=>$asnID
                ];
                $submission = $this->currentModel->getGradeByAssignment($data);
                if($submission){
                    echo json_encode($submission);
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