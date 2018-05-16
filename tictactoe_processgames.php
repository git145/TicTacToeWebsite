 <!DOCTYPE html> 

 <html lang = "en">
 
     <!--
         File: tictactoe_processgames.php
         Module: COMP519
         Author: Richard Kneale
         Student ID: 200790336
         Date created: 1st January 2016
         Description: Processes the number of games entered by the user
       -->

     <head> 
         <meta charset = "utf-8"/>
         <title id = "pageTitle">Tic Tac Toe - Menu</title>
         <link rel = "stylesheet" type = "text/css" href = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_style.css" title = "styles"/>
         <script type = "text/javascript" src = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe.js"></script>
		 
		 <?php
			 // Import custom functions
			 require_once("tictactoe_functions.php");
			 
			 // Redirect to login page is user is not logged in
			 if (!(isset($_COOKIE["user"])))
			 {
				 print ('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_login.php";</script>');
			 }
			 
			 // If the user entered a valid integer
			 else if ((isset($_POST["inputNumberOfGames"])) && (is_numeric($_POST["inputNumberOfGames"])) && (((int)($_POST["inputNumberOfGames"])) >= 1))
			 {
				 // Set the number of games as a cookie. Cookie lasts 24 hours.
				 setcookie("numberOfGames", ((int)($_POST["inputNumberOfGames"])), time()+$cookieTime);
				 
				 // Redirect to the game page
				 print ('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_game.php";</script>');
			 }
		 ?>
     </head>
     
     <body>
         <?php
			 // Redirect to menu page if user has not selected to start a game
			 if (!(isset($_POST["inputNumberOfGames"])))
			 {
				 printMenuForm($numberOfGames, "You did not start a game.");
			 }
			 
			 // User did not enter a number
			 else if (!(is_numeric($_POST["inputNumberOfGames"])))
			 {
				 printMenuForm($numberOfGames, "You did not enter a number.");
			 }
			 
			 // Number of games was not at least 1
			 else if (((int)$_POST["inputNumberOfGames"]) < 1)
			 {
				 printMenuForm($numberOfGames, "You must play at least one game.");
			 }
		 ?>
     </body>
 </html>