<?php
  class Home extends Controller
  {
      public function __construct()
      {

      }

      public function loadAnnouncements()
      {
          $data = [
            "feed" => 'my feed'
          ];
          echo json_encode($data);
      }
  }