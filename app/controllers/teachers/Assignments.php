<?php
//This is the assignments controller, this page will recieve the input from the front end in form of post and/or parameters and if there are no errors/everything was filled out correctly then it will send the information to the aassignments model, to be processed with the database, it will then return the either the data or success/failure, which will be converted to JSON and sent back to front end
class Assignments extends Controller {
    private  $currentModel;
    public function __construct(){
        $this->currentModel = $this->model('teachers', 'assignment');
    }

    public function viewAssignments()
    {
            $assignments = $this->currentModel->viewAssignments();
            if($assignments) {
                $data = [
                    'assignments' => $assignments,
                    'success'=>true

                ];
                echo json_encode($data);
            }
            else{
                echo json_encode(['success'=>false]);
            }

    }

    public function createAssignment($teacherID){
        $data = [
            'asn_title'=> 'hello',
            'asn_body'=> 'im running out of things to write',
            'asn_due_date'=> '1/1/2019',
            'asn_grade'=> '39',
            'teacher_id'=>$teacherID,
            'success'=>true
        ];

        if($this->currentModel->createAssignment($data)){
            echo json_encode($data);
        }
        else{
            echo json_encode(['success'=>false]);
        }
    }


    public function deleteAssignment($teacherID, $asnID) {
        $data = [
            'teacher_id'=>$teacherID,
            'asn_id'=>$asnID
        ];

        if($this->currentModel->deleteAssignment($data)){
            echo json_encode(['success'=>true]);
        }
        else{
            echo json_encode(['success'=>false]);
        }
    }

    public function editAssignment($teacherID, $asnID) {
        $data = [
            'teacher_id'=>$teacherID,
            'asn_id'=>$asnID,
            'asn_title'=> 'why not',
            'asn_body'=>'im running out of things to type',
            'asn_due_date'=>'2/2/2019',
            'asn_grade'=>'30',
            'success'=>true
        ];
        if($this->currentModel->editAssignment($data)){
            echo json_encode($data);
        }
        else{
            echo json_encode(['success'=>false]);
        }
    }
}