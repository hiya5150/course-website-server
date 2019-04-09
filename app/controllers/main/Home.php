<?php
  class Home extends Controller
  {
      public function __construct()
      {

      }

      public function loadAnnouncements()
      {

      }
      public function notFound(){
          $data = [
              "error" => '404 - not found'
          ];
          echo json_encode($data);
      }
  }