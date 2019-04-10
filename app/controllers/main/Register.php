<?php


class Register extends Controller
{
    private $currentModel;
    public function __construct()
    {
        $this->currentModel = $this->model('main', 'SignUp');
    }
    // register new teacher
    public function teacherRegister(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'username' => trim($_POST['username']),
                'password' => password_hash(trim($_POST['password']), PASSWORD_DEFAULT)
            ];
            // checks if username exists, has to be unique
            if (!$this->currentModel->findUserByUsername($data['username'], 'teacher')){
                // registers to database, returns true on success or false on failure
                if ($this->currentModel->registerTeacher($data)) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['error' => 'username taken']);
            }
        }
    }
    // register new student
    public function studentRegister(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'username' => trim($_POST['username']),
                'password' => password_hash(trim($_POST['password']), PASSWORD_DEFAULT)
            ];
            // checks if username exists, has to be unique
            if (!$this->currentModel->findUserByUsername($data['username'], 'student')){
                // registers to database, returns true on success or false on failure
                if ($this->currentModel->registerStudent($data)) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['error' => 'username taken']);
            }
        }
    }
}