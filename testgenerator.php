<!DOCTYPE html>
<html lang="en, ru">
<head>
    <title>Testing</title>
    <link rel="shortcut icon" href="Style/favicon/favicon.ico" type="image/x-icon">
</head>
<body>
    <?php
        session_start();
        include('functions.php')
    ?>
    <form  class="Split1 Left" action="endtest.php" method="post" enctype='multipart/form-data'>
        <div class="table-responsive">
            <?php
                $arrayVariantsID=GetQuestionVariants($connect,$_SESSION['NowTest']);
                $variant=random_int($arrayVariantsID[0],$arrayVariantsID[count($arrayVariantsID)-1]);
                $_SESSION["vr"]=$variant;
                $arrayQuestionsID = GetQuestionsID($connect,$_SESSION['NowTest'],$variant);
                $_SESSION["qu"]=$arrayQuestionsID;
                $i=1;
                foreach ($arrayQuestionsID as $item1){
                    $questionType=GetQuestionType($connect,$item1);
                    $Img=base64_encode(GetQuestionImage($connect,$item1));
//--------------------------------------------------------------------------------------------------------------------------------------------------------
                    if($questionType==1)
                    {
                        $QText=GetQuestionText($connect,$item1);
                        echo"
                            <table border='1'>
                                <tbody align='center'>
                                    <tr>
                                        <td>
                                            <h3>Задание №".$i."</h3>
                                        </td>            
                                        <td>
                                            <textarea readonly class='queText'>$QText</textarea>
                                        </td>
                        ";
                                         $i++;   
                                        if($Img!=NULL){
                                            echo"
                                                <td>
                                                    <p><img src='data:image/*;base64, $Img' style=' height: 200px; width: 300px;'/> 
                                                </td>
                                            ";
                                        }
                        echo"
                                    </tr>
                                </tbody>
                            </table>
                        ";
                        $arrayAnswersID = GetAnswersID($connect,$item1,$variant);
                        foreach ($arrayAnswersID as $item2){
                            $Img2=base64_encode(GetAnswerImage($connect,$item2));
                            $AText= GetAnswersText($connect,$item2);
                            echo"
                                <table>
                                    <tbody align='center'>
                                        <tr> 
                                            <td>
                                                <input type='radio' name='type1$item1' value='".$item2."'/>
                                            </td>
                                            <td>
                                                <textarea readonly class='ansText'>$AText</textarea>
                                            </td>
                            ";
                                            if($Img2!=NULL){
                                                echo"
                                                    <td>
                                                        <p><img src='data:image/*;base64, $Img2' style=' height: 200px; width: 200px;'/> 
                                                    </td>
                                                ";
                                            }
                            echo"
                                        </tr>  
                                    </tbody>
                                </table>
                            ";
                        };
                        echo"<br>";
                    }
//--------------------------------------------------------------------------------------------------------------------------------------------------------
                    elseif($questionType==2)
                    {
                        $QText=GetQuestionText($connect,$item1);
                        echo"
                            <table border='1'>
                                <tbody align='center'>
                                    <tr>
                                        <td>
                                            <h3>Задание №".$i."</h3>
                                        </td>
                                        <td>
                                            <textarea readonly class='queText'>$QText</textarea>
                                        </td>
                        ";
                                        $i++;   
                                        if($Img!=NULL){
                                            echo"
                                                <td>
                                                    <p><img src='data:image/*;base64, $Img' style=' height: 300px; width: 300px;'/> 
                                                </td>
                                            ";
                                        }
                        echo"
                                    </tr>
                                </tbody>
                            </table>
                        ";
                        $arrayAnswersID = GetAnswersID($connect,$item1,$variant);
                        $j=1;
                        foreach ($arrayAnswersID as $item2){
                            $AText= GetAnswersText($connect,$item2);
                            echo"
                                <table>
                                    <tbody align='center'>
                                        <tr> 
                                            <td>
                                                $j) <input type='text' class='InputData'  id='textin' name='type2$item2' value=''>
                                            </td>
                                        </tr>  
                                    </tbody>
                                </table>
                            ";
                            $j++;
                        };
                        echo"<br>";
                    }
//--------------------------------------------------------------------------------------------------------------------------------------------------------
                    else
                    {
                        $QText=GetQuestionText($connect,$item1);
                        echo"
                            <table border='1'>
                                <tbody align='center'>
                                    <tr>
                                        <td>
                                            <h3>Задание №".$i."</h3>
                                        </td>
                                        <td>
                                            <textarea readonly class='queText'>$QText</textarea>
                                        </td>
                        ";
                                        $i++;   
                                        if($Img!=NULL){
                                            echo"
                                                <td>
                                                    <p><img src='data:image/*;base64, $Img' style=' height: 300px; width: 300px;'/> 
                                                </td>
                                            ";
                                        }
                        echo"
                                    </tr>
                                </tbody>
                            </table>
                        ";
                        echo"
                            <table>
                                <tbody align='center'>
                                    <tr> 
                                        <td>
                                            <textarea class='ansText' name='type3$item1'>Сюда пишем ответ</textarea>
                                        </td>
                                        <td>
                                            <p style='text-align:center;font-size: 20px;'><b>Загрузить картинку</b><br><input type='file' name='img_ver$item1'></p>
                                        </td>
                                    </tr>  
                                </tbody>
                            </table>
                        ";
                        echo"<br>";
                    }
                };
                session_write_close();
            ?>
        </div>
        <input  type="submit" class="but" name="end" value="Завершить тестирование"/>
    </form>

</body>
<link rel="stylesheet" href="Style/Testing.css">
</html>