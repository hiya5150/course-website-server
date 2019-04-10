<?php
// This is the students/Assignment model, it communicates with the database to view an assignment/s in the assignments table and submit the students assignment in the grades table. this model is loaded in the controllers/students/Assignments page(code to be able to do this located in libraries/Controller)

class Assignment
{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function submit($data){
        $this->db->query('INSERT INTO grades (asn_id, student_id, teacher_id, submission) VALUES (:asn_id, :student_id, :teacher_id, :submission)');
        $this->db->bind(':asn_id', $data['asn_id']);
        $this->db->bind(':student_id', $data['student_id']);
        $this->db->bind(':teacher_id', $data['teacher_id']);
        $this->db->bind(':submission', $data['submission']);

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function getAssignments(){
        $this->db->query('SELECT assignments.*, teachers.teacher_name FROM assignments INNER JOIN teachers ON teachers.teacher_id = assignments.teacher_id ORDER BY asn_date_created DESC');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getOneAssignment($data) {
        $this->db->query('SELECT assignments.*, teachers.teacher_name FROM assignments INNER JOIN teachers ON teachers.teacher_id = assignments.teacher_id WHERE asn_id = :asn_id');
        $this->db->bind(':asn_id', $data['asn_id']);
        $result = $this->db->single();
        return $result;
    }
}