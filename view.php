<?php
include 'header.php';
include 'credentials.php';

if (isset($_SESSION['loggedIn'])){
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }


    $query = "SELECT tournaments.title AS ttitle, creation_date, games.title, format, bracket_image, users.username FROM tournaments INNER JOIN games ON tournaments.id = games.id
    INNER JOIN users ON tournaments.creator_id = users.id";

    $result = mysqli_query($connection, $query);

    $n = mysqli_num_rows($result);

    if ($n > 0){
        for($i = 0; $i < $n; $i++){
        $row = mysqli_fetch_assoc($result);
        $title = $row['ttitle'];
        $start_date = $row['creation_date'];
        $game = $row['title'];
        $creator_name = $row['username'];
        $format = $row['format'];
        $bracket_image = $row['bracket_image'];
        echo <<<_END
        <body>
        <table>
            <tr><td>{$title}</td></tr>
            <tr><td>Game: {$game}</td></tr>  <tr><td>Format: {$format}</td></tr>  <tr><td>by: {$creator_name}</td></tr>
            <tr><td>{$start_date}</td></tr>
            <tr><td><img src="{$bracket_image}" alt="{$title}" title="{$title}" width="200" height="150"></td></tr>
            <tr><td><button id="copyButton">Share Tournament</button></td></tr>

        </body>
    </html>
_END;
    }
}

    else {
        echo "<h1>Tournament not found!</h1>";
    }
mysqli_close($connection);
}
elseif (!isset($_SESSION['loggedIn'])){
    echo"You need to be signed in to view this page";
}
include_once 'footer.php';

?>
