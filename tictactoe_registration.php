 <!DOCTYPE html> 

 <html lang = "en">
 
     <!--
         File: tictactoe_registration.php
         Module: COMP519
         Author: Richard Kneale
         Student ID: 200790336
         Date created: 1st January 2016
         Description: Allows the user to register for the website
       -->

     <head> 
         <meta charset = "utf-8"/>
         <title id = "pageTitle">Tic Tac Toe - Registration</title>
         <link rel = "stylesheet" type = "text/css" href = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_style.css" title = "styles"/>
         <script type = "text/javascript" src = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe.js"></script>
     </head>
     
     <body>
         <?php
			 // Print the registration form
			 require_once("tictactoe_functions.php");
			 printRegistrationForm($defaultUser, $defaultEmail, $defaultColor, "");
		 ?>
     </body>
 </html>