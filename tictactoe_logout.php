 <!DOCTYPE html> 

 <html lang = "en">
 
     <!--
         File: tictactoe_logout.php
         Module: COMP519
         Author: Richard Kneale
         Student ID: 200790336
         Date created: 1st January 2016
         Description: Manages the logging out of a user
       -->

     <head> 
         <meta charset = "utf-8"/>
         <title id = "pageTitle">Tic Tac Toe - Welcome</title>
         <link rel = "stylesheet" type = "text/css" href = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_style.css" title = "styles"/>
         <script type = "text/javascript" src = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe.js"></script>
		 
		 <?php
			
			 // Import custom functions
			 require_once("tictactoe_functions.php");
			 
			 // Clear cookies and redirect to login page
			 if ((isset($_COOKIE["user"])))
			 {
				 setcookie("user", $user, time()-$cookieTime);
				 setcookie("color", $user, time()-$cookieTime);
				 print ('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_login.php";</script>');
			 }
				 
			 // Redirect to the login page
			 else
			 {
				 print ('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_login.php";</script>');
			 }
		 ?>
     </head>
     
     <body>
     </body>
 </html>