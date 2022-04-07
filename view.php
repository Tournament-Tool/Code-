<?php
include 'header.php';
include 'credentials.php';

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}
$query = "SELECT * FROM tournaments";
$results = mysqli_query($connection, $query);

$n = mysqli_num_rows($results);

if($n > 0){

for($i = 0; $i < $n; $i++){
    $rows = mysqli_fetch_assoc($results);
    echo "<table>";
    echo"<tr><td>{$rows['title']}</td></tr><tr><td>{$rows['start_date']}</td></tr><td>{$rows['game']}</td></tr><tr><td>{$rows['creator_name']}</td></tr><tr><td>{$rows['format']}</td></tr><tr><td>{$rows['bracket_image']}</td></tr>";
    echo "<tr><td><input type='submit' value='View' name='submit'></td></tr>";
    echo "</table>";
}

}


?>
