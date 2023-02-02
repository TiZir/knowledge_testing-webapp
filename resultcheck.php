<?php
    include('menut.php');
    include('functions.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en, ru">
<head>
    <title>Checking the results</title>
    <style>
        table.iksweb{
            text-decoration: none;
            border-collapse:collapse;
            width:99%;
            text-align:center;
        }

        table.iksweb th{
            font-weight:500;
            font-size:20px;
            color:#000000
            ;background-color:#6bafbc;
        }

        table.iksweb td{
            font-size:18px;
            color:#000000;
        }

        table.iksweb td,table.iksweb th{
            /*white-space:pre-wrap;*/
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
            width: 100%; 
            max-width: 100%; 
        }
    </style>
</head>
    <body>
        <form  class="Split1 Left"  action=""  method="post">
        <?php

            if(isset($_POST['SelectTest'])){
                $_SESSION["NowTest"]=$_POST['SelectTest'];
            }
            if(isset($_POST['SelectTest'])){
                $_SESSION["NowTest"]=$_POST['SelectTest'];
            }
            if(isset($_POST['SelectGroup'])){
                $_SESSION["NowGroup"]=$_POST['SelectGroup'];
            }
            $flagfirts=true;
            $arrayTestsID = GetTestsID($connect);
            echo"<select name='SelectTest' id='SelectTest' size='".count($arrayTestsID)."' autofocus>";
                foreach ($arrayTestsID as $item){
                    $NameTests=GetTestName($connect,$item,false);
                    $StatusTests=GetTestStatus($connect,$item);
                    if ($StatusTests==1){
                        if($flagfirts){
                            echo "<option id='OptionSelect' value='".$item."' ".(($item==$_SESSION['NowTest'])?"selected='selected'":'').">".$NameTests."</option>";
                            $flagfirts=false;
                        }
                        else{
                            echo "<option  id='OptionSelect' value='".$item."' ".(($item==$_SESSION['NowTest'])?"selected='selected'":'').">".$NameTests."</option>";
                        }
                    }
                    else{
                        echo("<option  id='OptionSelect'  value='".$item."' ".(($item==$_SESSION['NowTest'])?"selected='selected'":'').">".$NameTests." (в архиве)</option>");
                    }
                }
            echo"</select>";
            $flagfirts=true;
            $arrayGroupsID = GetGroupsID($connect);
            echo"<div class='grch'>";
                echo"<select name='SelectGroup' id='SelectGroup' autofocus>
                    <option disabled>Группа</option>
                    ";
                    foreach ($arrayGroupsID as $item1){
                        $GroupName=GetGroupName($connect,$item1);
                            if($flagfirts){
                                echo "<option  value='".$item1."' ".(($item1==$_SESSION['NowGroup'])?"selected='selected'":'').">".$GroupName."</option>";
                                $flagfirts=false;
                            }
                            else{
                                echo "<option   value='".$item1."' ".(($item1==$_SESSION['NowGroup'])?"selected='selected'":'').">".$GroupName."</option>";
                            }
                    }
                echo"</select>";
            echo"<input formaction='' formmethod='post' type='submit'  name='choose_item'  class='but' value='Выбрать' />";
            echo"</div>";
        ?>
        </form>
        <form  class="Split2 Right" action="refresh.php" method="post">
            <div class="mobile-table">
                <table class="iksweb">
                    <thead>
                        <tr>
                            <th>ФИ студента</th>
                            <th>Название теста</th>
                            <th>Баллы</th>
                            <th>Оценка</th>
                            <th>Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($_POST['choose_item']))
                            {
                                $arrayStudentsID=GetStudentsID($connect,$_SESSION['NowGroup']);
                                $_SESSION["stud"]=$arrayStudentsID;
                                foreach ($arrayStudentsID as $item2)
                                {
                                    $NameStudent=GetStudentName($connect,$item2);
                                    $ResultID=GetResultID($connect,$item2,$_SESSION['NowTest']);
                                    if($ResultID!=0)
                                    {
                                        $AgainFlag=true;
                                        $NameTests=GetTestName($connect,$ResultID,true);
                                        $Score=GetResultScore($connect,$ResultID);
                                        $AllScore=GetResultAllScore($connect,$ResultID);
                                        $Mark=GetResultMark($connect,$ResultID);
                                    }
                                    else
                                    {
                                        $AgainFlag=false;
                                        $NameTests=NULL;
                                        $Score=0;
                                        $AllScore=0;
                                        $Mark=NULL;
                                    }
                                    echo"
                                        <tr>
                                            <td>".$NameStudent."</td>
                                            <td>".$NameTests."</td>
                                            <td>".$Score." / ".$AllScore."</td>
                                            <td>".$Mark."</td>
                                        ";
                                        if($AgainFlag){
                                            echo"
                                                <td>
                                                    <button style='font-size:18px'  type='submit' onclick='return confirm('Удалить текущий результат?')' name='ref$item2' value='$ResultID'>
                                                        &#9998; Повторить
                                                    </button>
                                                </td>
                                            ";
                                        }
                                        else
                                        {
                                            echo"
                                                <td>Не проходил тест</td>
                                            ";
                                        }
                                    echo"
                                        </tr>
                                    ";
                                }
                            }
                            session_write_close();
                        ?>
                     </tbody>
                </table>
            </div>
        </form>
    </body>
</html>

