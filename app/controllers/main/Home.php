<?php
  class Home extends Controller
  {
      private $currentModel;
      public function __construct()
      {
          $this->currentModel = $this->model('main', 'Main');
      }

      public function loadAnnouncements()
      {
          $announcements = $this->currentModel->viewAnnouncements();
          if ($announcements) {
              echo json_encode($announcements);
          }
          else{
              echo json_encode(['success'=>false]);
          }
      }
      // if the url api request not found this will run
      public function notFound(){
          echo json_encode(["error" => '404 - not found']);
      }
  }