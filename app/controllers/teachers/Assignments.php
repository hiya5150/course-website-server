<?php
class Assignments extends Controller {
    private  $currentModel;
    public function __construct(){
        $this->currentModel = $this->model('teachers', 'assignment');
    }

    public function viewAssignments()
    {
            $assignments = $this->currentModel->viewAssignments();

            $data = [
                'assignments' => $assignments

            ];
            echo json_encode($data);

    }

    public function createAssignment($teacherID){
        $data = [
            'asn_title'=> 'hello',
            'asn_body'=> 'im running out of things to write',
            'asn_due_date'=> '1/1/2019',
            'asn_grade'=> '39',
            'teacher_id'=>$teacherID
        ];

        if($this->currentModel->createAssignment($data)){
            echo json_encode($data);
        }
    }


    public function deleteAssignment($teacherID, $asnID) {
        $data = [
            'teacher_id'=>$teacherID,
            'asn_id'=>$asnID
        ];

        if($this->currentModel->deleteAssignment($data)){
            echo json_encode($data);
        }
    }

    public function editAssignment($teacherID, $asnID) {
        $data = [
            'teacher_id'=>$teacherID,
            'asn_id'=>$asnID,
            'asn_title'=> 'why not',
            'asn_body'=>'im running out of things to type',
            'asn_due_date'=>'2/2/2019',
            'asn_grade'=>'30'
        ];
        if($this->currentModel->editAssignment($data)){
            echo json_encode($data);
        }
    }
}