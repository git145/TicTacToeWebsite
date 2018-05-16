 <!DOCTYPE html> 

 <html lang = "en">
 
     <!--
         File: tictactoe_useredit.php
         Module: COMP519
         Author: Richard Kneale
         Student ID: 200790336
         Date created: 1st January 2016
         Description: Allows the user to update their preferences
       -->

     <head> 
         <meta charset = "utf-8"/>
         <title id = "pageTitle">Tic Tac Toe - Edit Preferences</title>
         <link rel = "stylesheet" type = "text/css" href = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_style.css" title = "styles"/>
         <script type = "text/javascript" src = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe.js"></script>
		 
		 <?php
			 // Redirect to login page is user is not logged in
			 if (!(isset($_COOKIE["user"])))
			 {
				 print ('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_login.php";</script>');
			 }
		 ?>
     </head>
     
     <body>
         <?php
			 // Import custom functions
			 require_once("tictactoe_functions.php");
			 printEditPreferencesForm($_COOKIE["color"], "");
		 ?>
     </body>
 </html>