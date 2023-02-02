<!DOCTYPE html>
<html lang="en, ru">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="Style/favicon/favicon.ico" type="image/x-icon">
    <title>Authorization in the Testing System as a student</title>
</head>
	<body>
		<form  class="Split1 Left" action="loginstud.php" method="post">
			<a href="https://mpei.ru/Pages/default.aspx" class="logo">
				<img src="/TestingSystem/Style/logo2.png" alt="Логотип создателя">
			</a>
			<div class="LeftPart">

				<h1>Вход для студентов</h1>

				<div class="InputData">
					<input type="text" id="nameEnt" placeholder="Логин" name="NameAuthorization" required >
					<input type="password" id="passEnt" placeholder="Пароль" name="PasswordAuthorization" required >
				</div>

				<button type="submit">Вход</button>

				<div class="TeacherLink">
					<a href="/TestingSystem/teacherenter.php">Вход для преподавателей</a>
				</div>

			</div>
		</form>
		<div class="Split2 Right RightPart">
		</div>
	</body>
	<link rel="stylesheet" href="Style\Authorization.css">
</html>