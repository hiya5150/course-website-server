<?php
//This is the announcements controller, this page will receive the input from the front end in form of post and/or parameters and if there are no errors/everything was filled out correctly then it will send the information to the announcements model, to be processed with the database, it will then return the either the data or success/failure, which will be converted to JSON and sent back to front end
class Announcements extends Controller {
    private $currentModel;
    public function __construct(){
        $this->currentModel = $this->model('teachers', 'announcement');
    }

    public function viewAnnouncements()
    {
        if (isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])) {
                $announcements = $this->currentModel->viewAnnouncements();
                if ($announcements) {
                    echo json_encode($announcements);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['success' => false, 'error' => "invalid token"]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => "undefined token"]);
        }
    }

    public function createAnnouncement()
    {
        if(isset($GLOBALS['headers']['Authorization'])){
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                    $data = [
                        'teacher_id' => $id,
                        'ann_title' => trim($_POST['annTitle']),
                        'ann_body' => trim($_POST['annBody']),
                    ];
                    if ($this->currentModel->createAnnouncement($data)) {
                        $this->viewAnnouncements();
                    } else {
                        echo json_encode(['success' => false]);
                    }
                } else{
                    echo json_encode(['error'=>'Invalid input type']);
                }
            } else {
                echo json_encode(['success' => false, 'error' => "invalid token"]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => "undefined token"]);
        }
    }

    public function deleteAnnouncement($annID)
    {
        if (isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])) {
                $data = [
                    'teacher_id' => $id,
                    'ann_id' => $annID
                ];
                if ($this->currentModel->deleteAnnouncement($data)) {
                    //this should send back deleted
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['success' => false, 'error' => "invalid token"]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => "undefined token"]);
        }
    }

    public function editAnnouncement($annID)
    {
        if (isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    $data = [
                        'teacher_id' => $id,
                        'ann_id' => $annID,
                        'ann_title' => trim($_POST['annTitle']),
                        'ann_body' => trim($_POST['annBody']),
                    ];
                    if ($this->currentModel->editAnnouncement($data)) {
                        $this->viewAnnouncements();
                    } else {
                        echo json_encode(['success' => false]);
                    }
                } else{
                    echo json_encode(['error'=>'invalid input type']);
                }
            } else {
                echo json_encode(['success' => false, 'error' => "invalid token"]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => "undefined token"]);
        }
    }
}