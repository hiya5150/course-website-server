<?php
    // sets return type in header
    header('Content-type: application/json');
    // gets an associative array of all headers in the http request
    $GLOBALS['headers'] = apache_request_headers();
    // includes all required libraries for the api
    require_once '../app/bootstrap.php';
    // Init Core Library
    $init = new Core;
    // un sets global vars
    unset($GLOBALS);