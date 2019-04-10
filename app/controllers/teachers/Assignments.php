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

    public function createAssignment(){
        $_POST['asnTitle']='hello';
        $_POST['asnBody'] = 'This is the trial with hardcoded posted data';
        $_POST['asnDueDate']='1/1/2019';
        $_POST['asnGrade']='39';
        $_POST['teacherID']=1;
        $data = [
            'asn_title'=> $_POST['asnTitle'],
            'asn_body'=> $_POST['asnBody'],
            'asn_due_date'=> $_POST['asnDueDate'],
            'asn_grade'=> $_POST['asnGrade'],
            'teacher_id'=>$_POST['teacherID']
        ];

        if($this->currentModel->createAssignment($data)){
            echo json_encode($data);
        }
    }


    public function deleteAssignment() {
        $data = [
            'teacher_id'=>1,
            'asn_id'=>2
        ];

        if($this->currentModel->deleteAssignment($data)){
            echo json_encode($data);
        }
    }

    public function editAssignment() {
        $data = [
            'teacher_id'=>1,
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