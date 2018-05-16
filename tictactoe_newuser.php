 <!DOCTYPE html> 

 <html lang = "en">
 
     <!--
         File: tictactoe_newuser.php
         Module: COMP519
         Author: Richard Kneale
         Student ID: 200790336
         Date created: 1st January 2016
         Description: Manages the registration of a user
       -->

     <head> 
         <meta charset = "utf-8"/>
         <title id = "pageTitle">Tic Tac Toe - Registration</title>
         <link rel = "stylesheet" type = "text/css" href = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_style.css" title = "styles"/>
         <script type = "text/javascript" src = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe.js"></script>
		 
     </head>
     
     <body>
         <?php
			 // Include attributes to access the database
			 require_once("tictactoe_functions.php");
			 
			 // If the registration form was just submitted
			 if(isset($_POST["submit"]))
			 { 
				 // Create an object to represent the database
				 $db = new mysqli($db_host, $db_login, $db_password, $db_database);
				 
				 // If there is no connection to the database
				 if (!$db)
				 {
					 printRegistrationForm($_POST["inputUser"], $_POST["inputEmail"], $_POST["inputColor"], "Could not connect to the database.");
				 }
				 
				 // Username was empty
				 else if ($_POST["inputUser"] == "")
				 {
					 printRegistrationForm($defaultUser, $_POST["inputEmail"], $_POST["inputColor"], "You did not enter a username.");
				 }
				 
				 // E-mail address was empty
				 else if ($_POST["inputEmail"] == "")
				 {
					 printRegistrationForm($_POST["inputUser"], $defaultEmail, $_POST["inputColor"], "You did not enter an e-mail address.");
				 }
				 
				 // Repeat e-mail address was empty
				 else if ($_POST["inputRepeatEmail"] == "")
				 {
					 printRegistrationForm($_POST["inputUser"], $_POST["inputEmail"], $_POST["inputColor"], "You did not enter a repeat e-mail address.");
				 }
				 
				 // E-mail addresses don't match
				 else if (!($_POST["inputEmail"] == $_POST["inputRepeatEmail"]))
				 {
					 printRegistrationForm($_POST["inputUser"], $defaultEmail, $_POST["inputColor"], "The e-mail addresses did not match.");
				 }
					
				 // Password was empty
				 else if ($_POST["inputPassword"] == "")
				 {
					 printRegistrationForm($_POST["inputUser"], $_POST["inputEmail"], $_POST["inputColor"], "You did not enter a password.");
				 }
				 
				 // Repeat password was empty
				 else if ($_POST["inputRepeatPassword"] == "")
				 {
					 printRegistrationForm($_POST["inputUser"], $_POST["inputEmail"], $_POST["inputColor"], "You did not enter a repeat password.");
				 }
				 
				 // Passwords don't match
				 else if (!($_POST["inputPassword"] == $_POST["inputRepeatPassword"]))
				 {
					 printRegistrationForm($_POST["inputUser"], $_POST["inputEmail"], $_POST["inputColor"], "The passwords did not match.");
				 }
				 
				 // If there is a connection to the database 
				 else
				 {
					 // Prepend backslashes to make the data safe
					 $clean["inputUser"] = mysqli_real_escape_string($db, $_POST["inputUser"]);
					 $clean["inputEmail"] = mysqli_real_escape_string($db, $_POST["inputEmail"]);
					 $clean["inputPassword"] = mysqli_real_escape_string($db, $_POST["inputPassword"]);
					 $clean["inputColor"] = mysqli_real_escape_string($db, $_POST["inputColor"]);
			 
					 // Write the database query to insert the new user
					 $sql = "INSERT INTO ".$table." (username, email, password, color) VALUES ('".$clean["inputUser"]."', '".$clean["inputEmail"]."', '".$clean["inputPassword"]."', '".$clean["inputColor"]."')";
					 
					 // If the query fails
					 if (!($result = $db->query($sql))) // Add the data to the database
					 {
						 // Define queries to ensure whether a duplicate key has been entered
						 $usernameCheck = "SELECT * FROM ".$table." WHERE username = '".$clean["inputUser"]."'";
						 $emailCheck = "SELECT * FROM ".$table." WHERE email = '".$clean["inputEmail"]."'";
						 
						 $usernameCheckResult = $db->query($usernameCheck);
						 $emailCheckResult = $db->query($emailCheck);
						 
						 // Update the error message if a duplicate key has been entered
						 if ($usernameCheckResult->num_rows != 0)
						 {
							 // Print the error message
							 printRegistrationForm($defaultUser, $_POST["inputEmail"], $_POST["inputColor"], "The username is already taken.");
						 }
						 else if ($emailCheckResult->num_rows != 0)
						 {
							 // Print the error message
							 printRegistrationForm($_POST["inputUser"], $defaultEmail, $_POST["inputColor"], "The e-mail address has already been used.");
						 }
						 else // Catch any other error
						 {
							 // Print the error message
							 printRegistrationForm($_POST["inputUser"], $_POST["inputEmail"], $_POST["inputColor"], "Registration failed.");
						 }
					 }
				 
					 // If the query was successful
					 else
					 {
						 // Inform the user that they have been added to the database
						 printRegistrationForm($defaultUser, $defaultEmail, $defaultColor, "Congratulations. You're a new user.");
					 }
				 }
			 }
			 
			 // If the registration form was not just submitted
			 else
			 {
				 // Inform the user
				 printRegistrationForm($defaultUser, $defaultEmail, $defaultColor, "You did not visit the registration page.");
			 }
		 ?>
     </body>
 </html>