<?php
class Grades extends Controller {
    public $currentModel;
    public function __construct(){
        $this->currentModel = $this->model('teachers/grade');
    }

    public function viewOneSubmissionOneStudent(){
        $data = [
            'asn_id'=>1,
            'student_id'=>1
        ];
        if($this->currentModel->viewOneSubmissionOneStudent($data)){

        }
    }
}