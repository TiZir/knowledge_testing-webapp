<?php
    include('menu.php');
    include('functions.php');
?>

<!DOCTYPE html>
<html lang="en, ru">
<head>
    <title>Test Selection</title>
</head>
    <body style="background:url(Style/aga.jpg); background-size: 100%;">
        <?php
            $GLOBALS["NowTest"]=null;
            if(isset($_POST['choose'])){
                $GLOBALS["NowTest"]=$_POST['SelectTest'];
                $_SESSION["NowTest"]=$GLOBALS['NowTest'];
            } 
            
        ?>
        <form  id='Split1' class="Left" action="" method="post">
            <?php
                $flagfirts=true;
                $arrayTestsID = GetTestsID($connect);
                $countTest=0;
                foreach ($arrayTestsID as $item){
                    if(GetTestStatus($connect,$item) && GetResultFromTestIDStudentID($connect,$item,$_SESSION['StudentID'])<=0){
                        $countTest++;
                    }
                }
                echo"<select name='SelectTest' id='SelectTest' size='".$countTest."' autofocus>";
                    foreach ($arrayTestsID as $item1){
                        $NameTests=GetTestName($connect,$item1,false);
                        $StatusTests=GetTestStatus($connect,$item1);
                        $ResultExist=GetResultFromTestIDStudentID($connect,$item1,$_SESSION['StudentID']);
                        if ($StatusTests==1 && $ResultExist<=0){
                            if($flagfirts){
                                echo "<option id='OptionSelect' selected value='".$item1."' ".(($item1==$GLOBALS['NowTest'])?"selected='selected'":'').">".$NameTests."</option>";
                                $flagfirts=false;
                            }
                            else{
                                echo "<option  id='OptionSelect' value='".$item1."' ".(($item1==$GLOBALS['NowTest'])?"selected='selected'":'').">".$NameTests."</option>";
                            }
                        }
                    }
                echo"</select>";
            ?>
            <input type="submit" name="choose" class="but" value="Выбрать"/>
        </form>
        <form  id='Split2' class="Right" action="testgenerator.php" method="post">
            <div class='split2text'>
                <h1>Чтобы запустить тест, нажмите кнопку "Начать тестирование"</h1>
                <?php
                    if($GLOBALS['NowTest']==null){
                        echo"<h3> Для начала выберете тест в левой части экрана: </h3>";
                    }
                    else{
                        $TimeTest=GetTestTime($connect,$GLOBALS['NowTest']);
                        echo"
                            <h3> На данные тест выделяется: </h3>
                            <input class='InputData' readonly type='text' id='textin' name='ttime' value='$TimeTest'></p>
                        ";
                       
                    }
                    if($GLOBALS['NowTest']==null){
                        echo"<button disabled type='submit' class='but'>Начать тестирование</button>";
                    }
                    else{
                        echo"<button type='submit' class='but'>Начать тестирование</button>";
                    }
                ?>
            </div>
            <span class="WaitBeforeTest">
            </span>
        </form>
    </body>
</html>

