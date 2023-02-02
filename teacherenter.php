<!DOCTYPE html>
<html lang="en, ru">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="Style/favicon/favicon.ico" type="image/x-icon">
    <title>Authorization in the Testing System as a Teacher</title>
</head>
	<body>
        <header>
            <img src="/TestingSystem/Style/logo2.png"/>
        </header>
        <main class="teacherlogin">
            <form  action="loginteach.php" method="post">
                <h1>Вход для преподавателей</h1>
                <div class="InputData">
                    <input type="text" id="nameEnt" placeholder="Логин" name="NameAuthorization" required >
                    <input type="password" id="passEnt" placeholder="Пароль" name="PasswordAuthorization" required >
                </div>
                <button type="submit">Вход</button>
            </form>
        </main>
	</body>
	<link rel="stylesheet" href="Style\Authorization.css">
</html>