
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

    public function verifyAuth($token, $ip){
        $db = new Database();

        $db->query('SELECT * FROM auth WHERE token = :token');
        $db->bind(':token', $token);
        $res = $db->single();
        // $db->rowCount();

        if($res->token === $token && $res->ip === $ip){
            $GLOBALS['id'] = $res->student_id;
            return true;
        }else{
            return false;
        }
    }
}