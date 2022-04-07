<?php
include 'header.php';
include 'credentials.php';
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}
echo<<<START
    <form action="signup.php" method="post">
  Username: <input type="text" name="user" id="user">
  <br>
  Password: <input type="password" name="pass" id="pass">
  <br>
  First Name: <input type="text" name="firstname" id="firstname">
  <br>
  Last Name: <input type="text" name="lastname" id="lastname">
  <br>
  Email: <input type="text" name="email" id="email">
  <br>
  Date of Birth <input type="date" name="dob" id="dob"><br>
  <input type="submit" value="Submit" name="submit">
</form>
START;

if(isset($_POST['user'])){
$user = $_POST['user'];
$pass = $_POST['pass'];
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$email = $_POST['email'];
$dob = $_POST['dob'];

$query = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
$results = mysqli_query($connection, $query);

$num = mysqli_num_rows($results);
if ($num == 0)
{
    $q  = "INSERT INTO users(username, password, firstname, lastname, email, date_of_birth) VALUES('$user','$pass','$firstName','$lastName','$email','$dob')";
mysqli_query($connection, $q);
    echo "Sign up successful";

}elseif ($num > 0){
    echo "Account already exists";
}
}
?>
