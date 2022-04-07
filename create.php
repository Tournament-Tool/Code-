<?php


require_once "credentials.php";


$connection = mysqli_connect($dbhost, $dbuser, $dbpass);


if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS " . $dbname;


if (mysqli_query($connection, $sql))
{
    echo "Database created successfully, or already exists<br>";
}
else
{
    die("Error creating database: " . mysqli_error($connection));
}


mysqli_select_db($connection, $dbname);


$sql = "DROP TABLE IF EXISTS tournaments";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: users<br>";
}
else
{
    die("Error checking for existing table: " . mysqli_error($connection));
}

$sql = "CREATE TABLE tournaments (id INT NOT NULL AUTO_INCREMENT, title VARCHAR(16), start_date DATE, game VARCHAR(10), creator_name VARCHAR(10), format VARCHAR(10), bracket_image VARCHAR(100), PRIMARY KEY(id))";

if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: tournaments<br>";
}
else
{
    die("Error creating table: " . mysqli_error($connection));
}



$title[] = 'Tournament1'; $start_date[] ='2022-04-14'; $game[] = 'League Of Legends'; $creator_name[] = 'user1'; $format[] = 'SWISS'; $images[] = 'LINK OF IMAGE';
$title[] = 'Tournament2'; $start_date[] ='2021-04-14'; $game[] = 'Counter Strike'; $creator_name[] = 'user2'; $format[] = 'Round Robin'; $images[] = '';
$title[] = 'Tournament3'; $start_date[] ='2022-06-21'; $game[] = 'Rocket League'; $creator_name[] = 'user3'; $format[] = 'Double Elimination Brackets'; $images[] = '';
$title[] = 'HungerGames'; $start_date[] ='2022-09-23'; $game[] = 'Overwatch'; $creator_name[] = 'user1'; $format[] = 'Single Elimination Brackets'; $images[] = '';




// loop through the arrays above and add rows to the table:
for ($i=0; $i<count($title); $i++)
{
    $sql = "INSERT INTO tournaments (title, start_date, game, creator_name, format, bracket_image) VALUES ('$title[$i]', '$start_date[$i]', '$game[$i]', '$creator_name[$i]', '$format[$i]', '$images[$i]')";
    print_r($sql);

    // no data returned, we just test for true(success)/false(failure):
    if (mysqli_query($connection, $sql))
    {
        echo "row inserted<br>";
    }
    else
    {
        die("Error inserting row: " . mysqli_error($connection));
    }
}

$sql = "DROP TABLE IF EXISTS users";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: users<br>";
}
else
{
    die("Error checking for existing table: " . mysqli_error($connection));
}

$sql = "CREATE TABLE users (id INT NOT NULL AUTO_INCREMENT, username VARCHAR(16), password VARCHAR(210), firstname VARCHAR(100), lastname VARCHAR(100), email VARCHAR(255), date_of_birth DATE, PRIMARY KEY(id))";


if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: users<br>";
}
else
{
    die("Error creating table: " . mysqli_error($connection));
}

$username[] = 'Tom'; $password[] ='2022-04-14'; $firsname[] = 'Thomas'; $lastname[] = 'Shelby'; $email[] = 't.shelby@peaky_fucking_blinders.com'; $date_of_birth[] = '1920-03-15';
$username[] = 'baco'; $password[] ='paco'; $firsname[] = 'Plamen'; $lastname[] = 'Bukov'; $email[] = 'plamen_bukov@gmail.com'; $date_of_birth[] = '2001-01-27';


for ($i=0; $i<count($username); $i++)
{
    $sql = "INSERT INTO users (username, password, firstname, lastname, email, date_of_birth) VALUES ('$username[$i]', '$password[$i]', '$firsname[$i]', '$lastname[$i]', '$email[$i]', '$date_of_birth[$i]')";
    print_r($sql);

    // no data returned, we just test for true(success)/false(failure):
    if (mysqli_query($connection, $sql))
    {
        echo "row inserted<br>";
    }
    else
    {
        die("Error inserting row: " . mysqli_error($connection));
    }
}



mysqli_close($connection);

?>

