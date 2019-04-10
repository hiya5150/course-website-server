<?php


class Assignments extends Controller
{
    private $currentModel;
    public function __construct()
    {
        $this->currentModel = $this->model('students', 'Assignment');
    }


    public function submitAssignment($teacherID, $studentID, $asnID){
        $data = [
            'teacher_id'=>$teacherID,
            'student_id'=>$studentID,
            'asn_id'=>$asnID,
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

    public function viewOneAssignment($asnID){
        $data = [
            'asn_id'=>$asnID
        ];
        if($assignment = $this->currentModel->getOneAssignment($data)){
            $data = [
                'assignment'=>$assignment
            ];
            echo json_encode($data);
        }
    }
}