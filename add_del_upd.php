<?php
    include('functions.php');
    session_start();
    
    $nowQu=$_GET['id'];

    if(isset($_POST['open'])){
        $_SESSION["qt"]=1;
        UpdateQuestionType($connect, $_GET['id'], $_SESSION['qt']);
    }
    if(isset($_POST['openclose'])){
        $_SESSION["qt"] =2;
        UpdateQuestionType($connect, $_GET['id'], $_SESSION['qt']);
    }
    if(isset($_POST['close'])){
        $_SESSION["qt"] =3;
        for ($i=0; $i<count($_SESSION['an']); $i++) { 
            DeleteAnswer($connect, $_SESSION['an'][$i]);
        }
        UpdateQuestionType($connect, $_GET['id'], $_SESSION['qt']);
    }
    if(isset($_POST['imgdel'])){
        $img=NULL;
        $query = "UPDATE `questions` SET `ImageQuestion`='$img' WHERE `QuestionID`='$nowQu';";
        mysqli_query($connect, $query);

    }

    foreach ($_SESSION['an'] as $item1){
        if(isset($_POST['imgdela'.$item1])){
            $query = "UPDATE `answers` SET  `ImageAnswer`=NULL WHERE `AnswerID`='$item1';";
            mysqli_query($connect, $query);
        }
    }

    if(isset($_POST['add']))
    {
        AddAnswer($connect,$nowQu,"Заполните правильный ответ",'NULL',0);   
    }
    else
    {
        if(isset($_POST['upd']))
        {
            if(!empty($_FILES['img_qu']['tmp_name'])){
                $img=addslashes(file_get_contents($_FILES['img_qu']['tmp_name']));
                $txt = mysqli_real_escape_string($connect, $_POST['quesitem']);
                $query = "UPDATE `questions` SET `QuestionVariant`='".$_POST['varitem']."',`IDTest`='".$_SESSION['NowTest']."',
                `ShortNameQuestion`='".$_POST['schortitem']."',`TextQuestion`='$txt',`ImageQuestion`='$img',
                `TypeQuestion`='".$_SESSION['qt']."',`WeightQuestion`='".$_POST['weightitem']."' WHERE `QuestionID`='$nowQu';";
                mysqli_query($connect, $query);
            }
            else{
                $txt = mysqli_real_escape_string($connect, $_POST['quesitem']);
                $query = "UPDATE `questions` SET `QuestionVariant`='".$_POST['varitem']."',`IDTest`='".$_SESSION['NowTest']."',
                `ShortNameQuestion`='".$_POST['schortitem']."',`TextQuestion`='$txt',`TypeQuestion`='".$_SESSION['qt']."',`WeightQuestion`='".$_POST['weightitem']."' WHERE `QuestionID`='$nowQu';";
                mysqli_query($connect, $query);
            }

            foreach ($_SESSION['an'] as $item1){
                if($_SESSION['qt']==1)
                {
                    if($_POST['rad'.$_GET['id']]==$item1)
                    {      
                        if(!empty($_FILES['img_an'.$item1]['tmp_name'])){
                            $img=addslashes(file_get_contents($_FILES['img_an'.$item1]['tmp_name']));
                            UpdateAnswer($connect,$item1,$_POST['ans'.$item1],$img,"false");
                        }  
                        else{
                            $txt = mysqli_real_escape_string($connect, $_POST['ans'.$item1]);
                            $query = "UPDATE `answers` SET  `TextAnswer`='$txt', `TypeAnswer`=1 WHERE `AnswerID`='$item1';";
                            mysqli_query($connect, $query);
                        }           

                    }
                    else
                    {
                        if(!empty($_FILES['img_an'.$item1]['tmp_name'])){
                            $img=addslashes(file_get_contents($_FILES['img_an'.$item1]['tmp_name']));
                            UpdateAnswer($connect,$item1,$_POST['ans'.$item1],$img,"false");
                        }  
                        else{
                            $txt = mysqli_real_escape_string($connect, $_POST['ans'.$item1]);
                            $query = "UPDATE `answers` SET  `TextAnswer`='$txt', `TypeAnswer`=0 WHERE `AnswerID`='$item1';";
                            mysqli_query($connect, $query);
                        } 
                    }
                }
                elseif($_SESSION['qt']==2)
                {
                    UpdateAnswer($connect,$item1,$_POST['ans'.$item1],"NULL","true");
                }
            }
        }
        else
        {
            foreach ( $_SESSION['an'] as $item1){
                if(isset($_POST['del'.$item1])){
                    DeleteAnswer($connect, $item1);
                }
            }
        }
    }
    session_write_close();
    exit("<meta http-equiv='refresh' content='0; url= /TestingSystem/edittest.php?id=$nowQu'>");
?>
