<?php
  class Home extends Controller
  {
      public function __construct()
      {

      }

      public function loadAnnouncements()
      {

      }
      // if the url api request not found this will run
      public function notFound(){
          echo json_encode(["error" => '404 - not found']);
      }
  }