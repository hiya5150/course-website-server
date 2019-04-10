<?php
class Grades extends Controller {
    private $currentModel;
    public function __construct(){
        $this->currentModel = $this->model('teachers', 'grade');
    }

    public function viewOneSubmissionOneStudent(){
        $data = [
            'student_id'=>1,
            'asn_id'=>1
        ];
        $submission = $this->currentModel->viewOneSubmissionOneStudent($data);
        if($submission){
            $data = [
                'submission' => $submission
            ];
            echo json_encode($data);
        }
    }

    public function viewAllSubmissionsOneStudent(){
        $data = [
            'student_id'=>2
        ];
        $submission = $this->currentModel->viewAllSubmissionsOneStudent($data);
        if($submission){
            $data = [
                'submission'=> $submission
            ];
            echo json_encode($data);
        }
    }

    public function viewAllSubmissionsOneAssignment(){
        $data = [
            'asn_id'=>1
        ];
        $submission = $this->currentModel->viewAllSubmissionsOneAssignment($data);
        if($submission){
            $data = [
                'submission'=>$submission
            ];
            echo json_encode($data);
        }
    }

    public function editGrade(){
        $data = [
            'teacher_id'=>1,
            'student_id'=>1,
            'asn_id'=>1,
            'grade'=> 38
        ];
        if($this->currentModel->editGrade($data)){
            echo json_encode($data);
        }
    }
}