<?php
//This is the assignments controller, this page will receive the input from the front end in form of post and/or parameters
// and if there are no errors/everything was filled out correctly then it will send the information to the assignments model,
// to be processed with the database, it will then return the either the data or success/failure, which will be converted to JSON and sent back to front end
class Announcements extends Controller{
    private $currentModel;
    public function __construct()
    {
        $this->currentModel = $this->model('students', 'Announcement');
    }
// this function returns all the announcements from the database, since anyone can see the announcements page it doesnt check for a token first
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
