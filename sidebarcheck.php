<?php
        include('functions.php');
?>
<div>
    <?php
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
            echo"<select name='SelectGroup' id='SelectGroup'  autofocus>
                <option disabled>Группа</option>
                ";
                foreach ($arrayGroupsID as $item2){
                    $GroupName=GetGroupName($connect,$item2);
                        if($flagfirts){
                            echo "<option id='OptionSelect' value='".$item2."' ".(($item2==$_SESSION['NowGroup'])?"selected='selected'":'').">".$GroupName."</option>";
                            $flagfirts=false;
                        }
                        else{
                            echo "<option  id='OptionSelect' value='".$item2."' ".(($item2==$_SESSION['NowGroup'])?"selected='selected'":'').">".$GroupName."</option>";
                        }
                }
            echo"</select>";
            echo"<input formaction='' formmethod='post' type='submit'  name='choose_item'  class='but' value='Выбрать' />";
        echo"</div>";

        $arrayStudentsID=GetStudentsID($connect,$_SESSION['NowGroup']);
        $namepage='verification';
        echo"<div class='stud' name='stud'>";
        foreach ($arrayStudentsID as $item3){
            $NameStudent=GetStudentName($connect,$item3);
            if ($_GET['ids']==$item3){
                echo "<p>&#10148;<a id='a_sidebar' href=\"$namepage.php?ids=$item3\">$NameStudent</a></p>";
            }
            else
            {
                echo "<p><a id='a_sidebar' href=\"$namepage.php?ids=$item3\">$NameStudent</a></p>";
            }
        }
        echo"	
        </div>
        ";
        ?>
</div>
