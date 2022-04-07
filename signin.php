<?php
include 'header.php';
include 'credentials.php';
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}
echo<<<_START
<form action="signIn.php" method="post">
Please enter a username and password<br>
Username: <input type="text" name="username" id="username">
<br>
Password: <input type="text" name="password" id="password">
<input type="submit" value="Submit" name="submit">
</form>
_START;

    if(isset($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'] ;

    if($username == ""){
        echo"Missing Username";
    }
    elseif ($password == "") {
        echo"Missing Password";
    }
    else{
    $query = "SELECT * FROM users WHERE username= '$username' AND password = '$password'";
    $result = mysqli_query($connection, $query);

    $n = mysqli_num_rows($result);

    if ($n > 0)
    {
        $_SESSION['loggedIn'] = 1;
        }
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;

        $getId = mysqli_fetch_assoc($result);

        echo "Hi, $username, you have successfully logged in<br>";

    }
}
?>
