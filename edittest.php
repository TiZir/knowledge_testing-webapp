
<!DOCTYPE html>
<html lang="en, ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Editor</title>
    <script src="/TestingSystem/help.js"></script> 

</head>
<?php
        include('menut.php');
?>
<body>
    <form  class="Split1 Left">
        <div id="sidebar">
				<?php include("sidebaredit.php"); ?>
		</div>
    </form>

    <div class="Split2 Right" >
        <?php

            $var=$_SESSION['СhoiceVar'];
            $shortn=GetQuestionShortText($connect,$_GET['id']);
            $qutext=GetQuestionText($connect,$_GET['id']);
            $wtest=GetQuestionWeight($connect,$_GET['id']);
            $_SESSION["qt"]=GetQuestionType($connect,$_GET['id']);
            if($_SESSION["qt"]==1){
                $QT='Задание закрытой формы';
            }
            elseif($_SESSION["qt"]==2){
                $QT='Задание полуоткрытой формы';
            }
            else{
                $QT='Задание открытой формы';
            }
            $nowQu=$_GET['id'];
            if($_GET['id']!=null)
            {
                $Img=base64_encode(GetQuestionImage($connect,$_GET['id']));
            }
            echo"<form  action='add_del_upd.php?id=$nowQu' method='post' enctype='multipart/form-data'>";
            if($Img!=NULL){
                echo"
                    <div id='queedit'>
                                <p>Номер варианта<br><input class='InputData' type='text' id='textin' name='varitem' value='$var'></p>
                                <p>Короткое имя<br><input class='InputData' type='text' id='textin' name='schortitem' value='$shortn'></p>
                                <p>Форма задания<br><br><font style='font-weight: normal;'>".$QT."</font></p>
                                <p>Количество баллов<br><input class='InputData' type='text' id='textin' name='weightitem' value='$wtest'></p>
                    </div>
                    <p style='text-align:center;font-size: 20px;'><b>Загрузить картинку</b><br><input type='file' name='img_qu'></p>
                    <div id='queedit2new'>
                            <p>Текст задания<br><textarea class='editqueText' name='quesitem'>$qutext</textarea></p>
                            <p><img src='data:image/*;base64, $Img' style=' height: 300px; width: 300px;'/> 
                            <br><br><input  type='submit' name='imgdel' class='but' value='Удалить'></p>
                    </div>
                    <div class='butgroup'>
                        <button class='but'  name='open' type='submit' >Закрытая форма</button>
                        <button class='but'  name='openclose' type='submit' >Полуоткрытая форма</button>
                        <button class='but'  name='close' type='submit' >Открытая форма</button>
                     </div> 
                ";
            }
            else{
                echo"
                    <div id='queedit'>
                                <p>Номер варианта<br><input class='InputData' type='text' id='textin' name='varitem' value='$var'></p>
                                <p>Короткое имя<br><input class='InputData' type='text' id='textin' name='schortitem' value='$shortn'></p>
                                <p>Форма задания<br><br><font style='font-weight: normal;'>".$QT."</font></p>
                                <p>Количество баллов<br><input class='InputData' type='text' id='textin' name='weightitem' value='$wtest'></p>
                    </div>
                    <p style='text-align:center;font-size: 20px;'><b>Загрузить картинку</b><br> <input type='file' name='img_qu'></p>
                    <div id='queedit2'>
                            <p>Текст задания<br><textarea class='editqueText' name='quesitem'>$qutext</textarea></p>
                            <div class='butgroup'>
                            <button class='but'  name='open' type='submit' >Закрытая форма</button>
                            <button class='but'  name='openclose' type='submit' >Полуоткрытая форма</button>
                            <button class='but'  name='close' type='submit' >Открытая форма</button>
                            </div>  
                    </div>
                ";
            }
            // <p>Тип вопроса <br><input type='range' id='qut' onchange='rangeElem();' min='1' max='3' step='1' value='$qutype'></p>
            $arrayAnswersID = GetAnswersID($connect,$_GET['id']);
            $_SESSION["an"]=$arrayAnswersID;
            session_write_close();
            $i=0;
            if($_SESSION['qt']==1){
                foreach ($arrayAnswersID as $item){
                    $antext=GetAnswersText($connect,$item);
                    $antf=GetAnswersTrueFalse($connect,$item);
                    echo"
                        <div class='ansone'>
                            <table style='width: 100%;'>
                                <tbody>
                                    <tr>
                                    "; 
                                    if($antf){
                                        echo"
                                        <td align='center' style='width: auto;'>
                                            <input type='radio' name='rad".$_GET['id']."' checked value='$item'/>
                                        </td>
                                        ";
                                    }
                                    else{
                                        echo"
                                        <td align='center' style='width: auto;'>
                                            <input type='radio' name='rad".$_GET['id']."' value='$item'/>
                                        </td>
                                        ";
                                    }
                                    echo"
                                        <td style='width: auto;'>
                                            <textarea class='ansText' name='ans$item'>$antext</textarea>
                                        </td>
                                    ";
                                        $Img2=base64_encode(GetAnswerImage($connect,$item));

                                        if($Img2!=NULL){
                                            echo"
                                                <td style='width: auto;'>
                                                    <img src='data:image/*;base64, $Img2' style=' height: 200px; width: 200px;'/><br>
                                                    <input type='file' name='img_an$item'><br><br><input  type='submit' name='imgdela$item' value='Удалить'>
                                                </td>
                                            ";
                                        }
                                        else{
                                            echo"
                                            <td style='width: auto;'>
                                                <input type='file' name='img_an$item'>
                                            </td>
                                        ";
                                        }

                                    echo"
                                        <td style='width: auto;'>
                                            <button class='but'  type='submit' onclick='return confirm('Вы точно хотите удалить статью?')' name='del$item' value='$item'>Удалить</button>
                                        </td>
                                    </tr>  
                                </tbody>
                            </table>
                        </div>
                        ";
                }
                        echo"
                        <div class='butgroup'>
                            <input  type='submit' name='add' class='but' value='Добавить'>
                            <input  type='submit' name='upd' class='but' value='Сохранить'/>
                        </div>
                        ";
            }
            if($_SESSION['qt']==2){
                foreach ($arrayAnswersID as $item){
                    $antext=GetAnswersText($connect,$item);
                    $antf=GetAnswersTrueFalse($connect,$item);
                    echo"
                        <div class='anstwo'>
                            <table style='width: 100%'>
                                <tbody>
                                    <tr>
                                        <td align='center'>
                                            <input class='InputData' type='text' id='textin' name='ans$item' value='$antext'>
                                        </td>
                                        <td>
                                            <button class='but'  type='submit' onclick='return confirm('Вы точно хотите удалить статью?')' name='del$item' value='$item''>Удалить</button>
                                        </td>
                                    </tr>  
                                </tbody>
                            </table>
                        </div>
                    ";
                }
                echo"
                <div class='butgroup'>
                    <input  type='submit' name='add' class='but' value='Добавить'>
                    <input  type='submit' name='upd' class='but' value='Сохранить'/>
                </div>
                ";
            }//div
            elseif($_SESSION['qt']==3){
                    echo"
                    <div class='butgroup'>
                        <input  type='submit' name='upd' id='updthree' class='but' value='Сохранить'/>
                    </div>
                    ";
            }//div
            echo"</form>";
        ?>
     </div>
</body>
<script>
	if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
	}
</script>
</html>