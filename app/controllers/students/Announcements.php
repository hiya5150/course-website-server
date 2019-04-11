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
            echo json_encode($announcements);
        } else{
            echo json_encode(['success'=>false]);
        }
    }
}
