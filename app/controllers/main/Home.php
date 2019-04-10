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
          echo json_encode(["error" => '404 - not found']);
      }
  }