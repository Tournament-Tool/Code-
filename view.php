<?php
$connection = mysqli_connect($dbhost, $dbuser, $dbpass);


if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}
$query = "SELECT * FROM tournaments";
$results = mysqli_query($connection, $query);

$n = mysqli_num_rows($results);

if($n > 0){
    echo"<table>";
for($i = 0; $i < $n; $i++){
    $rows = mysqli_fetch_assoc($results);
    echo"<tr>";
    echo"<td>{$rows['title']}</td><td>{$rows['start_date']}</td><td>{$rows['game']}</td><td>{$rows['creator_name']}</td><td>{$rows['format']}</td><td>{$rows['bracket_image']}</td>";
    echo"<tr>";
}
echo"</table>";
}


?>