<?php
include 'header.php';
$show_form = false;
$tid = $_POST["update"];

if (isset($_SESSION['loggedIn'])){
    

    if(isset($tid)){
        $show_form = true;

        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        if (!$connection)
        {
            die("Connection failed: " . $mysqli_connect_error);
        }
        
        $query = "SELECT tournaments.title AS ttitle, creation_date, games.title, format, bracket_image FROM tournaments INNER JOIN games ON tournaments.game_id = games.id WHERE tournaments.id = '$tid'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);

        //store tournament info to display it in form
        $ttitle_display = $row['ttitle'];
        $creation_date_display = $row['creation_date'];
        $game_title_display = $row['title'];
        $format_display = $row['format'];

        //user tried to update tournament info
        if (isset($_POST['title'])) {
            
            // take copies of the credentials the admin submitted:
            $title_input = $_POST['title'];
            $game_title_input = $_POST['game_select'];
            $format_input = $_POST['format'];

            //update user details
            $query = "UPDATE tournaments SET title = '$title_input', game_id ='$game_title_input', format='$format_input' WHERE id ='$tid'";

            $result = mysqli_query($connection, $query);
                    //no data returned, we just test for true/false
                    //if success     
                    if ($result) {
                        // show a successful message:
                        echo "<br><br><h2 class=\"text-center\"><b>Tournament successfully updated.<b><div class=\"spinner-border\" role=\"status\"><span class=\"sr-only\"></span></div></h2>";
                        header ("Refresh: 2; URL=viewmytournaments.php");
                    }
                    //if failed
                    else {
                        // show an unsuccessful message:
                        echo "<br><br><h2 class=\"text-center\"><b>Failed to update tournament<b></h2>";
                    }

            
        }
       
    }

}


elseif (!isset($_SESSION['loggedIn']))  {
    echo"<br><br><br><h2 class=\"text-center\">You need to be signed in to view this page</h2>";
}


//show the form to allow admin to edit user details
if ($show_form) {
    echo <<<_END
    <br><br><br><br>
    <div class="container">
        <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
            <form action="edittournament.php" method="post">
                <div class="col">
                <div class="input-group mb-3">
                    <label for="title" class="input-group-text"><b>Title: *</b></label>
                    <input class="form-control form-control-sm" id="title" type="text" name="title" value="$ttitle_display" maxlength="32" minlength="2" required>
                </div>
                <div class="input-group mb-3">
                    <select name="game_select" class="form-select w-auto d-inline ms-3">
                        <option value="1">League Of Legends</option>
                        <option value="2">Counter Strike Global Ofensive</option>
                        <option value="3">World Of Warcraft</option>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <label for="creation_date" class="input-group-text"><b>Created: </b></label>
                    <input class="form-control form-control-sm" id="creation_date" type="text" name="creation_date" value="$creation_date_display" maxlength="32" minlength="2" readonly>
                </div>
                <div class="input-group mb-3">
                    <label for="format" class="input-group-text"><b>format: *</b></label>
                    <input class="form-control form-control-sm" id="format" type="text" name="format" value="$format_display" maxlength="32" minlength="2" required>
                </div>
                <div class="container">
                    <button class="mx-auto d-block" type="submit" value="$tid" name="update">Update</button>
                </div>
            </form>
        </div>
    </div>
_END;
}

include_once 'footer.php';
?>