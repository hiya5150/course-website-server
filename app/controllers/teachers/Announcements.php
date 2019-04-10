<?php
//This is the announcements controller, this page will recieve the input from the front end in form of post and/or parameters and if there are no errors/everything was filled out correctly then it will send the information to the announcements model, to be processed with the database, it will then return the either the data or success/failure, which will be converted to JSON and sent back to front end
class Announcements extends Controller {
    private $currentModel;
    public function __construct(){
        $this->currentModel = $this->model('teachers', 'announcement');
    }

    public function viewAnnouncements()
    {
        $announcements = $this->currentModel->viewAnnouncements();
        if ($announcements) {
            $data = [
                'announcements' => $announcements,
                'success'=>true
            ];
            echo json_encode($data);
        }
        else{
            echo json_encode(['success'=>false]);
        }
    }

    public function createAnnouncement($teacherID){
            //the data right now is dummy data, it will later be replaced with actual data submitted from the front end.
            $data = [
                'ann_title' => 'fourth Announcement',
                'ann_body' => 'This is the fourth announcement',
                'teacher_id' => $teacherID,
                'success'=>true
            ];
            if ($this->currentModel->createAnnouncement($data)) {
                echo json_encode($data);
            }
            else{
                echo json_encode(['success'=>false]);
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
            'ann_body' => 'this is the edited announcement',
            'success'=>true
        ];
        if($this->currentModel->editAnnouncement($data)){
            echo json_encode($data);
        }
        else{
            echo json_encode(['success'=>false]);
        }
    }



}