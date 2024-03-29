<?php 

    require_once "header.php";
    require_once "credentials.php";

    $show_create_form = false;
    $message = "";


    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        
        if (!$connection)
        {
            die("Connection failed: " . $mysqli_connect_error);
        }

        if (isset($_POST['title'])){

            $title = $_POST['title'];
            $role = $_POST['role'];
            $created = date("Y-m-d h:i:sa");
        

            $checkQuery = "SELECT * FROM teams WHERE name ='$title'";
            $checkResult = mysqli_query($connection, $checkQuery);
            $n = mysqli_num_rows($checkResult);

            if ($n > 0){
                $message = "There is already a team with this name<a href='sign_up.php'>here</a>";
            }

            else{

                if (isset($_SESSION['loggedIn'])) 
                {


                    $username = $_SESSION['username'];
                    $getUIdQuery = "SELECT id FROM users WHERE username='$username'"; 
                    $result = mysqli_query($connection, $getUIdQuery);
                    $row = mysqli_fetch_assoc($result);
                    $uid = $row['id'];

                    $createQuery = "INSERT INTO teams (name, creation_date, creator_id) VALUES ('$title', '$created', '$uid')";
                    $insertResult = mysqli_query($connection, $createQuery);

            
            

                    if ($insertResult)
                    {

                        $getTeamIdQuery = "SELECT id FROM teams WHERE name = '$title'";
                        $getTeamIdResult = mysqli_query($connection, $getTeamIdQuery);
                        $teamIdRow = mysqli_fetch_assoc($getTeamIdResult);
                        $teamId = $teamIdRow['id'];

                        $createrTeamMemberQuery = "INSERT INTO team_members (team_id, user_id, role, status, join_date, application_status) VALUES ('$teamId', '$uid', '$role', 'Owner', '$created', 'Accepted')";
                        $createrTeamMemberResult = mysqli_query($connection, $createrTeamMemberQuery);
                        
                        if($createrTeamMemberResult){
                            $message = "Your team been created.";
                            $show_signup_form = false; 
                        }
                        

                    }
                    else{
                        $message = "Something went wrong.";
                    }
                }
                
                else{
                    $show_create_form = true;
                    $message = "You are not logged in.<br>";
                } 
            }
        }

        else{
            $show_create_form = true;
        }
        mysqli_close($connection);



        if($show_create_form){
            echo <<<_END
            <form action="createTeam.php" method="post">
            Create your team:<br>
            Title: <input type="text" name="title" required>
            <br>
            Your Role: <input type="text" name="role" required>
            <br>
            <input class="form-button" type="submit" value="Submit">
            </form>	
            _END;
        }

        echo "$message";


    require_once "footer.php";


?>