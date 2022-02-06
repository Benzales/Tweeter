<?php

include_once 'header.php';
include_once 'classes/controller.php';

$contr = new Controller();
$contr -> login();
$contr -> userRequest();
$contr -> renderTweets();