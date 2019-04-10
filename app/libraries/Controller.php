<?php
/*
 * Base Controller
 * Loads the models and views
 */
class Controller {
    // Load model
    public function model($section, $model){
        // Require model file
        require_once '../app/models/'. $section . '/' . $model . '.php';
        // Instantiate model
        return new $model();
    }

    public function verifyToken($token, $ip){
        $db = new Database();

        $db->query('SELECT * FROM auth WHERE token = :token AND expiry > now()');
        $db->bind(':token', $token);

        if ($res = $db->single()){
            if($res->token === $token && $res->ip === $ip){
                return ($res->student_id !== null) ? $res->student_id : $res->teachers_id;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

}