 <!DOCTYPE html> 

 <html lang = "en">
 
     <!--
         File: tictactoe_updaterecords.php
         Module: COMP519
         Author: Richard Kneale
         Student ID: 200790336
         Date created: 1st January 2016
         Description: Updates the players' records in the database after they have played a game
       -->

     <head> 
         <meta charset = "utf-8"/>
         <title id = "pageTitle">Tic Tac Toe - Update Records</title>
         <link rel = "stylesheet" type = "text/css" href = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_style.css" title = "styles"/>
         <script type = "text/javascript" src = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe.js"></script>
		 
		 <?php	 
			 // Redirect to login page if user isn't logged in
			 if (!(isset($_COOKIE["user"])))
			 {
				 print ('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_login.php";</script>');
			 }
			 
			 // The user didn't just play a game
			 else if (!(isset($_POST["player1Wins"])))
			 {
				 print ('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_menu.php";</script>');
			 }
			 
			 else
			 {
				 // Include attributes to access the database
				 require_once("tictactoe_functions.php");
			 
				 // Create an object to represent the database
				 $db = new mysqli($db_host, $db_login, $db_password, $db_database);
				 
				 $player1Won = 0;
				 $player2Won = 0;
				 $tournamentDrew = 0;
				 
				 // Convert results to integers
				 $numberOfGames = (int) $_POST["numberOfGames"];
				 $player1Wins = (int) $_POST["player1Wins"];
				 $player2Wins = (int) $_POST["player2Wins"];
				 $draws = (int) $_POST["draws"];
				 
				 // FIND OUT IF PLAYER WON TOURNAMENT
				 if ($player1Wins > $player2Wins)
					 $player1Won = 1;
				 if ($player2Wins > $player1Wins)
					 $player2Won = 1;
				 if (($player1Won == 0) && ($player2Won == 0))
					 $tournamentDrew = 1;
				 
				 // Prepend backslashes to make the data safe
				 $clean["user"] = mysqli_real_escape_string($db, $_COOKIE["user"]);
				 $clean["player2Name"] = mysqli_real_escape_string($db, $_COOKIE["player2Name"]);
				 $clean["numberOfGames"] = mysqli_real_escape_string($db, $numberOfGames);
				 $clean["player1Wins"] = mysqli_real_escape_string($db, $player1Wins);
				 $clean["player2Wins"] = mysqli_real_escape_string($db, $player2Wins);
				 $clean["draws"] = mysqli_real_escape_string($db, $draws);
				 $clean["player1Won"] = mysqli_real_escape_string($db, $player1Won);
				 $clean["player2Won"] = mysqli_real_escape_string($db, $player2Won);
				 $clean["tournamentDrew"] = mysqli_real_escape_string($db, $tournamentDrew);
				 
				 // Update results for player 1
				 $db->query("UPDATE ".$table." SET tPlayed = tPlayed + 1 WHERE username = '".$clean["user"]."'");
				 $db->query("UPDATE ".$table." SET tWon = tWon + ".$clean["player1Won"]." WHERE username = '".$clean["user"]."'");
				 $db->query("UPDATE ".$table." SET tLost = tLost + ".$clean["player2Won"]." WHERE username = '".$clean["user"]."'");
				 $db->query("UPDATE ".$table." SET tDrew = tDrew + ".$clean["tournamentDrew"]." WHERE username = '".$clean["user"]."'");
				 $db->query("UPDATE ".$table." SET gPlayed = gPlayed + ".$clean["numberOfGames"]." WHERE username = '".$clean["user"]."'");
				 $db->query("UPDATE ".$table." SET gWon = gWon + ".$clean["player1Wins"]." WHERE username = '".$clean["user"]."'");
				 $db->query("UPDATE ".$table." SET gLost = gLost + ".$clean["player2Wins"]." WHERE username = '".$clean["user"]."'");
				 $db->query("UPDATE ".$table." SET gDrew = gDrew + ".$clean["draws"]." WHERE username = '".$clean["user"]."'");
				 
				 // Update results for player 2
				 $db->query("UPDATE ".$table." SET tPlayed = tPlayed + 1 WHERE username = '".$clean["player2Name"]."'");
				 $db->query("UPDATE ".$table." SET tWon = tWon + ".$clean["player2Won"]." WHERE username = '".$clean["player2Name"]."'");
				 $db->query("UPDATE ".$table." SET tLost = tLost + ".$clean["player1Won"]." WHERE username = '".$clean["player2Name"]."'");
				 $db->query("UPDATE ".$table." SET tDrew = tDrew + ".$clean["tournamentDrew"]." WHERE username = '".$clean["player2Name"]."'");
				 $db->query("UPDATE ".$table." SET gPlayed = gPlayed + ".$clean["numberOfGames"]." WHERE username = '".$clean["player2Name"]."'");
				 $db->query("UPDATE ".$table." SET gWon = gWon + ".$clean["player2Wins"]." WHERE username = '".$clean["player2Name"]."'");
				 $db->query("UPDATE ".$table." SET gLost = gLost + ".$clean["player1Wins"]." WHERE username = '".$clean["player2Name"]."'");
				 $db->query("UPDATE ".$table." SET gDrew = gDrew + ".$clean["draws"]." WHERE username = '".$clean["player2Name"]."'");
				 
				 // Close the connection to the database server to ensure the information is stored properly
				 $db->close();
				 
				 // Record the results of the game in cookies. Cookies last 24 hours.
				 setcookie("numberOfGames", $numberOfGames, time()+$cookieTime);
				 setcookie("player1Wins", $player1Wins, time()+$cookieTime);
				 setcookie("player2Wins", $player2Wins, time()+$cookieTime);
				 setcookie("draws", $draws, time()+$cookieTime);
				 setcookie("player1Won", $player1Won, time()+$cookieTime);
				 setcookie("player2Won", $player2Won, time()+$cookieTime);
				 setcookie("tournamentDrew", $tournamentDrew, time()+$cookieTime);
				 
				 // Redirect to the results page
				 print ('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_results.php";</script>');
			 }
		 ?>
	 </head>
     
     <body>
     </body>
 </html>