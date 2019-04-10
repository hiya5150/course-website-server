<?php
//This is the grades controller, this page will recieve the input from the front end in form of post and/or parameters and if there are no errors/everything was filled out correctly then it will send the information to the grades model, to be processed with the database, it will then return the either the data or success/failure, which will be converted to JSON and sent back to front end

class Grades extends Controller
{
    private $currentModel;
    public function __construct()
    {
        $this->currentModel = $this->model('students', 'Grade');
    }
//uses getGradesByStudentId function to get all of a students grade
    public function viewGrades($studentID){
        $data = [
            'student_id'=>$studentID
        ];
        $submission = $this->currentModel->getGradesByStudentId($data);
        if($submission){
            $data = [
                'submission'=>$submission,
                'success'=>true
            ];
            echo json_encode($data);
        }
        else{
            echo json_encode(['success'=>false]);
        }

    }
//uses getGradeByAssignment to get one specific grade for the student
    public function viewGrade($studentID, $asnID){
        $data = [
            'student_id'=>$studentID,
            'asn_id'=>$asnID
        ];
        $submission = $this->currentModel->getGradeByAssignment($data);
        if($submission){
            $data = [
                'submission'=>$submission,
                'success'=>true
            ];
            echo json_encode($data);

        }
        else{
            echo json_encode(['success'=>false]);
        }

    }
}