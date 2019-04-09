<?php


class Grades extends Controller
{
    private $currentModel;
    public function __construct()
    {
        $this->currentModel = $this->model('students', 'Grade');
    }

    public function viewGrades(){

    }

    public function viewGrade(){

    }
}