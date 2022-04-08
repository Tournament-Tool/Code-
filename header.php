<?php

// database connection details:
require_once "credentials.php";

//start session
session_start();

// use a HEREDOC to output some HTML
// the majority of the following becomes the 'top' of the pages
// that appear on our web site

echo <<< _END
<!DOCTYPE html>
<title>Tournament Project</title>
<head class='headerBtn'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <h5 class="title">Tournament Project</h5>
    <a><button class="theme-btns" id="darkTheme" name="darkTheme" onclick="changeColour('dark')">Dark Mode</button></a>
    <a><button class="theme-btns" id="lightTheme" name="lightTheme" onclick="changeColour('light')">Light Mode</button></a>
    <h5><div id="getTime"></div></h5>
</head>
<link id='colourTheme' rel='stylesheet' href='tournament.css'>     
<script src='header.js'></script>
_END;


//sets colour theme based on user's preference (stored in a cookie)
if($_COOKIE['colourTheme']=="dark")
{
 echo "<link id='colourTheme' rel='stylesheet' href='tournament-dark.css'>";
}
else if($_COOKIE['colourTheme']=="light")
{
 echo "<link id='colourTheme' rel='stylesheet' href='tournament.css'>";
}



if (isset($_SESSION['loggedIn']))
{
    // THIS PERSON IS LOGGED IN

    if($_SESSION['username']=='admin'){
    // show the admin menu options:
        echo <<<_END
        <div class="menu-container">
            <a class='options' href=''>Home</a>
            <a class='options' href=''>About</a>
            <a class='options' href=''>Tournament</a>
            <a class='options' href=''>Login</a>
            <a class='options' href=''>Sign Out</a>
            <br><br>
        </div>
_END;
    }
    
    else{
    // show the logged in, user menu options:    
    echo <<<_END
    <div class="menu-container">
        <a class='options' href=''>Home</a>
        <a class='options' href=''>About</a>
        <a class='options' href=''>Tournament</a>
        <a class='options' href=''>Sign Out</a>
        <br><br>
    </div>
_END;
    }
}
else
{
    // THIS PERSON IS NOT LOGGED IN
    // show the logged out menu options:

    echo <<<_END
    <div class="menu-container">
        <a class='options' href=''>Home</a>
        <a class='options' href=''>About</a>
        <a class='options' href=''>Tournament</a>
        <a class='options' href=''>Login</a>
        <br><br>
    </div>
_END;
    }
echo'<body id="background" class="background">';
echo "</body></html>";
?>
