 <!DOCTYPE html> 

 <html lang = "en">
 
     <!--
         File: tictactoe_login.php
         Module: COMP519
         Author: Richard Kneale
         Student ID: 200790336
         Date created: 1st January 2016
         Description: Prints the page from which a user can log in
       -->

     <head> 
         <meta charset = "utf-8"/>
         <title id = "pageTitle">Tic Tac Toe - Welcome</title>
         <link rel = "stylesheet" type = "text/css" href = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_style.css" title = "styles"/>
         <script type = "text/javascript" src = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe.js"></script>
		 
		 <?php
			
			 // Import custom functions
			 require_once("tictactoe_functions.php");
				 
			 // Redirect to menu page if user is already logged in
			 if ((isset($_COOKIE["user"])))
			 {
				 print ('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_menu.php";</script>');
			 }
		 ?>
     </head>
     
     <body>
         <?php
			 // Print the login form
			 printLoginForm($defaultUser, "");
		 ?>
     </body>
 </html>