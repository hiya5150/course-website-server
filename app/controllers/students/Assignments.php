<?php


class Assignments extends Controller
{
    private $currentModel;
    public function __construct()
    {
        $this->currentModel = $this->model('students', 'Assignment');
    }

    public function viewAssignment(){
        if (true) {
            $data = [
                'id' => '123',
                'assignment' => 'hello everyone'
            ];
            // sends back the json object
            echo json_encode($data);
        }
    }

    public function submitAssignment(){

    }

    public function viewAssignments(){

    }
}