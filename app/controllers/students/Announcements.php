<?php
class Announcements extends Controller{
    private $currentModel;
    public function __construct()
    {
        $this->currentModel = $this->model('students', 'Announcement');
    }

    public function loadAnnouncements()
    {
        $announcements = $this->currentModel->viewAnnouncements();
        if($announcements) {
            $data = [
                'announcements'=>$announcements
            ];
            echo json_encode($data);
        } else{
            echo json_encode(['success'=>false]);
        }
    }
}
