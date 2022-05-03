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

    $query = "SELECT tournaments.title AS ttitle, creation_date, games.title, format, bracket_image, users.username FROM tournaments INNER JOIN games ON tournaments.game_id = games.id
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


        $getMatch1TeamIdsQuery = "SELECT team1_id, team2_id, winner_id FROM matches WHERE tournament_id = '$id' AND id = 1";
        $getMatch1TeamIdsResult = mysqli_query($connection, $getMatch1TeamIdsQuery);
        $match1TeamIdRow = mysqli_fetch_assoc($getMatch1TeamIdsResult);
        $match1Team1Id = $match1TeamIdRow['team1_id'];
        if($match1TeamIdRow['team1_id']){
            
        }

        $match1Team2Id = $match1TeamIdRow['team2_id'];
        $match1WinnerId = $match1TeamIdRow['winner_id'];


        $getMatch2TeamIdsQuery = "SELECT team1_id, team2_id, winner_id FROM matches WHERE tournament_id = '$id' AND id = 2";
        $getMatch2TeamIdsResult = mysqli_query($connection, $getMatch2TeamIdsQuery);
        $match2TeamIdRow = mysqli_fetch_assoc($getMatch2TeamIdsResult);
        $match2Team1Id = $match2TeamIdRow['team1_id'];
        $match2Team2Id = $match2TeamIdRow['team2_id'];
        $match2WinnerId = $match2TeamIdRow['winner_id'];

        
        $getMatch3TeamIdsQuery = "SELECT winner_id FROM matches WHERE tournament_id = '$id' AND id = 2";
        $getMatch3TeamIdsResult = mysqli_query($connection, $getMatch3TeamIdsQuery);
        $match3TeamIdRow = mysqli_fetch_assoc($getMatch3TeamIdsResult);
        $match3WinnerId = $match3TeamIdRow['winner_id'];
       

        echo "<h1>FIRST TEAM: $match1Team1Id <br> SECOND TEAM: $match1Team2Id</h1>";
        echo "<h1>FIRST TEAM: $match2Team1Id <br> SECOND TEAM: $match2Team2Id</h1>";
        echo "<h1>MATCH 1 WINNER: $match1WinnerId</h1>";
        echo "<h1>MATCH 2 WINNER: $match2WinnerId</h1>";
        echo "<h1>WINNER: $match3WinnerId</h1>";
        

        echo <<<_END
        <body>
            <br><br><br><div class="container">
            <div class="col-10 col-sm-10 col-md-6 col-lg-7 col-xl-8 col-xxl-10 mx-auto">
                <h1>{$title}</h1><br><br>
                <h3>Game: {$game} &emsp; Format: {$format}</h3>
                <h4>Created By: {$creator_name} &emsp; <br> {$start_date}</h4><br><br><br>
                <table class="bracket">
                    <tr>

                </table>
                <button id="copyButton" class="mx-auto d-block">Share Tournament</button>
            </div>
            </div>
        </body>
    </html>
_END;
    }

    else {
        echo "<br><br><br><h2 class=\"text-center\">Tournament not found!</h2>";
    }

    mysqli_close($connection);   
}
else {
    echo "No data received!";
}

include_once 'footer.php';

?>
