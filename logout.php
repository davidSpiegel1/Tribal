<?php
// Name: David Spiegel
// Course: CSC 337
// Description: Within logout, we will simply be unseting the session variable 'user'
// and returing to the view.
session_start();
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    unset($_SESSION['curTribe']);
    unset($_SESSION['searchTerm']);
    header("Location: index.php");
}

?>
