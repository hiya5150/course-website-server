<?php


class SignIn
{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // Login teacher
    public function loginTeacher($username, $password){
        $this->db->query('SELECT * FROM teachers WHERE teacher_username = :username');
        $this->db->bind(':username', $username);
        // tries to get info from db
        if ($row = $this->db->single()){
            $hashed_password = $row->teacher_password;
            // verifies password with encrypted pass from database
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
        $this->db->query('SELECT * FROM students WHERE student_username = :username');
        $this->db->bind(':username', $username);
        // tries to get info from db
        if ($row = $this->db->single()){
            $hashed_password = $row->student_password;
            // verifies password with encrypted pass from database
            if(password_verify($password, $hashed_password)){
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    // call this function if user successfully logged in
    // @params $id = student_id or teacher_id
    // @param $type = 'teacher' or 'student'
    // @param $ip = $_SERVER['REMOTE_ADDR'] (ip http address request came from)
    public function setToken($id, $type, $ip){
        try{
            // try creating random token else throw error
            if($token = bin2hex(random_bytes(32))){
                $this->db->query('INSERT INTO auth(token, ip, expiry, student_id, teacher_id) VALUES (:token, :ip, NOW() + INTERVAL 1 HOUR, :studentID, :teacherID)');
                $this->db->bind(':token', $token);
                $this->db->bind(':ip', $ip);
                // checks if teacher or student to assign right foreign key
                switch ($type){
                    case 'teacher':
                        $this->db->bind(':studentID', null);
                        $this->db->bind(':teacherID', $id);
                        break;
                    case 'student':
                        $this->db->bind(':studentID', $id);
                        $this->db->bind(':teacherID', null);
                }
                // inserts token with expiry and ip to database, return token on success or false on failure
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