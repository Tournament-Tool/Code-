<?php
include ('header.php');
if (isset($_SESSION['loggedIn'])){
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}

echo<<<START
<form action="" method="post">
<select name="role">
    <option value="player">Player</option>
    <option value="coach">Coach</option>
</select>
</br><input type="submit" name="sub" value"Submit">
</form>
START;

if(isset($_POST['sub'])){
    $date = date("Y-m-d");
    $role = $_POST['role'];
    $join = $_SESSION['join'];
    $id = $_SESSION['id'];
    $query = "SELECT * FROM team_members WHERE team_id = '$join' AND user_id = '$id'";
    $result = mysqli_query($connection, $query);

    $n = mysqli_num_rows($result);

    if ($n < 1){
  $q = "INSERT INTO team_members (team_id, user_id, status, join_date) VALUES ($join, $id, 'pending', $date)";
  mysqli_query($connection, $q);
  echo "Application Sent";
}  else {
      echo"Application already sent";
  }
}
}
  require_once 'footer.php';

?>