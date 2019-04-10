<?php


class Assignments extends Controller
{
    private $currentModel;
    public function __construct()
    {
        $this->currentModel = $this->model('students', 'Assignment');
    }


    public function submitAssignment(){
        $data = [
            'teacher_id'=>1,
            'student_id'=>1,
            'asn_id'=>1,
            'submission'=>'this is my submission for my assignment'
        ];

        if($this->currentModel->submit($data)){
            echo json_encode($data);
        }
    }

    public function viewAssignments(){
        $assignments = $this->currentModel->getAssignments();

        $data = [
            'assignments'=>$assignments
        ];
        echo json_encode($data);
    }

    public function viewOneAssignment(){
        $data = [
            'asn_id'=>1
        ];
        if($assignment = $this->currentModel->getOneAssignment($data)){
            $data = [
                'assignment'=>$assignment
            ];
            echo json_encode($data);
        }
    }
}