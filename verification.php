<?php
    include('menut.php')
?>
<!DOCTYPE html>
<html lang="en, ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checking responses</title>
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
            padding: 10px 20px 10px 15px;
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
        <div id="sidebar">
				<?php include("sidebarcheck.php"); ?>
		</div>
    </form>
    <div class="Split2 Right">
        <?php
        clearstatcache();
        $nowSt=$_GET['ids'];
        if ($nowSt==NULL)
        {
            echo"
                <table class='iksweb'>
                <thead>
                    <tr>
                        <th>Вопрос</th>
                        <th>Ответ</th>
                        <th>Проверка</th>
                    </tr>
                </thead>
                </table>
            ";
        }
        else
        {
            echo"
            <form id='sidebar' action='check_yesno.php?ids=$nowSt' method='post'>
                <table class='iksweb'>
                <thead>
                    <tr>
                        <th>Вопрос</th>
                        <th>Ответ</th>
                        <th>Проверка</th>
                    </tr>
                </thead>
            ";
            $arrayVerificationID= GetVerificationsID($connect,$nowSt,$_SESSION['NowTest']);
            $_SESSION["ver"]=$arrayVerificationID;
            foreach ($arrayVerificationID as $item){
                $vertext=GetVerificationText($connect,$item);
                $queidinver=GetInVerificationQuestionID($connect,$item);
                $quetext= GetQuestionText($connect,$queidinver);
                $ImgQ=base64_encode(GetQuestionImage($connect,$queidinver));
                $Img=base64_encode(GetVerificationImage($connect,$item));
                echo"
                    <tbody>
                        <tr>
                            <td >
                            <textarea readonly class='queText' name='que$queidinver'>$quetext</textarea>
                ";
                            if($ImgQ!=NULL){
                                echo"<p><img src='data:image/*;base64, $ImgQ' style=' height: 200px; width: 200px;'/></p>";
                            }
                echo"
                            </td>
                            <td >
                                <textarea readonly class='verText' name='ver$item'>$vertext</textarea>
                "; 
                                if($Img!=NULL){
                                    echo"<p><img src='data:image/*;base64, $Img' style=' height: 200px; width: 200px;'/></p>";
                                 }
                echo"
                            </td>
                            <td align='center'>
                                <button style='display:block; font-size:18px;  margin-bottom:20px ;'  type='submit' onclick='return confirm('Пометить, как правильный ответ?')' name='yes$item' value='$item'>
                                    &#10004;
                                </button>
                                <button  style='font-size:18px;' type='submit' onclick='return confirm('Пометить, как ошибку?')' name='no$item' value='$item'>
                                &#10006;
                                </button>
                            </td>
                        </tr>  
                    </tbody>
                ";
            }
            echo"</table>";
        }
            ?>
        </form>    
    </div>
</body>
</html>