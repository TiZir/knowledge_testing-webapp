<?php
    include('menut.php');
    include('functions.php');
?>

<!DOCTYPE html>
<html lang="en, ru">
<head>
    <title>Test Selection</title>
</head>
    <body style="background:url(Style/aga.jpg); background-size: 100%;">
        <?php

            if(isset($_POST['edit'])){
               // $_SESSION["NowTest"]=$_POST['SelectTest'];
                $_SESSION["NowTest"]=$_POST['SelectTest'];
                $arrayVar=GetQuestionVariants($connect,$_POST['SelectTest']);
                $_SESSION["СhoiceVar"]=$arrayVar[0];
                header('location:edittest.php');
            } 
            if(isset($_POST['add'])){
                $tname='Новый тест от '.$_SESSION['LastName'].' '.$_SESSION['FirstName'];
                AddTest($connect, $tname,'00:00:01',false);
                exit("<meta http-equiv='refresh' content='0'>");
                //header('location:resultcheck.php');
            } 

            if(isset($_POST['delete'])){
                DeleteTest($connect, $_POST['SelectTest']);
                exit("<meta http-equiv='refresh' content='0'>");
                //header('location:resultcheck.php');
            } 
            
        ?>
        <form  id="Split1" class="Left"  action=""  method="post">
            <?php
                $flagfirts=true;
                $arrayTestsID = GetTestsID($connect);
                echo"<select name='SelectTest' id='SelectTest' size='".count($arrayTestsID)."' autofocus>";
                    foreach ($arrayTestsID as $item){
                        $NameTests=GetTestName($connect,$item,false);
                        $StatusTests=GetTestStatus($connect,$item);
                        if ($StatusTests==1){
                            if($flagfirts){
                                echo "<option id='OptionSelect' selected value='".$item."' ".(($item==$GLOBALS['NowTest'])?"selected='selected'":'').">".$NameTests."</option>";
                                $flagfirts=false;
                            }
                            else{
                                echo "<option  id='OptionSelect' value='".$item."' ".(($item==$GLOBALS['NowTest'])?"selected='selected'":'').">".$NameTests."</option>";
                            }
                        }
                        else{
                            echo("<option  id='OptionSelect'  value='".$item."'>".$NameTests." (в архиве)</option>");
                        }
                    }
                echo"</select>";
            ?>
            <div class="butgroup">
                <input formaction="" formmethod="post" type="submit"  name="add" class="but"  value="Добавить" />
                <input formaction="" formmethod="post" type="submit" name="delete" class="but"  value="Удалить" />
            </div>
            <input formaction="" formmethod="post" type="submit"  name="edit"  class="but" value="Редактировать" />
        </form>
		<div class="Split2 Right">
		</div>
    </body>
</html>

