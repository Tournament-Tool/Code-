<?php
include 'header.php';
include 'credentials.php';

if (isset($_SESSION['loggedIn'])) {
    //store the username of current logged in user
    $username = $_SESSION['username'];
    
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }

    // get the id of user who is currently logged in
    $query = "SELECT id FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        //store user id
        $user_id = $row['id'];

        //get team name for current logged in user
        $query = "SELECT teams.name from team_members INNER JOIN teams ON team_members.team_id = teams.id WHERE team_members.user_id = '$user_id'";

        $result = mysqli_query($connection, $query);

        $n = mysqli_num_rows($result);

        //user joined a team
        if ($n > 0) {

            echo "<body>";
            echo "<table class=\"allTeams_table\">";
            echo "<th>Username</th><th>team</th>";
            for($i = 0; $i < $n; $i++){
                $row = mysqli_fetch_assoc($result);
                $team_name = $row['name'];

                echo <<<_END
                 "<tr><td>$username</td><td>$team_name</td></tr>"
_END;
            }

            echo "</table>";
            echo "</body>";
            echo "</html>";


        }
        //user has not joined any team
        else {
            echo "<h2>You have not joined any teams</h2>";
        }
}

else {

  echo "<h2>You must be signed in to view your teams</h2>";
    
}

include_once 'footer.php';
?>