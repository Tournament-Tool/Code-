<?php
include 'header.php';
include 'credentials.php';
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}
echo<<<START
    <form action="createTournament.php" method="post">
  Title: <input type="text" name="title" id="tite">
  <br>
    <Label>Tournament type</label>
  <select name="format_options" id="format_options">
    <option>Select tournament type </option>
    <option value"single_elimination">Signle Elimination</option>
    <option value"double_elimination">Double Elimination</option>
    <option value"round_robin">Round Robin</option>
  </select>
  <br>
  Image: <input type="image" name="image" id="image">
  <br>
  Number of teams: <input type="number_of_teams" name="number_of_teams" id="number_of_teams">
  <br>
  players_in_team: <input type="players_in_team" name="players_in_team" id="players_in_team">
  <br>
  prize<input type="prize_pool" name="prize_pool" id="prize_pool"><br>
  <input type="submit" value="Submit" name="submit">
</form>
START;

if(isset($_POST['user'])){
$id = $_POST['id'];
$title = $_POST['title'];
$creation_date = $_POST['creation_date'];
$format = $_POST['format'];
$bracket_image = $_POST['bracket_image'];
$number_of_teams = $_POST['number_of_teams'];
$players_in_team = $_POST['players_in_team'];
$prize_pool = $_POST['prize_pool'];
$game_id = $_POST['game_id'];
$organisation_id = $_POST['organisation_id'];
$creator_id = $_POST['creator_id'];

$x = ;
while ($x <= 32) {
    echo "The number is: $x <br>";
    $x +2;
}


$query = "INSERT INTO `tournaments` (`id`, `title`, `creation_date`, `format`, `bracket_image`, `number_of_teams`, `players_in_team`, `prize_pool`, `game_id`, `organisation_id`, `creator_id`)
VALUE(`$id`, `$title`, `$creation_date`, `$format`, `$bracket_image`, `$number_of_teams`, `$players_in_team`, `$prize_pool`, `$game_id`, `$organisation_id`, `$creator_id`)";


$results = mysqli_query($connection, $query);

$num = mysqli_num_rows($results);
if ($num == 0)
{
    $q  = "INSERT INTO users(username, password, firstname, lastname, email, date_of_birth) VALUES('$user','$pass','$firstName','$lastName','$email','$dob')";
mysqli_query($connection, $q);
    echo "Sign up successful";

}elseif ($num > 0){
    echo "Tournament already exists";
}
}
?>
