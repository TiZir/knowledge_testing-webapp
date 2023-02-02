<?php
    include('config.php');   
//тесты---------------------------------------------------------------------------------------------------------------------------------
    function GetTestsID($connect) {
        $dataID = array();
        $query = "SELECT `TestID` FROM `tests`;";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataID[] = $row['TestID'];
        }
        return $dataID;
    }

    function GetTestName($connect,$id,$flag){
        $name = " ";
        //для получения названия последнего теста в таблице по id результата
        if($flag){
            $query = "SELECT `IDTest` FROM `results` WHERE `ResultID`='".$id."';";
            $res = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_array($res)) {
                $id = $row['IDTest'];
            }
        }
        //для получение названия теста
        $query = "SELECT `NameTest` FROM `tests` WHERE `TestID`='".$id."';";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $name= $row['NameTest'];
        }
        return $name;
    }

    function GetTestStatus($connect,$id){
        $flag = 0;
        $query = "SELECT `StatusTest` FROM `tests` WHERE `TestID`='".$id."';";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $flag= $row['StatusTest'];
        }
        return $flag;
    }

    function GetTestTime($connect,$id){
        $time = " ";
        $query = "SELECT `DurationTest` FROM `tests` WHERE `TestID`='".$id."';";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $time= $row['DurationTest'];
        }
        return $time;
    }

    function AddTest($connect, $tname, $ttime,$tstate) {
        //$txt = mysqli_real_escape_string($connect, $textqu);
        $query = "INSERT INTO `tests`(`NameTest`, `DurationTest`, `StatusTest`)
        values('".$tname."','".$ttime."'".",'".$tstate."');";
        mysqli_query($connect, $query);
    }

    function UpdateTest($connect, $id, $tname, $ttime,$tstate) {
        //$txt = mysqli_real_escape_string($connect, $textan);
        $query = "UPDATE `tests` SET `NameTest`='$tname',
        `DurationTest`='$ttime',`StatusTest`=$tstate WHERE TestID=$id;";
        mysqli_query($connect, $query);
    }

    function DeleteTest($connect, $id) {
        $query = "DELETE FROM `tests` WHERE TestID=$id;";
        mysqli_query($connect, $query);
    }
//вопросы---------------------------------------------------------------------------------------------------------------------------------
    function GetQuestionsID($connect,$id,$qvar){
        $dataID = array();
        $query = "SELECT `QuestionID` FROM `questions` WHERE `IDTest`='$id' AND `QuestionVariant`='$qvar' ORDER BY `QuestionID`;";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataID[] = $row['QuestionID'];
        }
        return $dataID;
    }

    function GetQuestionVariants($connect,$id){
        $QVar = array();
        $query = "SELECT DISTINCT `QuestionVariant` FROM `questions` WHERE 
        `IDTest`='".$id."' ORDER BY `QuestionVariant`;";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $QVar[] = $row['QuestionVariant'];
        }
        return $QVar;
    }

    function GetQuestionText($connect,$id){
        $text = " ";
        $query = "SELECT `TextQuestion` FROM `questions` WHERE `QuestionID`='".$id."';";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $text= $row['TextQuestion'];
        }
        return $text;
    }

    function GetQuestionShortText($connect,$id){
        $text = " ";
        $query = "SELECT `ShortNameQuestion` FROM `questions` WHERE `QuestionID`='".$id."';";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $text= $row['ShortNameQuestion'];
        }
        return $text;
    }

    function GetQuestionWeight($connect,$id){
        $dataW = 0;
        $query = "SELECT `WeightQuestion` FROM `questions` WHERE `QuestionID`='".$id."';";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataW= $row['WeightQuestion'];
        }
        return $dataW;
    }

    function GetQuestionImage($connect,$id){
        $query = "SELECT `ImageQuestion` FROM `questions` WHERE `QuestionID`=$id;";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataIm= $row['ImageQuestion'];
        }
        return  $dataIm;
    }

    function GetQuestionType($connect,$id){
        $dataTy = 0;
        $query = "SELECT `TypeQuestion` FROM `questions` WHERE `QuestionID`='".$id."';";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataTy= $row['TypeQuestion'];
        }
        return $dataTy;
    }

    function AddQuestion($connect, $qvar, $tid, $qsname,$qtext,$qimage,$qtype, $qwte) {
        $txt = mysqli_real_escape_string($connect, $qtext);
        $query = "INSERT INTO `questions`(`QuestionVariant`,`IDTest`, `ShortNameQuestion`,
        `TextQuestion` , `ImageQuestion`,`TypeQuestion`,`WeightQuestion`)
        values('".$qvar."',"."'".$tid."'".","."'".$qsname."'".",'". $txt."',$qimage,
        '".$qtype."','".$qwte."');";
        mysqli_query($connect, $query);
    }

    function UpdateQuestion($connect,$id, $qvar, $tid, $qsname,$qtext, $qimage,$qtype, $qwte) {
        $txt = mysqli_real_escape_string($connect, $qtext);
        $query = "UPDATE `questions` SET `QuestionVariant`='$qvar',`IDTest`='$tid',
        `ShortNameQuestion`='$qsname',`TextQuestion`='$txt',`ImageQuestion`=$qimage,
        `TypeQuestion`='$qtype',`WeightQuestion`='$qwte' WHERE `QuestionID`='$id';";
        mysqli_query($connect, $query);
    }
    
    function UpdateQuestionType($connect,$id,$qtype) {
        $query = "UPDATE `questions` SET `TypeQuestion`='$qtype' WHERE `QuestionID`='$id';";
        mysqli_query($connect, $query);
    }

    function DeleteQuestion($connect, $id) {
        $query = "DELETE FROM `questions` WHERE QuestionID=$id;";
        mysqli_query($connect, $query);
    }
//ответы---------------------------------------------------------------------------------------------------------------------------------
    function GetAnswersID($connect,$id){
        $dataID = array();
        $query = "SELECT `AnswerID` FROM `answers` WHERE `IDQuestion`='$id' ORDER BY `AnswerID`;";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataID[] = $row['AnswerID'];
        }
        return $dataID;
    }

    function GetAnswersText($connect,$id){
        $text = " ";
        $query = "SELECT `TextAnswer` FROM `answers` WHERE AnswerID='".$id."';";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $text= $row['TextAnswer'];
        }
        return $text;
    }

    function GetAnswersTrueFalse($connect,$id){
        $dataTF = 0;
        $query = "SELECT `TypeAnswer` FROM `answers` WHERE AnswerID='".$id."';";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataTF= $row['TypeAnswer'];
        }
        return  $dataTF;
    }

    function GetAnswerImage($connect,$id){
        $query = "SELECT `ImageAnswer` FROM `answers` WHERE `AnswerID`=$id;";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataIm= $row['ImageAnswer'];
        }
        return  $dataIm;
    }

    function AddAnswer($connect, $qid, $atext, $aimage,$atype) {
        $txt = mysqli_real_escape_string($connect, $atext);
        $query = "INSERT INTO `answers`(`IDQuestion`, `TextAnswer`, `ImageAnswer`, `TypeAnswer`)
        values('$qid','$txt',$aimage,$atype);";
        mysqli_query($connect, $query);
        echo($qid); echo($atext); echo($aimage); echo($atype);
    }

    function UpdateAnswer($connect, $aid, $atext, $aimage,$atype) {
        $txt = mysqli_real_escape_string($connect, $atext);
        $query = "UPDATE `answers` SET  `TextAnswer`='$txt', 
        `ImageAnswer`='$aimage', `TypeAnswer`=$atype WHERE `AnswerID`='$aid';";
        mysqli_query($connect, $query);
    }

    function DeleteAnswer($connect, $id) {
        $query = "DELETE FROM `answers` WHERE AnswerID=$id;";
        mysqli_query($connect, $query);
    }
//результаты---------------------------------------------------------------------------------------------------------------------------------
    function GetResultsID($connect,$id){
        $dataID = array();
        $query = "SELECT `ResultID` FROM `results` WHERE `IDStudent`=$id;";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataID[] = $row['ResultID'];
        }
        return $dataID;
    }
    
    function GetResultID($connect,$ids,$idt){
        $dataID = 0;
        $query = "SELECT `ResultID` FROM `results` WHERE `IDStudent`=$ids AND `IDTest`=$idt;";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataID = $row['ResultID'];
        }
        return $dataID;
    }

    function GetResultScore($connect,$id){
        $dataS = 0;
        $query = "SELECT `ScoresResult` FROM `results` WHERE `ResultID`='".$id."';";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataS= $row['ScoresResult'];
        }
        return  $dataS;
    }

    function GetResultAllScore($connect,$id){
        $dataS = 0;
        $query = "SELECT `AllScore` FROM `results` WHERE `ResultID`='".$id."';";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataS= $row['AllScore'];
        }
        return  $dataS;
    }

    function GetResultMark($connect,$id){
        $dataM = 0;
        $query = "SELECT `MarkResult` FROM `results` WHERE `ResultID`='".$id."';";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataM= $row['MarkResult'];
        }
        return  $dataM;
    }

    function GetResultStatus($connect,$id){
        $dataM = 0;
        $query = "SELECT `StateResult` FROM `results` WHERE `ResultID`='".$id."';";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataM= $row['StateResult'];
        }
        return  $dataM;
    }

    function GetResultFromTestIDStudentID($connect,$idt,$ids){
        $dataID = 0;
        $query = "SELECT `ResultID` FROM `results` WHERE `IDTest`='$idt' AND `IDStudent`='$ids';";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataID=$row['ResultID'];
        }
        return  $dataID;
    }


    function AddResult($connect,$ids,$idt,$allscor,$scor,$state){
        $query = "INSERT INTO `results`(`IDStudent`,`IDTest`,`AllScore`,`ScoresResult`,`StateResult`) 
        values('$ids','$idt','$allscor','$scor','$state');";
        mysqli_query($connect, $query);
    }

    function UpdateResult($connect,$idr,$scor,$idteach,$state) {
        $query = "UPDATE `results` SET `ScoresResult`='$scor',`IDTeacher`='$idteach',
        `StateResult`=$state WHERE `ResultID`=$idr;";
        mysqli_query($connect, $query);
    }

    function UpdateResultTeacher($connect,$idr,$idt){
        $query = "UPDATE `results` SET `IDTeacher`='$idt' WHERE `ResultID`=$idr;";
        mysqli_query($connect, $query);
    }

    function UpdateResultScoreAndState($connect,$idr,$scor,$state) {
        $query = "UPDATE `results` SET `ScoresResult`='$scor',
        `StateResult`=$state WHERE `ResultID`=$idr;";
        mysqli_query($connect, $query);
    }

    function UpdateResultAllScore($connect,$idr,$scor) {
        $query = "UPDATE `results` SET `AllScore`='$scor' WHERE `ResultID`=$idr;";
        mysqli_query($connect, $query);
    }

    function DeleteResult($connect,$idr) {
        $query = "DELETE FROM `results` WHERE `ResultID`='$idr';";
        mysqli_query($connect, $query);
    }
    
//группы---------------------------------------------------------------------------------------------------------------------------------
    function GetGroupsID($connect){
        $dataID = array();
        $query = "SELECT `GroupID` FROM `groups` ORDER BY `CodeGroup` ASC;";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataID[] = $row['GroupID'];
        }
        return $dataID;
    }

    function GetGroupName($connect,$id){
        $name = " ";
        $query = "SELECT `NameGroup` FROM `groups` WHERE  `GroupID`='".$id."';";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $name= $row['NameGroup'];
        }
        return $name;
    }
//студенты---------------------------------------------------------------------------------------------------------------------------------
    function GetStudentsID($connect,$idgr){
        $dataID = array();
        $query = "SELECT `StudentID` FROM `students` WHERE `IDGroup`='$idgr' 
        ORDER BY `LastNameStudent`;";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataID[] = $row['StudentID'];
        }
        return $dataID;
    }

    function GetStudentName($connect,$id){
        $name = " ";
        $query = "SELECT `LastNameStudent`, `FirstNameStudent`FROM `students` WHERE 
        `StudentID`='".$id."';";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $name= $row['LastNameStudent'].' '.$row['FirstNameStudent'];
        }
        return $name;
    }
//проверка---------------------------------------------------------------------------------------------------------------------------------
    function GetVerificationsID($connect,$idstud,$idtest){
        $dataID = array();
        $query = "SELECT `VerificationID` FROM `verifications` WHERE 
        `IDStudent`=$idstud AND `IDTest`=$idtest;";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataID[] = $row['VerificationID'];
        }
        return $dataID;
    }

    function GetVerificationText($connect,$id){
        $text = " ";
        $query = "SELECT `TextVerification` FROM `verifications` WHERE `VerificationID`=$id;";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $text= $row['TextVerification'];
        }
        return $text;
    }

    function GetInVerificationQuestionID($connect,$id){
        $dataID = 0;
        $query = "SELECT `IDQuestion` FROM `verifications` WHERE `VerificationID`=$id;";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataID = $row['IDQuestion'];
        }
        return $dataID;
    }

    function GetInVerificationResultID($connect,$id){
        $dataID = 0;
        $query = "SELECT `IDResult` FROM `verifications` WHERE `VerificationID`=$id;";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataID = $row['IDResult'];
        }
        return $dataID;
    }

    function GetVerificationImage($connect,$id){
        $query = "SELECT `ImageVerification` FROM `verifications` WHERE `VerificationID`=$id;";
        $res = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($res)) {
            $dataIm= $row['ImageVerification'];
        }
        return  $dataIm;
    }

    function AddVerification($connect,$idr,$ids,$idt,$idq,$text,$image){
        $query =  "INSERT INTO `verifications`(`IDResult`,`IDStudent`, `IDTest`, `IDQuestion`, `TextVerification`, `ImageVerification`) 
        VALUES ('$idr','$ids','$idt','$idq','$text','$image');";
        mysqli_query($connect, $query);
    }

    function DeleteVerification($connect, $id) {
        $query = "DELETE FROM `verifications` WHERE `VerificationID`=$id;";
        mysqli_query($connect, $query);
    }