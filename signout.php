<?php
include 'header.php';
if (isset($_SESSION['loggedIn'])){
    unset($_SESSION['loggedIn']);
    header("Refresh:0");
}elseif (!isset($_SESSION['loggedIn'])){
    echo "You have logged out";
    }
include 'footer.php';
?>
