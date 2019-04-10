<?php


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
                'submission'=>$submission
            ];
            echo json_encode($data);
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
                'submission'=>$submission
            ];
            echo json_encode($data);

        }

    }
}