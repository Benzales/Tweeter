<?php

include_once 'header.php';
include_once 'classes/model.php';
include_once 'classes/view.php';

class Controller {

    private $model;
    private $view;
    private $username;
    private $password;

    public function __construct(){
        $this -> model = new Model();
        $this -> view = new View();
    }

    public function login(){
        if(!isset($_SESSION['username'])){
            $this -> view -> displayLogin();
        }
    }

    public function userRequest(){
        $this -> model -> eventHandler();
    }

    public function renderTweets(){
        if(isset($_SESSION['username'])){
            $this -> view -> tweetSpace();
            $this -> model -> accessTweets();
        }
    }
}