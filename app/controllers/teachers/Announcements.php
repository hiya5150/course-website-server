<?php
//This is the announcements controller, this page will recieve the input and if there are no errors/everything was filled out correctly then it will send the information to the announcements model
class Announcements extends Controller {
    private $currentModel;
    public function __construct(){
        $this->currentModel = $this->model('teachers', 'announcement');
    }
    public function index(){
    }

    public function viewAnnouncements(){
        $announcements = $this->currentModel->viewAnnouncements();

        $data = [
            'announcements' => $announcements
        ];
        echo json_encode($data);
    }

    public function createAnnouncement(){
            //the data right now is dummy data, it will later be replaced with actual data submitted from the front end.
            $data = [
                'ann_title' => 'third Announcement',
                'ann_body' => 'This is the third announcement',
                'teacher_id' => 1
            ];
            if ($this->currentModel->createAnnouncement($data)) {
                echo json_encode($data);
            }
    }

    public function deleteAnnouncement() {
        $data = [
            'ann_id' => 1
        ];
        if($this->currentModel->deleteAnnouncement($data)){
            echo json_encode($data);
        }
    }

    public function editAnnouncement() {
        $data = [
            'ann_id' => 1,
            'ann_title' => 'edited announcement',
            'ann_body' => 'this is the edited announcement'
        ];
        if($this->currentModel->editAnnouncement($data)){
            echo json_encode($data);
        }
    }



}