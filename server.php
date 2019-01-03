<?php 
	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$folder_name = "";
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'wolfmania');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		$folder_name = mysqli_real_escape_string($db, $_POST['folder_name']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }
		if (empty($folder_name)) { array_push($errors, "Name of gallery is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, email, password,folder_name) 
					  VALUES('$username', '$email', '$password','$folder_name')";
			
			$query1 = "CREATE TABLE `$folder_name` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					`uploaded_on` datetime NOT NULL,
					`status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
					`AFTER` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					`std` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";		  
					  
					  
			mysqli_query($db, $query);
			mysqli_query($db, $query1);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: index2.php');
			
	

			mkdir($_POST['folder_name']);


		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: index2.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

?>