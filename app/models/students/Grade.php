<?php

// This is the students/Grade model, it communicates with the database to view grade/s and submission/s in the grades table. this model is loaded in the controllers/students/Grades page(code to be able to do this located in libraries/Controller)
class Grade
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

//this function allows users to see one assignments grade
    public function getGradeByAssignment($data)
    {
        $this->db->query('SELECT grades.*, assignments.asn_title, teachers.teacher_name FROM grades INNER JOIN assignments ON assignments.asn_id = grades.asn_id INNER JOIN teachers ON teachers.teacher_id = grades.teacher_id WHERE student_id = :student_id && grades.asn_id = :asn_id');
        $this->db->bind(':student_id', $data['student_id']);
        $this->db->bind(':asn_id', $data['asn_id']);

        $result = $this->db->single();
        return $result;
    }

//this function allows the student to see all of their own grades
    public function getGradesByStudentId($data)
    {
        $this->db->query('SELECT grades.*, assignments.asn_title, teachers.teacher_name FROM grades INNER JOIN assignments ON assignments.asn_id = grades.asn_id INNER JOIN teachers ON teachers.teacher_id = grades.teacher_id WHERE student_id = :student_id');
        $this->db->bind(':student_id', $data['student_id']);

        $results = $this->db->resultSet();
        return $results;
    }
}