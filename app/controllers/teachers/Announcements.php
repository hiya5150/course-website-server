<?php
//This is the announcements controller, this page will recieve the input and if there are no errors/everything was filled out correctly then it will send the information to the announcements model
class Announcements extends Controller {
    private $currentModel;
    public function __construct(){
        $this->currentModel = $this->model('teachers', 'announcement');
    }

    public function viewAnnouncements()
    {
        $announcements = $this->currentModel->viewAnnouncements();

        $data = [
            'announcements' => $announcements
        ];
        echo json_encode($data);
    }

    public function createAnnouncement($teacherID){
            //the data right now is dummy data, it will later be replaced with actual data submitted from the front end.
            $data = [
                'ann_title' => 'fourth Announcement',
                'ann_body' => 'This is the fourth announcement',
                'teacher_id' => $teacherID
            ];
            if ($this->currentModel->createAnnouncement($data)) {
                echo json_encode($data);

            }
    }

    public function deleteAnnouncement($teacherID, $annID) {
        $data = [
            'teacher_id'=>$teacherID,
            'ann_id' => $annID
        ];
        if($this->currentModel->deleteAnnouncement($data)){
            //this should send back deleted
            echo json_encode(['success'=>true]);
        }
        else{
            echo json_encode(['success'=>false]);
        }
    }

    public function editAnnouncement($teacherID, $annID) {
        $data = [
            'teacher_id'=>$teacherID,
            'ann_id' => $annID,
            'ann_title' => 'edited announcement',
            'ann_body' => 'this is the edited announcement'
        ];
        if($this->currentModel->editAnnouncement($data)){
            echo json_encode($data);
        }
    }



}