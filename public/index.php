<?php
  require_once '../app/bootstrap.php';
  $data = [];
  // Init Core Library
  $init = new Core;
  // sets return type in header
  header('Content-type: application/json');
  // sends back the json object
  echo json_encode($data);