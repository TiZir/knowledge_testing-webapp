<?php
        include('functions.php');
?>
<div>
    <?php
		
	    if(isset($_POST['SelectVar'])){
			$_SESSION["СhoiceVar"]=$_POST['SelectVar'];
		}

		if(isset($_POST['add_item'])){
			if($_SESSION['СhoiceVar']==NULL){
				$_SESSION["СhoiceVar"]=1;
			}
            AddQuestion($connect,$_SESSION['СhoiceVar'],$_SESSION['NowTest'], 'NULL',"Заполните текст вопроса", 'NULL', $_SESSION['qt'],0);
			//exit("<meta http-equiv='refresh' content='0'>");
			exit("<meta http-equiv='refresh' content='0; url= /TestingSystem/edittest.php'>");
			//header('location:resultcheck.php');
        }

		if(isset($_POST['delete_item'])){
            DeleteQuestion($connect, $_GET['id']);
			exit("<meta http-equiv='refresh' content='0; url= /TestingSystem/edittest.php'>");
			//header('location:resultcheck.php');
        }

		if(isset($_POST['сhange'])){
            UpdateTest($connect, $_SESSION['NowTest'], $_POST['tname'], $_POST['ttime'],$_POST['tstate']);
			exit("<meta http-equiv='refresh' content='0; url= /TestingSystem/edittest.php'>");
			//header('location:resultcheck.php');
        }

		$arrayTestsID = GetTestsID($connect);
		$VarSelected= GetQuestionVariants($connect,$_SESSION['NowTest']);
		$testName= GetTestName($connect,$_SESSION['NowTest'],0);
		$testStatus= GetTestStatus($connect,$_SESSION['NowTest']);
		$testTime= GetTestTime($connect,$_SESSION['NowTest']);
		echo"
			<div class='tes' name='tes'>
				<form method='post'>
					<p>Название теста<br><input class='InputData' type='text' id='textin' name='tname' value='$testName'></p>
					<p>Длительности теста<br><input class='InputData' type='text' id='textin' name='ttime' value='$testTime'></p>
					<div class='form_toggle'>
						<div class='form_toggle-item item-1'>
							<input id='fid-1' type='radio' name='tstate' value='true' ".(($testStatus==1)?"checked":"").">
							<label for='fid-1'>Тест работает</label>
						</div>
						<div class='form_toggle-item item-2'>
							<input id='fid-2' type='radio' name='tstate' value='false'  ".(($testStatus==0)?"checked":"").">
							<label for='fid-2'>Тест в разработке</label>
						</div>
					</div>
					<input formaction='' formmethod='post' type='submit'  name='сhange'  class='but' value='Изменить' />
				</from>
			</div>
		";


		echo"<div class='var' name='var'>";
			echo"<form  action=''  method='post'>";
				echo"<select name='SelectVar' id='SelectTest' size='".count($VarSelected)."' autofocus>";
					foreach ($VarSelected as $item0){
						echo "<option id='OptionSelect'  value='".$item0."' ".(($item0==$_SESSION['СhoiceVar'])?"selected='selected'":'').">Вариант ".$item0."</option>";
					}
				echo"</select>";
				echo"<input formaction='' formmethod='post' type='submit'  name='choose_item'  class='but' value='Выбрать' />";
			echo"</form>";
		echo"</div>";

		$arrayQuestionsID = GetQuestionsID($connect,$_SESSION['NowTest'],$_SESSION['СhoiceVar']);
        $_SESSION["qu"]=$arrayQuestionsID;
		$i=1;
		$namepage="edittest";

		echo"<div class='que' name='que'>";
			foreach ($arrayQuestionsID as $item1){
				if($_GET['id']==null){
					$_GET['id']=$item1;
					echo "<p>&#10148;<a id='a_sidebar' href=\"$namepage.php?id=$item1\">Задание $i</a></p>";
					$i++;
				}

				elseif ($_GET['id']==$item1){
					echo "<p>&#10148;<a id='a_sidebar' href=\"$namepage.php?id=$item1\">Задание $i</a></p>";
					$i++;
				}
				else{
					echo "<p><a id='a_sidebar' href=\"$namepage.php?id=$item1\">Задание $i</a></p>";
					$i++;
				}
			}
		echo"	
			<form class='butgroup' method='post'>
				<button type='submit' class='but' name='add_item'>Добавить</button>
				<button type='submit' class='but' name='delete_item'>Удалить</button>
			</form>
		</div>
		";
	?>
</div>
