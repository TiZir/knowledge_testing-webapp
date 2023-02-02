<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en, ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="Style/favicon/favicon.ico" type="image/x-icon">
        <style>
            .dropdown .dropbtn {
                font-size: 18px;  
                border: 2px solid rgb(255, 255, 255);
                outline: none;
                color: black;
                padding: 15px;
                background-color: inherit;
            }

            .dropdown:hover .dropbtn { 
                color: #6bafbc;
                border-color: #6bafbc;
            }

            .dropdown-content {
                display: none;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }

            .dropdown-content a {
                text-align: center;
                float: none;
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                width: 85%;
            }

            .dropdown-content a:hover {
                background-color: #ddd;
            }

            .dropdown:hover .dropdown-content {
                display: block;
            }

        </style>
    </head>
        <header  class="Menu">
            <nav class="dws-menu">
                <div>
                    <a class="Main" href="studentmain.php">
                        <span>Главная</span>
                    </a>
   
                    <a class="Other" href="test.php">
                        <span>Тестирование</span>
                    </a>
                    
                    <div class="Profile dropdown">
                        <button class="dropbtn">
                            <?php 
                                echo($_SESSION['LastName'].' '.$_SESSION['FirstName']);
                            ?>
                        </button>
                        <div class="dropdown-content">
                            <br>
                            <a href="studentprofile.php">Профиль</a>
                            <a href="exit.php">Выход</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    <script src="/TestingSystem/help.js"></script> 
    <link rel="stylesheet" href="Style/Student.css">
</html>