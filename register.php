<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>ok</title>
	<title>ok</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="register_ss.css">
</head>
<body>
<div class="register">

	<h2>Stwórz nowe konto</h2>

	<form method="post" action="register.php">

		<?php include('errors.php'); ?>

			<input type="text" name="username" placeholder="nazwa użytkownika">


			<input type="email" name="email" placeholder="email">


			<input type="password" name="password_1" placeholder="hasło">

			<input type="password" name="password_2" placeholder="powtórz hasło">

			<input type="text" name="folder_name" placeholder="nazwa twojej galerii">

			<button type="submit" class="btn" name="reg_user">Zarejestruj się</button>


		    <a class="login" href="login.php">Logowanie</a>

	</form>
</div>
</body>
</html>