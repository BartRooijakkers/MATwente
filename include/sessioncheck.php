<?php

    if(session_id() == '' || !isset($_SESSION)) {
        // session isn't started
        session_start();
    }

    if(isset($_SESSION['name'])){

    $user_check = $_SESSION['name'];
    $ses_sql = mysqli_query($con,"SELECT * FROM user WHERE userID = '$user_check' ");
    $array = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
    }
?>