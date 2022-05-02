<?php
include 'header.php';

if (isset($_SESSION['loggedIn'])){
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }

    $user_id = $_SESSION['id'];

    $query = "SELECT tournaments.id, tournaments.title AS ttitle, creation_date, games.title, format, bracket_image, users.username FROM tournaments INNER JOIN games ON games.id = tournaments.game_id
    INNER JOIN users ON tournaments.creator_id = users.id WHERE tournaments.creator_id = '$user_id'";

    $result = mysqli_query($connection, $query);

    $n = mysqli_num_rows($result);

    if ($n > 0){
        for($i = 0; $i < $n; $i++){
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $title = $row['ttitle'];
        $start_date = $row['creation_date'];
        $game = $row['title'];
        $creator_name = $row['username'];
        $format = $row['format'];
        $bracket_image = $row['bracket_image'];
        echo <<<_END
        <body>
        <table class="ms-5 mt-5">
        <tr><td>{$title}</td></tr>
        <tr><td>Game: {$game}</td></tr>  <tr><td>Format: {$format}</td></tr>  <tr><td>by: {$creator_name}</td></tr>
        <tr><td>{$start_date}</td>
        </tr><tr><td><img src="{$bracket_image}" alt="{$title}" title="{$title}" width="200" height="150"></td></tr>
            <form action="view.php" method="post">
            <tr><td><button name="viewButton" value="{$row['id']}"> View Tournament</button></td></tr>
            <tr><td><button name="join" value="{$row['id']}">Send Application</button></td></tr>

            </form>
        </table>
        </body>
    </html>
_END;

    }
}

    else {
        echo "<br><br><br><h1 class=\"text-center\">No tournament found!</h1>";
    }
mysqli_close($connection);
}
elseif (!isset($_SESSION['loggedIn'])){
    echo"<br><br><br><h2 class=\"text-center\">You need to be signed in to view this page</h2>";
}

if(isset($_POST['join'])){
    $_SESSION['join'] = $_POST["join"];
    header('Location: application.php');
}

if(isset($_POST['viewButton'])){
    $loc = $_POST["viewButton"];
    header("Location: tournament.php?id={$loc}");
}
include_once 'footer.php';

?>
