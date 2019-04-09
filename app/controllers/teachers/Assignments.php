<?php
class Assignments extends Controller {
    private  $currentModel;
    public function __construct(){
        $this->currentModel = $this->model('teachers', 'assignment');
    }
    public function index(){
    }

    public function viewAssignments(){
        $assignments = $this->currentModel->viewAssignments();

        $data = [
            'assignments'=>$assignments
        ];
        echo json_encode($data);
    }

    public function createAssignment(){
        $data = [
            'asn_title'=> 'Second Assignment',
            'asn_body'=> 'This is the second Assignment body',
            'asn_due_date'=> '1/1/2019',
            'asn_grade'=> '39',
            'teacher_id'=>1
        ];

        if($this->currentModel->createAssignment($data)){
            echo json_encode($data);
        }
    }

    public function deleteAssignment() {
        $data = [
            'asn_id'=>2
        ];

        if($this->currentModel->deleteAssignment($data)){
            echo json_encode($data);
        }
    }

    public function editAssignment() {
        $data = [
            'asn_id'=>1,
            'asn_title'=> 'edited assignment title',
            'asn_body'=>'edited assignment body',
            'asn_due_date'=>'2/2/2019',
            'asn_grade'=>'30'
        ];
        if($this->currentModel->editAssignment($data)){
            echo json_encode($data);
        }
    }
}