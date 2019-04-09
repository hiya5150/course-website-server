<?php
class assignment {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function viewAssignments(){
        $this->db->query('SELECT *, teachers.teacher_name FROM assignments INNER JOIN teachers ON teachers.teacher_id = assignments.teacher_id ORDER BY asn_date_created DESC');
        $results = $this->db->resultSet();

        return $results;
    }

    public function createAssignment($data) {
        $this->db->query('INSERT INTO assignments (asn_title, asn_body, asn_due_date, asn_grade, teacher_id) VALUES (:asn_title, :asn_body, :asn_due_date, :asn_grade, :teacher_id)');
        $this->db->bind(':asn_title', $data['asn_title']);
        $this->db->bind(':asn_body', $data['asn_body']);
        $this->db->bind(':asn_due_date', $data['asn_due_date']);
        $this->db->bind(':asn_grade', $data['asn_grade']);
        $this->db->bind(':teacher_id', $data['teacher_id']);

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function deleteAssignment($data){
        $this->db->query('DELETE FROM assignments WHERE asn_id = :asn_id');
        $this->db->bind(':asn_id', $data['asn_id']);

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function editAssignment($data){
        $this->db->query('UPDATE assignments SET asn_title = :asn_title, ass_body = :asn_body, asn_date_created = current_timestamp,  asn_due_date = :asn_due_date, asn_grade = :asn_grade WHERE asn_id = :asn_id');

        $this->db->bind(':asn_title', $data['asn_title']);
        $this->db->bind(':asn_body', $data['asn_body']);
        $this->db->bind(':asn_due_date', $data['asn_due_date']);
        $this->db->bind(':asn_grade', $data['asn_grade']);
        $this->db->bind(':asn_id', $data['asn_id']);

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }
}