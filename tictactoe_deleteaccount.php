 <!DOCTYPE html> 

 <html lang = "en">
 
     <!--
         File: tictactoe_deleteaccount.php
         Module: COMP519
         Author: Richard Kneale
         Student ID: 200790336
         Date created: 1st January 2016
         Description: Manages the deletion of a user's account
       -->

     <head> 
         <meta charset = "utf-8"/>
         <title id = "pageTitle">Tic Tac Toe - Delete Account</title>
         <link rel = "stylesheet" type = "text/css" href = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_style.css" title = "styles"/>
         <script type = "text/javascript" src = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe.js"></script>
         
         <?php
			 // Redirect to login page if user isn't logged in
			 if (!(isset($_COOKIE["user"])))
			 {
				 print ('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_login.php";</script>');
			 }
			 
			 else
			 {
                 // Include attributes to access the database
				 require_once("tictactoe_functions.php");
				 
				 // PERFORM THE QUERY
                 // Create an object to represent the database
                 $db = new mysqli($db_host, $db_login, $db_password, $db_database);
                 
                 // Prepend backslashes to make the data safe
                 $clean["user"] = mysqli_real_escape_string($db, $_COOKIE["user"]);
                     
                 // Write the database query to insert the new user
                 $sql = "DELETE FROM ".$table." WHERE username = '".$clean["user"]."'";
                     
                 // Perform the query
                 $result = $db->query($sql);
				 
				 //Close the connection to the database server (to ensure the information is stored properly)
				 $db->close();
				 
				 // Delete the cookies
				 setcookie("user", $user, time()-$cookieTime);
				 setcookie("color", $color, time()-$cookieTime);
                     
				 // Redirect to the login page
                 print('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_login.php";</script>');
             }
         ?>
     </head>
     
     <body>
     </body>
 </html>