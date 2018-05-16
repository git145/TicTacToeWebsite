 <!DOCTYPE html> 

 <html lang = "en">
 
     <!--
         File: tictactoe_menu.php
         Module: COMP519
         Author: Richard Kneale
         Student ID: 200790336
         Date created: 1st January 2016
         Description: Displays a menu page to the user
       -->

     <head> 
         <meta charset = "utf-8"/>
         <title id = "pageTitle">Tic Tac Toe - Menu</title>
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
			 
			 printMenuForm($numberOfGames, "");
		 ?>
     </body>
 </html>