<?php
//This is the announcements controller, this page will receive the input from the front end in form of post and/or parameters and if there are no errors/everything was filled out correctly then it will send the information to the announcements model, to be processed with the database, it will then return the either the data or success/failure, which will be converted to JSON and sent back to front end
//each function checks to make sure the user is logged in and it will check to make sure that user is allowed access to that page
class Announcements extends Controller {
    private $currentModel;
    public function __construct(){
        $this->currentModel = $this->model('teachers', 'announcement');
    }

// This function will return all announcements from all teachers
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

    // This function returns all announcements given from the teacher that is logged in
    public function viewPrivateAnnouncements()
    {
        if (isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])) {
                $data = [
                    'teacher_id' => $id
                ];
                $announcements = $this->currentModel->viewPrivateAnnouncements($data);

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

    // this function creates a new announcement it will take the title and body as post info it will then call the viewPrivateAnnouncements function to update the view
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
                        $this->viewPrivateAnnouncements();
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

    // this function will delete an announcement it will check the id to make sure that only the teacher who created the announcement can delete it and it will take the announcement id as a parameter to know which announcement should be deleted, it will then return true or false
    public function deleteAnnouncement($annID)
    {
        if (isset($GLOBALS['headers']['Authorization'])) {
            if ($id = $this->verifyToken($GLOBALS['headers']['Authorization'], $_SERVER['REMOTE_ADDR'])) {
                $data = [
                    'teacher_id' => $id,
                    'ann_id' => $annID
                ];
                if ($this->currentModel->deleteAnnouncement($data)) {
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

    //this function will update an announcement it can only be updated by the teacher who created it. it will take the announcement id as a parameter to tell the database which announcement should be updated. it will also take the title and body as post with the info of what should be updated
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