<?php

include_once 'header.php';

class View {
    public function displayLogin(){
        print <<<EOF
        <div>    
            <form>
                <input placeholder="Username" type="text" id="username" name="login"><br>
                <input placeholder="Password" type="password" id="pwd" name="password">
                <div></div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
        <div>
            <form>
                <input placeholder="New Username" type="text" id="username" name="register"><br>
                <input placeholder="New password" type="password" id="pwd" name="pwd">
                <div></div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
EOF;
    }

    public function tweetSpace() {
print <<<EOF
            <form>
                <textarea placeholder="Enter your text here..." style="background-color:#D3D3D3" name=tweet class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                <button type="submit" class="btn btn-primary">Post</button>
            </form>
EOF;
    }

    public function showTweets($user, $post, $date, $follow){
print <<<EOF
        <table border=1>
            <thead>
                <th style="color:#1DA1F2"> @<b>$user</b> </th>
                <th>$date</th>
                <th>$follow</th>
            </thead>
            
            <tbody>
                <caption>$post</caption>
            </tbody>
        </table>
EOF;
    }

    public function showCategory($category) {
        print "<h2>$category</h2>";
        print "<table border=1>";
    }

    public function tableBorder(){
        print "</table>";
    }
}