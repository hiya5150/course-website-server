<?php


class SignUp
{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // Register user
    public function registerTeacher($data){
        $this->db->query('INSERT INTO teachers (teacher_name, teacher_username, teacher_password) VALUES(:name, :username, :password)');
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    // Register user
    public function registerStudent($data){
        $this->db->query('INSERT INTO students (student_name, student_username, student_password) VALUES(:name, :username, :password)');
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    // Find user by email
    public function findUserByUsername($username, $type){
        switch ($type){
            case 'teacher':
                $sql = 'SELECT * FROM teachers WHERE teacher_username = :username';
                break;
            case 'student';
                $sql = 'SELECT * FROM students WHERE student_username = :username';
                break;
            default:
                $sql = '';
        }
        $this->db->query($sql);
        // Bind value
        $this->db->bind(':username', $username);
        // Check row
        $this->db->execute();
        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }
}