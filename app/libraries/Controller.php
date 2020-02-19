<?php
//Base Controller
//Loads models and views
class Controller
{
    //Load method
    public function model($model)
    {
        // Require model file
        require_once '../app/models/' . $model . '.php';

        //Instatiate model
        return new $model();
    }

    //Load view
    public function view($views, $data = [])
    {
        // Check for view file
        if (file_exists('../app/views/' . $views . '.php')) {
            require_once '../app/views/' . $views . '.php';
        } else {
            //View does not exist
            die('View does not exist');
        }
    }
}
