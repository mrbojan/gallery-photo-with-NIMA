
<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>ok</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link rel="stylesheet" href="style2.css" type="text/css" />
</head>

<body>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<header>

<nav class="navbar navbar-dark bg-dark navbar-expand-md" >

		<a class="navbar-brand" href="index2.php"><img src="img/logo1.png" width="30" height="30" alt=""> Galeria</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu"
		aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
			<span class="navbar-toggler-icon" display="none">
			</span>
		</button>
		
		<div class="collapse navbar-collapse" id="mainmenu">
		<form action="" method="post" enctype="multipart/form-data">
			<ul class="navbar-nav">
				<li class="nav-item">
					<input type="file" class="btn" name="files[]" multiple >
				</li>
				<li class="nav-item">
					<input type="submit" class="btn" name="submit" value="Dodaj zdjęcia">
				</li>
				<li class="nav-item">
					<input type="submit" class="btn" name="filtr" value="Filtruj zdjęcia">
				</li>
				
				<li class="nav-item">
					<input type="submit" class="btn" name="wyloguj" value="Wyloguj">
			
				
			</ul>
		</form>
		
		</div>
		
	
		
		
	
</nav>
		<header>
		
<?php include 'upload.php'; ?>
		

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script type="text/javascript" src="show.js"></script>

</body>
</html>

