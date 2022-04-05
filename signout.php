<?php
if (isset($_SESSION['loggedIn'])){
    unset($_SESSION['loggedIn']);
    $_SESSION = array();
    session_destroy();
    echo"You have signed out";
}
?>