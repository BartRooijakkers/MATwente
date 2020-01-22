<?php
if(!isset($_SESSION)){
 session_start();
}
/* Maak session leeg */
unset($_SESSION['user']);
/* Redirect naar login pagina */
header("location:index.php");
?>
