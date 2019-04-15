<?php
// this page has functions to allow the teacher to
// 1.view one specific grade for one specific student for one assignment
//2. view all grades for one specific student all assignments
//3. view all grades for one specific assignment all students
//it will also allow the teacher to add/edit the grade of each student

// This is the grade model, it communicates with the database to view(submissions), add, or edit grades in the assignments table. this model is loaded in the controllers/teachers/Grades page(code to be able to do this located in libraries/Controller)
class grade {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }
    //1.
    public function viewOneSubmissionOneStudent($data){
        $this->db->query('SELECT grades.*, assignments.asn_title, students.student_name  FROM grades LEFT JOIN assignments ON assignments.asn_id = grades.asn_id LEFT JOIN students ON students.student_id = grades.student_id WHERE grades.student_id = :student_id && grades.asn_id = :asn_id');
        $this->db->bind(':student_id', $data['student_id']);
        $this->db->bind(':asn_id', $data['asn_id']);


        $result = $this->db->single();
        return $result;
    }
    //2.
    public function viewAllSubmissionsOneStudent($data){
        $this->db->query('SELECT grades.*, assignments.asn_title FROM grades LEFT JOIN assignments on assignments.asn_id = grades.asn_id WHERE student_id = :student_id');
        $this->db->bind(':student_id', $data['student_id']);

        $results = $this->db->resultSet();
        return $results;
    }

    //3.
    public function viewAllSubmissionsOneAssignment($data){
        $this->db->query('SELECT grades.*, students.student_name FROM grades LEFT JOIN students on students.student_id = grades.student_id WHERE asn_id = :asn_id');
        $this->db->bind(':asn_id', $data['asn_id']);

        $results = $this->db->resultSet();

        return $results;
    }
    public function rowCount($data) {
        $this->db->query('SELECT * FROM grades WHERE asn_id = :asn_id');
        $this->db->bind(':asn_id', $data['asn_id']);

        return $this->rowCount();
    }

    public function editGrade($data){
        $this->db->query('UPDATE grades SET grade = :grade WHERE teacher_id = :teacher_id && student_id= :student_id && asn_id = :asn_id');
        $this->db->bind(':teacher_id', $data['teacher_id']);
        $this->db->bind(':student_id', $data['student_id']);
        $this->db->bind(':asn_id', $data['asn_id']);
        $this->db->bind(':grade', $data['grade']);

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }
}