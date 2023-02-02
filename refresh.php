<?php
    include("functions.php");
    session_start();

    foreach ( $_SESSION['stud'] as $item){
        if(isset($_POST['ref'.$item])){
            DeleteResult($connect, $_POST['ref'.$item]);
        }
    }
    session_write_close();
    header('location:resultcheck.php');
?>