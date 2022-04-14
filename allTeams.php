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

    $query = "SELECT teams.id , teams.name, users.username, teams.creation_date FROM teams INNER JOIN users ON teams.creator_id = users.id";

    $result = mysqli_query($connection, $query);

    $n = mysqli_num_rows($result);

    if ($n > 0){
        
        
        echo "<body>";
            echo "<table class=\"allTeams_table\">";
            for($i = 0; $i < $n; $i++){
                $row = mysqli_fetch_assoc($result);

                $team_ID = $row['id'];
                $team_name = $row['name'];
                $creator_name = $row['username'];
                $creation_date = $row['creation_date'];

               echo <<<_END
                 "<tr><td>$team_ID</td><td>$team_name</td><td>$creator_name</td><td>$creation_date</td><td><form method="POST" action="allTeams.php"><button class="btn btn-secondary" id="table_btn" type=submit name="join_team" value="$team_ID">Join</button></form></td></tr>"
_END;
            }
            echo "</table>";
        echo "</body>";
        echo "</html>";

    }

    // get the id of user who is joining the team
    $query = "SELECT id FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        //store user info to display it in form
        $user_id = $row['id'];

    if (isset($_POST['join_team'])) {

        $team_joining = $_POST['join_team'];

        $query = "INSERT INTO team_members (team_id, user_id, join_date) Values ('$team_joining', '$user_id', SYSDATE())";

                    $result = mysqli_query($connection, $query);

                    if ($result) {
                        echo "<h2>Join request was successfully sent.</h2>";        
                    }
                    
                    else { 
                        echo "<h2>Failed to join team or request has already been sent!</h2>";
                    }

    }

    mysqli_close($connection);
}

else {

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }

    $query = "SELECT teams.id , teams.name, users.username, teams.creation_date FROM teams INNER JOIN users ON teams.creator_id = users.id";

    $result = mysqli_query($connection, $query);

    $n = mysqli_num_rows($result);

    if ($n > 0){
        
        
        echo "<body>";
            echo "<table class=\"allTeams_table\">";
            for($i = 0; $i < $n; $i++){
                $row = mysqli_fetch_assoc($result);

                $team_ID = $row['id'];
                $team_name = $row['name'];
                $creator_name = $row['username'];
                $creation_date = $row['creation_date'];

               echo <<<_END
                 "<tr><td>$team_ID</td><td>$team_name</td><td>$creator_name</td><td>$creation_date</td><td><form method="POST" action="allTeams.php"><button class="btn btn-secondary" id="table_btn" type=submit name="join_team" value="$team_ID">Join</button></form></td></tr>"
_END;
            }
            echo "</table>";
        echo "</body>";
        echo "</html>";

    }

    //user mot logged in cannot join a team
    if (isset($_POST['join_team'])) {

        echo "<h2>You must be signed in to join a team</h2>";

    }

    mysqli_close($connection);
    
}

include_once 'footer.php';
?>
