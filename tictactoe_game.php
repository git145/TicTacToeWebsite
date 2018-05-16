 <!DOCTYPE html> 

 <html lang = "en">
 
     <!--
         File: tictactoe_game.php
         Module: COMP519
         Author: Richard Kneale
         Student ID: 200790336
         Date created: 1st January 2016
         Description: Manages the tic tac toe game page
       -->

     <head> 
         <meta charset = "utf-8"/>
         <title id = "pageTitle">Tic Tac Toe - Game</title>
         <link rel = "stylesheet" type = "text/css" href = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_style.css" title = "styles"/>
         <script type = "text/javascript" src = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe.js"></script>
		 
		 <?php
			 // Import custom functions
			 require_once("tictactoe_functions.php");
			 
			 // Redirect to login page if the user isn't logged in
			 if(!(isset($_COOKIE["user"])))
			 {
				 print ('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_login.php";</script>');
			 }
			 
			 // Redirect to menu page if the user hasn't started a game
			 if(!(isset($_COOKIE["numberOfGames"])))
			 {
				 print ('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_menu.php";</script>');
			 }
				
			 $numberOfGames = $_COOKIE["numberOfGames"];
			 $player1Name = $_COOKIE["user"];
			 $player1Color = $_COOKIE["color"];
				 
			 // GET RANDOM USER DETAILS
			 // Create an object to represent the database
             $db = new mysqli($db_host, $db_login, $db_password, $db_database);
				 
			 // Write the database query to collect the information
             $sql = "SELECT * FROM ".$table."";
                     
             // Perform the query
             $result = $db->query($sql);
				 
			 // Count the number of users
			 $numberOfUsers = $result->num_rows;
				 
			 // Get details for player 2
			 do
			 {
				 // Get a random row from the table
				 $randomRow = rand(0, ($numberOfUsers - 1));
				 
				 // Seek to the row
				 $result->data_seek($randomRow);
					 
				 // Fetch the row
				 $row = $result->fetch_row();
					 
				 // Get details for player 2
				 $player2Name = $row[0];
				 $player2Color = $row[3];
			 }
			 while ($player2Name == $player1Name);
			 
			 //Close the connection to the database server (to ensure the information is stored properly)
			 $db->close();
				 
			 // Set cookies for player 2. Cookie lasts 24 hours.
             setcookie("player2Name", $player2Name, time()+$cookieTime);
			 setcookie("player2Color", $player2Color, time()+$cookieTime);
		 ?>
     </head>
     
     <body>
         <?php
			 // Print the game page
			 print(  '<div id = "ticTacToeSpace">
     
						 <form id = "resultsForm" action = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_updaterecords.php" method = "post">
							 <div>
								 <div id = "gameTracker" class = "inlineElement">HTML5 Tic-Tac-Toe: Game X of</div>
								 <input readonly class = "invisibleInput" name = "numberOfGames" id = "numberOfGames" value = "'.$numberOfGames.'" size = "1"/>
							 </div>
         
							 <table id = "gameResults">
								 <tr>
								     <td>
										 <div class = "inlineElement">Player 1&nbsp(</div>
										 <input type="text" readonly class = "invisibleInput" id = "player1Name" name = "player1Name" value = "'.$player1Name.'" size = "10"/>
										 <div class = "inlineElement"> - </div>
										 <input type = "color" readonly class = "invisibleInput" id = "player1Color" name = "player1Color" value = "'.$player1Color.'"/>
										 <div class = "inlineElement"> - </div>
										 <div id = "player1Token" class = "inlineElement">X</div>
										 <div class = "inlineElement">): </div>
										 <input type="text" readonly class = "invisibleInput" id = "player1Wins" name = "player1Wins" value = "X" size = "1"/>
										 <div class = "inlineElement">     </div>
									 </td>
                 
									 <td>
										 <div class = "inlineElement">Player 2&nbsp(</div>
										 <input type="text" readonly class = "invisibleInput" id = "player2Name" name = "player2Name" value = "'.$player2Name.'" size = "10"/>
										 <div class = "inlineElement"> - </div>
										 <input type = "color" readonly class = "invisibleInput" id = "player2Color" name = "player2Color" value = "'.$player2Color.'"/>
										 <div class = "inlineElement"> - </div>
										 <div id = "player2Token" class = "inlineElement">X</div>
										 <div class = "inlineElement">): </div>
										 <input type="text" readonly class = "invisibleInput" id = "player2Wins" name = "player2Wins" value = "X" size = "1"/>
										 <div class = "inlineElement">     </div>
									 </td>
                 
									 <td>
										 <div class = "inlineElement">Draws: </div>
										 <input readonly class = "invisibleInput" id = "draws" name = "draws" value = "X" size = "1"/>
									 </td>
								 </tr>
							 </table>
						 </form>
    
						 <div id="tictactoe_background">
							 <div id="tictactoe_board"></div>
						 </div>
        
						 <div id = "controlsSpace">
							 <table id = "gameControls">
								 <tr>
									 <td>
										 <input type = "button" value = "Reset game" id = "gameReset" class = "resetButton"/>
									 </td>
                         
									 <td>
										 <input type = "button" value = "Reset tournament" id = "tournamentReset" class = "resetButton"/>
									 </td>
                         
									 <td>
										 <input type = "button" value = "Return to menu" id = "menuButton" class = "resetButton"/>
									 </td>
									 
									 <td>
										 <input type = "button" value = "Logout" id = "logoutButton" class = "resetButton"/>
									 </td>
								 </tr>
							 </table>
						 </div>
         
						 <div id = "spacer"></div>
        
					 </div>'
         
					 .getHeaderFooter().
						 
					 '');
		 ?>
     </body>
 </html>