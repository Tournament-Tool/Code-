<?php
include ('header.php');
if (isset($_SESSION['loggedIn'])){
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}
$idd = $_SESSION['id'];
$query = "SELECT user_id, users.username ,role, status, join_date FROM team_members INNER JOIN teams ON team_members.team_id = teams.id INNER JOIN users ON users.id = team_members.user_id WHERE status = 'Pending' AND teams.creator_id = {$idd}";
$result = mysqli_query($connection, $query);

$n = mysqli_num_rows($result);

    if ($n > 0){
      for($i = 0; $i < $n; $i++){
        $row = mysqli_fetch_assoc($result);
        echo <<<_END
        <body>
        <table class="ms-5 mt-5">
        <tr><td>{$row['user_id']}</td></tr>
        <tr><td>{$row['username']}</td></tr>
        <tr><td>{$row['role']}</td></tr>
        <tr><td>{$row['status']}</td></tr>
        <tr><td>{$row['join_date']}</td></tr>
        <form action="application.php" method="post">
        <tr><td><button class="btn btn-secondary" id="table_btn" type=submit name="approve" value="{$row['user_id']}">Approve</button></td></tr>
        <tr><td><button class="btn btn-secondary" id="table_btn" type=submit name="deny">Deny</button></td></tr>
        </form>
      _END;
      }
}


if(isset($_POST["approve"])){
  $ap = $_POST['approve'];
  $query = "UPDATE team_members SET status = 'Approved' WHERE user_id = '$ap'";
  $result = mysqli_query($connection, $query);

  if($result){
    echo"Approved";
  }
}

}
  require_once 'footer.php';
  
// "UPDATE team_members SET status = 'Approved' FROM team_members INNER JOIN teams ON teams.creator_id = '$idd' WHERE user_id = '$ap'";
?>
