<?php
class Grades extends Controller {
    private $currentModel;
    public function __construct(){
        $this->currentModel = $this->model('teachers', 'grade');
    }

    public function viewOneSubmissionOneStudent($studentID, $asnID){
        $data = [
            'student_id'=>$studentID,
            'asn_id'=>$asnID
        ];
        $submission = $this->currentModel->viewOneSubmissionOneStudent($data);
        if($submission){
            $data = [
                'submission' => $submission
            ];
            echo json_encode($data);
        }
    }

    public function viewAllSubmissionsOneStudent($studentID){
        $data = [
            'student_id'=>$studentID
        ];
        $submission = $this->currentModel->viewAllSubmissionsOneStudent($data);
        if($submission){
            $data = [
                'submission'=> $submission
            ];
            echo json_encode($data);
        }
    }

    public function viewAllSubmissionsOneAssignment($asnID){
        $data = [
            'asn_id'=>$asnID
        ];
        $submission = $this->currentModel->viewAllSubmissionsOneAssignment($data);
        if($submission){
            $data = [
                'submission'=>$submission
            ];
            echo json_encode($data);
        }
    }

    public function editGrade($teacherID, $studentID, $asnID){
        $data = [
            'teacher_id'=>$teacherID,
            'student_id'=>$studentID,
            'asn_id'=>$asnID,
            'grade'=> 38
        ];
        if($this->currentModel->editGrade($data)){
            echo json_encode($data);
        }
    }
}