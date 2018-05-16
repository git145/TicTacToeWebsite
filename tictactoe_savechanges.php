 <!DOCTYPE html> 

 <html lang = "en">
 
     <!--
         File: tictactoe_savechanges.php
         Module: COMP519
         Author: Richard Kneale
         Student ID: 200790336
         Date created: 1st January 2016
         Description: Saves the user's preferences to the database
       -->

     <head> 
         <meta charset = "utf-8"/>
         <title id = "pageTitle">Tic Tac Toe - Edit Preferences</title>
         <link rel = "stylesheet" type = "text/css" href = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_style.css" title = "styles"/>
         <script type = "text/javascript" src = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe.js"></script>
         
         <?php
             // Include attributes to access the database
             require_once("tictactoe_functions.php");
			 
			 // Set a blank error message
			 $errorMessage = "";
             
             // If an edit preferences form was just submitted and a user is logged in
             if (isset($_POST["submit"]) && isset($_COOKIE["user"]))
             { 
                 // Create an object to represent the database
                 $db = new mysqli($db_host, $db_login, $db_password, $db_database);
                 
                 // If there is a connection to the database
                 if ($db)
                 {
					 // Prepend backslashes to make the data safe
                     $clean["user"] = mysqli_real_escape_string($db, $_COOKIE["user"]);
					 
					 // If the user has made an attempt to change the e-mail address
					 if (!($_POST["inputEmail"] == ""))
					 {
						 // User has changed e-mail address correctly
						 if ((!($_POST["inputEmail"] == "")) && ($_POST["inputEmail"] == $_POST["inputRepeatEmail"]))
						 {
							 // Prepend backslashes to make the data safe
							 $clean["inputEmail"] = mysqli_real_escape_string($db, $_POST["inputEmail"]);
						 
							 // Write the database query to change the user's e-mail address
							 $sql = "UPDATE ".$table." SET email = '".$clean["inputEmail"]."' WHERE username = '".$clean["user"]."'";
                     
							 // Perform the query
							 $result = $db->query($sql);
						 
							 $errorMessage = $errorMessage."\nE-mail address changed.";
						 }
						 
						 // E-mail addresses don't match
						 else if (!($_POST["inputEmail"] == $_POST["inputRepeatEmail"]))
						 {
							 $errorMessage = $errorMessage."\nE-mail addresses don't match. E-mail address not changed.";
						 }
					 }
						
					 // If the user has made an attempt to change the password
					 if ((!($_POST["inputOldPassword"] == "")) && (!($_POST["inputPassword"] == "")))
					 {
						 // GET USERS OLD PASSWORD
						 $sql = "SELECT * FROM ".$table." WHERE username = '".$clean["user"]."'";
						 
						 // Perform the query
						 $result = $db->query($sql);
						 
						 // Seek to row 1
                         $result->data_seek(0);

                         // Fetch the row
                         $row = $result->fetch_row();
						 
						 // Get the user's old password
						 $oldPassword = $row[$PASSWORD];
						 
						 // User has changed password correctly
						 if ((!($_POST["inputPassword"] == "")) && ($_POST["inputPassword"] == $_POST["inputRepeatPassword"]) && ($oldPassword == $_POST["inputOldPassword"]))
						 {
							 $clean["inputPassword"] = mysqli_real_escape_string($db, $_POST["inputPassword"]);
						 
							 // Write the database query to change the user's password
							 $sql = "UPDATE ".$table." SET password = '".$clean["inputPassword"]."' WHERE username = '".$clean["user"]."'";
                     
							 // Perform the query
							 $result = $db->query($sql);
						 
							 $errorMessage = $errorMessage."<br/>Password changed.";
						 }
						 
						 // New and old passwords don't match
						 else if (!($oldPassword == $_POST["inputOldPassword"]))
						 {
							 $errorMessage = $errorMessage."<br/>Old password is incorrect. Password not saved.";
						 }
					 
						 // New passwords don't match
						 else if (!($_POST["inputPassword"] == $_POST["inputRepeatPassword"]))
						 {
							 $errorMessage = $errorMessage."<br/>Passwords don't match. Password not saved.";
						 }
					 }
					
					 else if ((!($_POST["inputOldPassword"] == "")) && ($_POST["inputPassword"] == ""))
					 {
						 $errorMessage = $errorMessage."<br/>You did not input a new password. Password not saved.";
					 }
					 
					 else if (($_POST["inputOldPassword"] == "") && (!($_POST["inputPassword"] == "")))
					 {
						 $errorMessage = $errorMessage."<br/>You did not input your old password. Password not saved.";
					 }
				   
                     
					 $clean["inputColor"] = mysqli_real_escape_string($db, $_POST["inputColor"]);
					 
                     // Write the database query to change the user's token color
                     $sql = "UPDATE ".$table." SET color = '".$clean["inputColor"]."' WHERE username = '".$clean["user"]."'";
                     
                     // Perform the query
                     $result = $db->query($sql);
                     
                     // Set cookie for new token color. Cookie lasts 24 hours.
                     setcookie("color", $_POST["inputColor"], time()+$cookieTime);
					 
					 $errorMessage = $errorMessage."<br/>Token color changed.";
                 }
			 }
         ?>
     </head>
     
     <body>
         <?php
             // CATCH AND REPORT ERRORS
			 // If the user is not logged in
             if (!(isset($_COOKIE["user"])))
			 {
				 // Redirect to the login page
                 print('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_login.php";</script>');
			 }
			 
			 // If an edit preferences form was not just submitted
             else if (!(isset($_POST["submit"])))
             { 
                 // Redirect to the menu page
                 print('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_menu.php";</script>');
             }
             
             // If there is no connection to the database
             else if (!$db)
             {
                 // Redirect to the menu
				 printEditPreferencesForm($_POST["inputColor"], "Database unavailable. Changes not saved.");
             }
			 
			 // If something was saved
			 else
			 {
				 // Redirect to the menu
			     printEditPreferencesForm($_POST["inputColor"], $errorMessage);
			 }
         ?>
     </body>
 </html>