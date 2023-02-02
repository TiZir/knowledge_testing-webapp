<?php
    include('functions.php');
    session_start();
    $Scores=0;
    $AllScore=0;
    AddResult($connect,$_SESSION['StudentID'],$_SESSION['NowTest'],$AllScore,$Scores,0);
    $ResultNow=GetResultID($connect,$_SESSION['StudentID'],$_SESSION['NowTest']);
    $StateFlag=1;
    foreach ($_SESSION['qu'] as $item1)
    {
        $AllScore+=GetQuestionWeight($connect,$item1);
        $TestType=GetQuestionType($connect,$item1);
        if($TestType==1)
        {
            if(GetAnswersTrueFalse($connect,$_POST["type1".$item1]))
            {
                $Scores+=GetQuestionWeight($connect,$item1);
                UpdateResultScoreAndState($connect,$ResultNow,$Scores,$StateFlag);
            }
        }
        elseif($TestType==2)
        {
            $AnswersID = GetAnswersID($connect,$item1,$_SESSION["vr"]);
            $CountTrue=0;
            foreach ($AnswersID as $item2){
                $AnswerText=GetAnswersText($connect,$item2);
                if($_POST["type2".$item2]== $AnswerText){
                    $CountTrue++;
                }
            }
            if($CountTrue==count($AnswersID)){
                $Scores+=GetQuestionWeight($connect,$item1);
                UpdateResultScoreAndState($connect,$ResultNow,$Scores,$StateFlag);
            }
        }
        else
        {
            $StateFlag=0;
            UpdateResultScoreAndState($connect,$ResultNow,$Scores,$StateFlag);
            if(!empty($_FILES['img_ver'.$item1]['tmp_name'])){
                $img=addslashes(file_get_contents($_FILES['img_ver'.$item1]['tmp_name']));
                AddVerification($connect,$ResultNow,$_SESSION['StudentID'],$_SESSION['NowTest'],$item1,$_POST["type3".$item1],$img);
            }
            else{
                AddVerification($connect,$ResultNow,$_SESSION['StudentID'],$_SESSION['NowTest'],$item1,$_POST["type3".$item1],NULL);
            }
        }
    }
    UpdateResultAllScore($connect,$ResultNow,$AllScore);
    session_write_close();
    exit("<meta http-equiv='refresh' content='0; url= /TestingSystem/studentmain.php'>");
    //header('location:resultcheck.php');
?>