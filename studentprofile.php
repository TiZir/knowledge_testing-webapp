<?php
    include('menu.php');
    include('functions.php');
?>

<!DOCTYPE html>
<html lang="en, ru">
<head>
    <title>Student Profile</title>
    <style>
        table.iksweb{
            text-decoration: none;
            border-collapse:collapse;
            width:100%;
            text-align:center;
        }

        table.iksweb th{
            font-weight:500;
            font-size:20px;
            color:#000000;
            background-color:#6bafbc;
        }

        table.iksweb td{
            font-size:18px;
            color:#000000;
        }

        table.iksweb td,table.iksweb th{white-space:pre-wrap;
            padding:10px 5px;
            line-height:18px;
            vertical-align: middle;
            border: 2px solid #000000;
        }

        table.iksweb tr:hover{
            background-color:#ffffff
        }

        table.iksweb tr:hover td{
            color:#6bafbc;
            cursor:default;
        }

        .mobile-table{
            margin-top: 70px;
            margin-right: auto;
            margin-left: auto;
            width: 90%;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <br>
    <div class="mobile-table">
        <table class="iksweb">
            <thead>
            <tr>
                <th>ФИО студента</th>
                <th>Название теста</th>
                <th>Баллы</th>
                <th>Оценка</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $arrayResultsID = GetResultsID($connect,$_SESSION["StudentID"]);
                    foreach ($arrayResultsID as $item){
                        $FlagResult=GetResultStatus($connect,$item);
                        $NameTests=GetTestName($connect,$item,true);
                        $Score=GetResultScore($connect,$item);
                        $AllScore=GetResultAllScore($connect,$item);
                        $Mark=GetResultMark($connect,$item);
                        if($FlagResult==1){
                            echo"
                                <tr>
                                    <td>".$_SESSION['LastName'].' '.$_SESSION['FirstName']."</td>
                                    <td>".$NameTests."</td>
                                    <td>".$Score." / ".$AllScore."</td>
                                    <td>".$Mark."</td>
                                </tr>
                            ";
                        }
                        else{
                            echo"
                            <tr>
                                <td>".$_SESSION['LastName'].' '.$_SESSION['FirstName']."</td>
                                <td>".$NameTests."</td>
                                <td>Тест еще не проверен</td>
                                <td>Тест еще не проверен</td>
                            </tr>
                            ";
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>