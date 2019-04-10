<?php


class Login extends Controller
{
    private $currentModel;
    public function __construct()
    {
        $this->currentModel = $this->model('main', 'SignIn');
    }

    public function teacherLogin(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
              'username' => trim($_POST['username']),
              'password' => trim($_POST['password'])
            ];

            if ($user = $this->currentModel->loginTeacher($data['username'], $data['password'])){
                if($token = $this->currentModel->setToken($user->teacher_id, 'teacher', $_SERVER['REMOTE_ADDR'])){
                    echo json_encode(['token' => $token]);
                } else {
                    echo json_encode(['error' => "login failed"]);
                }
            } else {
                echo json_encode(['error' => "login failed"]);
            }
        }else{
            echo json_encode(['error' => "denied"]);
        }
    }

    public function studentLogin(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password'])
            ];

            if ($user = $this->currentModel->loginTeacher($data['username'], $data['password'])){
                if($token = $this->currentModel->setToken($user->student_id, 'student', $_SERVER['REMOTE_ADDR'])){
                    echo json_encode(['token' => $token]);
                } else {
                    echo json_encode(['error' => "login failed"]);
                }
            } else {
                echo json_encode(['error' => "login failed"]);
            }
        }else{
            echo json_encode(['error' => "denied"]);
        }
    }
}