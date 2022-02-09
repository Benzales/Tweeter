<?php

include_once 'header.php';

class View {
    public function displayLogin(){
        print <<<EOF
        <div id="loginpage">    
            <form>
                <input placeholder="Username" type="text" id="username" name="login">
                <br>
                <input placeholder="Password" type="password" id="pwd" name="password">
                <br>
                <button type="submit" id="loginbutton">Login</button>
            </form>
            <form>
                <input placeholder="New Username" type="text" id="username" name="register">
                <br>
                <input placeholder="New password" type="password" id="pwd" name="pwd">
                <br>
                <button type="submit" id="loginbutton">Register</button>
            </form>
        </div>
EOF;
    }

    public function tweetSpace() {
print <<<EOF
            <form>
                <textarea placeholder="Twit here..." name=tweet id="rcorners" rows="4"></textarea>
                <br>
                <button id="rcorners" type="submit" class="btn btn-primary">Post</button>
            </form>
EOF;
    }

    public function showTweets($user, $post, $date, $follow, $fcount){
print <<<EOF
        <table>
            <thead>
                <th>@<b>$user</b> </th>
                <th>$date</th>
                <th>$follow</th>
                <th>$fcount</th>
            </thead>
            <tbody>
                <caption id="rcorners">$post</caption>
            </tbody>
        </table>
        <br>
EOF;
    }

    public function showCategory($category) {
        print "<h2>$category</h2>";
    }
}