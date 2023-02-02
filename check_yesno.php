<?php
    include('functions.php');
    session_start();

    $nowSt=$_GET['ids'];
    foreach ( $_SESSION['ver'] as $item){
        if(isset($_POST['yes'.$item]))
        {
            $idRes=GetInVerificationResultID($connect, $item);
            $idQue=GetInVerificationQuestionID($connect,$item);
            $queWeight=GetQuestionWeight($connect,$idQue);
            $scoreResult= GetResultScore($connect,$idRes)+$queWeight;
            UpdateResult($connect,$idRes,$scoreResult,$_SESSION['TeacherID'],true);
            DeleteVerification($connect, $item);
        }
        else{
            if(isset($_POST['no'.$item]))
            {   
                $idRes=GetInVerificationResultID($connect, $item);
                UpdateResultTeacher($connect,$idRes,$_SESSION['TeacherID']);
                DeleteVerification($connect, $item);
            }
        }
    }
    session_write_close();
    exit("<meta http-equiv='refresh' content='0; url= /TestingSystem/verification.php?ids=$nowSt'>");
?>