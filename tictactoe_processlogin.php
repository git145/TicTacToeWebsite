 <!DOCTYPE html> 

 <html lang = "en">
 
     <!--
         File: tictactoe_processlogin.php
         Module: COMP519
         Author: Richard Kneale
         Student ID: 200790336
         Date created: 1st January 2016
         Description: Manages the logging in of the user
       -->

     <head> 
         <meta charset = "utf-8"/>
         <title id = "pageTitle">Tic Tac Toe - Welcome</title>
         <link rel = "stylesheet" type = "text/css" href = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_style.css" title = "styles"/>
         <script type = "text/javascript" src = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe.js"></script>
         
         <?php
             // Include attributes to access the database
             require_once("tictactoe_functions.php");
			 
             // If a login form was just submitted
             if(isset($_POST["submit"]))
             { 
                 // PERFORM THE QUERY
                 // Create an object to represent the database
                 $db = new mysqli($db_host, $db_login, $db_password, $db_database);
                 
                 // If there is a connection to the database and the form has been completed correctly
                 if ($db && ($_POST["inputUserEmail"] != "") && ($_POST["inputPassword"] != ""))
                 {
                     // Prepend backslashes to make the data safe
                     $clean["inputUserEmail"] = mysqli_real_escape_string($db, $_POST["inputUserEmail"]);
                     $clean["inputPassword"] = mysqli_real_escape_string($db, $_POST["inputPassword"]);
                     
                     // Write the database query to insert the new user
                     $sql = "SELECT * FROM ".$table." WHERE password = '".$clean["inputPassword"]."' AND (username = '".$clean["inputUserEmail"]."' OR email = '".$clean["inputUserEmail"]."')";
                     
                     // Perform the query
                     $result = $db->query($sql);
                     
                     // Check whether the data matches a known user
                     if ($result->num_rows != 0)
                     {
                         // Seek to row 1
                         $result->data_seek(0);

                         // Fetch the row
                         $row = $result->fetch_row();
                         
                         // Get references to the user name and token color
                         $user = $row[0];
						 $color = $row[3];
                         
                         // Set cookies to ensure that user is active. Cookie lasts 24 hours.
                         setcookie("user", $user, time()+$cookieTime);
						 setcookie("color", $color, time()+$cookieTime);
						 
                         // Redirect to the menu
                         print('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_menu.php";</script>');
                     }
                 }
             }
         ?>
     </head>
     
     <body>
         <?php
             // CATCH AND REPORT ERRORS
             // If a login form was not just submitted
             if (!(isset($_POST["submit"])))
             { 
                 printLoginForm($defaultUser, "You did not visit the login page.");
             }
             
             // If there is no connection to the database
             else if (!$db)
             {
                 printLoginForm($_POST["inputUserEmail"], "Could not connect to the database.");
             }
                 
             // Username/e-mail was empty
             else if ($_POST["inputUserEmail"] == "")
             {
                 printLoginForm($defaultUser, "You did not enter a username or e-mail address.");
             }
                 
             // Password was empty
             else if ($_POST["inputPassword"] == "")
             {
                 printLoginForm($_POST["inputUserEmail"], "You did not enter a password.");
             }
             
             // The data does not match a known user
             else if ($result->num_rows == 0)
             {
                 printLoginForm($defaultUser, "This user does not exist.");
             }
         ?>
     </body>
 </html>