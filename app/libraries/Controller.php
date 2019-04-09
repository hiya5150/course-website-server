<?php
  /*
   * Base Controller
   * Loads the models and views
   */
  class Controller {
    // Load model
    public function model($section, $model){
      // Require model file
      require_once '../app/models/'. $section . '/' . $model . '.php';

      // Instantiate model
      return new $model();
    }
  }