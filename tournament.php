<?php
include 'header.php';
include 'credentials.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }

    $query = "SELECT tournaments.title AS ttitle, creation_date, games.title, format, bracket_image, users.username FROM tournaments INNER JOIN games ON tournaments.id = games.id
    INNER JOIN users ON tournaments.creator_id = users.id WHERE tournaments.id = '$id'";

    $result = mysqli_query($connection, $query);

    $n = mysqli_num_rows($result);

    if ($n > 0){
        $row = mysqli_fetch_assoc($result);
        $title = $row['ttitle'];
        $start_date = $row['creation_date'];
        $game = $row['title'];
        $creator_name = $row['username'];
        $format = $row['format'];
        $bracket_image = $row['bracket_image'];
        echo <<<_END
        <body>
            <h1>{$title}</h1>
            <h3>Game: {$game} &emsp; Format: {$format} &emsp; by: {$creator_name}</h3>
            <h4>{$start_date}</h4>
            <img src="{$bracket_image}" alt="{$title}" title="{$title}" width="200" height="150">
            <button id="copyButton">Share Tournament</button>

        </body>
    </html>
_END;
    }

    else {
        echo "<h1>Tournament not found!</h1>";
    }

    mysqli_close($connection);   
}
else {
    echo "No data received!";
}

include_once 'footer.php';

?>
