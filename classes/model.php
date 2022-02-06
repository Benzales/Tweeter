<?php

include_once 'header.php';
include_once "classes/view.php";

class Model  {
    
    private $conn;
    private $view;

    public function query($query){
        return mysql_query($query, $this -> conn);
    }

    public function getSingle($query) {
        $result = $this -> query($query);
        $row = mysql_fetch_row($result);
        return $row[0];
    }

    public function __construct(){
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'tweeter';
        $this -> conn = mysql_connect($dbhost, $dbuser, $dbpass);
        mysql_select_db($dbname, $this -> conn);
        $this -> view = new View();
    }

    public function eventHandler() {
        $username = $_SESSION['username'];
        if($_REQUEST['follow']){
            $follow = mysql_real_escape_string($_REQUEST['follow']);
            $this -> query("INSERT IGNORE INTO follows(following, follower) VALUES('$follow', '$username')");
        }
        if($_REQUEST['unfollow']){
            $unfollow = mysql_real_escape_string($_REQUEST['unfollow']);
            $this -> query("DELETE FROM follows WHERE following = '$unfollow' AND follower = '$username'");
        }
        if($_REQUEST['tweet']){
            $tweet = mysql_real_escape_string($_REQUEST['tweet']);  
            $date = Date("Y-m-d h:i:s");
            print $username;
            $this -> query("insert into tweets (username, tweet, date) values('$username', '".$tweet."', '".$date."')");
        }
        if($_REQUEST['register']){
            $new_user = mysql_real_escape_string($_REQUEST['register']);
            $password = mysql_real_escape_string($_REQUEST['pwd']);
            $this -> query("insert into users (username, password) values('$new_user', '$password')");
            print "You have been registered. Now go login.";
        }
        if($_REQUEST['login']){
            $username = mysql_real_escape_string($_REQUEST['login']);
            $password = mysql_real_escape_string($_REQUEST['password']);
            $valid = $this -> getSingle("select username from users where username = '".$username."' and password = '".$password."'");
            if($valid != $username){
                print "Wrong username and/or password";
            }
            else{
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                header("Location: http://tweeterclone.xyz/index.php");
                exit();
            }
        }
    }

    public function accessTweets(){
        $username = $_SESSION['username'];
        $following = "SELECT * FROM tweets WHERE username IN (SELECT following FROM follows WHERE follower = '".$username."') ORDER BY DATE DESC";
        $notFollowing = "SELECT * FROM tweets ORDER BY DATE DESC";
        $this -> accessData($following, "My Feed");
        $this -> accessData($notFollowing, "Explore");
    }

    public function accessData($query, $category){
        $this -> view -> showCategory($category);
        $result = $this -> query($query);
        while($row = mysql_fetch_assoc($result)) {
            $user = $row['username'];
            $post = htmlspecialchars($row['tweet']);
            $date = $row['date'];
            $follow = $this -> loadFollow($user);
            $this -> view -> showTweets($user, $post, $date, $follow);
        }
        $this -> view -> tableBorder();
    }

    public function loadFollow($user){
        $username = $_SESSION['username'];
        if($this -> getSingle("SELECT following FROM follows WHERE follower='$username' AND following='$user'")){
            return "<a href=index.php?unfollow=$user>Unfollow</a>";
        }
        else{ 
            return "<a href=index.php?follow=$user>Follow</a>";
        }
    }
}