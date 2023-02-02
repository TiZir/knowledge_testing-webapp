<?php
    $host="localhost";
    $user="root";
    $psw="";
    $connect=mysqli_connect($host,$user,$psw);
    $db_name="testingsystem";
    mysqli_query($connect, "USE ".$db_name.";");

    /*
        $tbl="";
        $tb2="";
        $tb3="";
        $tb4="";
        $tb5="";
        $tb6="";
        $tb7="";

        $db_list=mysqli_query($connect, "SHOW DATABASES;");

        $flag=0;

        while ($row=mysqli_fetch_object($db_list)){ //проверка наличия БД
            if ($row->Database==$db_name){
                $flag=1;
            }
        }

        if ($flag==0){
            mysqli_query($connect, "CREATE DATABASE ".$db_name."DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;");
        }

        mysqli_query($connect, "USE ".$db_name.";");

        $tbl_list=mysqli_query($connect, "SHOW TABLES LIKE 'users';");
        $tb2_list=mysqli_query($connect, "SHOW TABLES LIKE 'articles';");

        if ($tbl_list){//создание таблицы
            mysqli_query();
        }
    */
?>