<?php


class SignIn
{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // Login teacher
    public function loginTeacher($username, $password){
        $this->db->query('SELECT * FROM teachers WHERE username = :username');
        $this->db->bind(':username', $username);

        if ($row = $this->db->single()){
            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)){
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Login Student
    public function loginStudent($username, $password){
        $this->db->query('SELECT * FROM students WHERE username = :username');
        $this->db->bind(':username', $username);

        if ($row = $this->db->single()){
            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)){
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function setToken($id, $type, $ip){
        try{
            if($token = random_bytes(32)){
                $this->db->query('INSERT INTO auth(token, ip, expiry, student_id, teachers_id) VALUES (:token, :ip, NOW() + INTERVAL 1 HOUR, :studentID, :teacherID)');
                $this->db->bind(':token', $token);
                $this->db->bind(':ip', $ip);
                switch ($type){
                    case 'teacher':
                        $this->db->bind(':studentID', null);
                        $this->db->bind(':teacherID', $id);
                        break;
                    case 'student':
                        $this->db->bind(':studentID', $id);
                        $this->db->bind(':teacherID', null);
                }
                if ($this->db->execute()){
                    return $token;
                }else{
                    return false;
                }
            }else{
                throw new Exception('Sorry something went wrong, Please try again!');
            }
        }catch (Exception $error){
            echo json_encode([ 'error' => $error->getMessage() ]);
        }
    }
}