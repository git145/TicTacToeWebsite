 <!DOCTYPE html> 

 <html lang = "en">
 
     <!--
         File: tictactoe_results.php
         Module: COMP519
         Author: Richard Kneale
         Student ID: 200790336
         Date created: 1st January 2016
         Description: Displays the results of a game to the players
       -->

     <head> 
         <meta charset = "utf-8"/>
         <title id = "pageTitle">Tic Tac Toe - Results</title>
         <link rel = "stylesheet" type = "text/css" href = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_style.css" title = "styles"/>
         <script type = "text/javascript" src = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe.js"></script>
		 
		 <?php
			 // Redirect to login page if user isn't logged in
			 if (!(isset($_COOKIE["user"])))
			 {
				 print ('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_login.php";</script>');
			 }
			 
			 // Redirect to menu page if user hasn't played a game
			 if (!(isset($_COOKIE["player1Wins"])))
			 {
				 print ('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_menu.php";</script>');
			 }
			 
			 // If the user is logged in and has just played a game
			 else
			 {
				 // Import custom functions
				 require_once("tictactoe_functions.php");
			 
				 // Assign the cookies to variables
				 $numberOfGames = $_COOKIE["numberOfGames"];
				 $player1Wins = $_COOKIE["player1Wins"];
				 $player2Wins = $_COOKIE["player2Wins"];
				 $draws = $_COOKIE["draws"];
				 $player1Won = $_COOKIE["player1Won"];
				 $player2Won = $_COOKIE["player2Won"];
				 $tournamentDrew = $_COOKIE["tournamentDrew"];
				 
				 // GENERATE A WINNING QUOTE
				 if ($tournamentDrew == 1)
					 $resultQuote = "The game is a tie overall!";
				 else if ($player1Won == 1)
					 $resultQuote = "'".$_COOKIE["user"]."' is the overall winner!";
				 else
					 $resultQuote = "'".$_COOKIE["player2Name"]."' is the overall winner!";
				 
				 // Create an object to represent the database
                 $db = new mysqli($db_host, $db_login, $db_password, $db_database);
				 
				 // Get player 1's stats
				 $clean["user"] = mysqli_real_escape_string($db, $_COOKIE["user"]);
				 $sql = "SELECT * FROM ".$table." WHERE username = '".$clean["user"]."'";
				 $result = $db->query($sql);
				 $result->data_seek(0);
				 $row = $result->fetch_row();
				 $player1TPlayed = $row[$TOURNAMENTS_PLAYED];
				 $player1TWon = $row[$TOURNAMENTS_WON];
				 $player1TLost = $row[$TOURNAMENTS_LOST];
				 $player1TDrew = $row[$TOURNAMENTS_DREW];
				 $player1GPlayed = $row[$GAMES_PLAYED];
				 $player1GWon = $row[$GAMES_WON];
				 $player1GLost = $row[$GAMES_LOST];
				 $player1GDrew = $row[$GAMES_DREW];
				 
				 // Get player 2's stats
				 $clean["player2Name"] = mysqli_real_escape_string($db, $_COOKIE["player2Name"]);
				 $sql = "SELECT * FROM ".$table." WHERE username = '".$clean["player2Name"]."'";
				 $result = $db->query($sql);
				 $result->data_seek(0);
				 $row = $result->fetch_row();
				 $player2TPlayed = $row[$TOURNAMENTS_PLAYED];
				 $player2TWon = $row[$TOURNAMENTS_WON];
				 $player2TLost = $row[$TOURNAMENTS_LOST];
				 $player2TDrew = $row[$TOURNAMENTS_DREW];
				 $player2GPlayed = $row[$GAMES_PLAYED];
				 $player2GWon = $row[$GAMES_WON];
				 $player2GLost = $row[$GAMES_LOST];
				 $player2GDrew = $row[$GAMES_DREW];
				 
				 //Close the connection to the database server (to ensure the information is stored properly) 
				 $db->close();
			 }
		 ?>
     </head>
     
     <body>
         <?php
			 // Print the results page
			 print(  '<div id = "resultsSpace">
						 <div class = "textCenter boldText" id = "resultQuote">'
							 .$resultQuote.
						 '</div><br/>
						 
						 <table id = "resultsTable">
							 <tr>
								 <td class = "textCenter boldText largeText" colspan = "2">
									 Results<br/>
								 </td>
							 </tr>
             
							 <tr>
								 <td class = "textLeft boldText">Number of Games:</td>
								 <td class = "textRight" id = "numberOfGames">'.$numberOfGames.'</td>
							 </tr>
             
							 <tr>
								 <td class = "textLeft boldText">Player 1 Wins:</td>
								 <td class = "textRight" id = "player1Result">'.$player1Wins.'</td>
							 </tr>
             
							 <tr>
								 <td class = "textLeft boldText">Player 2 Wins:</td>
								 <td class = "textRight" id = "player2Result">'.$player2Wins.'</td>
							 </tr>
             
							 <tr>
								 <td class = "textLeft boldText">Draws:</td>
								 <td class = "textRight" id = "draws">'.$draws.'</td>
							 </tr>
             
							 <tr>
								 <td colspan = "2">
									 <br/>
								 </td>
							 </tr>
                 
						 </table>
						 
						 <table id = "player1Stats" class = "textCenter buttonTable2">
							 <tr>
								 <td class = "boldText" colspan = "2">
									  Statistics for '.$_COOKIE["user"].'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Tournaments played:
								 </td>
                         
								 <td>
									 '.$player1TPlayed.'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Tournaments won:
								 </td>
                         
								 <td>
									 '.$player1TWon.'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Tournaments lost:
								 </td>
                         
								 <td>
									 '.$player1TLost.'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Tournaments drew:
								 </td>
                         
								 <td>
									 '.$player1TDrew.'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Tournaments win %:
								 </td>
                         
								 <td>
									 '.(round((($player1TWon/$player1TPlayed)*100), 1)).'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Tournaments lost %:
								 </td>
                         
								 <td>
									 '.(round((($player1TLost/$player1TPlayed)*100), 1)).'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Tournaments drew %:
								 </td>
                         
								 <td>
									 '.(round((($player1TDrew/$player1TPlayed)*100), 1)).'
								 </td>
							 </tr>
							 
							 <tr>
								 <td colspan = "2">
									 <br/>
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Games played:
								 </td>
                         
								 <td>
									 '.$player1GPlayed.'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Games won:
								 </td>
                         
								 <td>
									 '.$player1GWon.'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Games lost:
								 </td>
                         
								 <td>
									 '.$player1GLost.'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Games drew:
								 </td>
                         
								 <td>
									 '.$player1GDrew.'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Games win %:
								 </td>
                         
								 <td>
									 '.(round((($player1GWon/$player1GPlayed)*100), 1)).'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Games lost %:
								 </td>
                         
								 <td>
									 '.(round((($player1GLost/$player1GPlayed)*100), 1)).'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Games drew %:
								 </td>
                         
								 <td>
									 '.(round((($player1GDrew/$player1GPlayed)*100), 1)).'
								 </td>
							 </tr>
						 </table><br/>
						 
						 <table id = "player2Stats" class = "textCenter buttonTable2">
							 <tr>
								 <td class = "boldText" colspan = "2">
									 Statistics for '.$_COOKIE["player2Name"].'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Tournaments played:
								 </td>
                         
								 <td>
									 '.$player2TPlayed.'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Tournaments won:
								 </td>
                         
								 <td>
									 '.$player2TWon.'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Tournaments lost:
								 </td>
                         
								 <td>
									 '.$player2TLost.'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Tournaments drew:
								 </td>
                         
								 <td>
									 '.$player2TDrew.'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Tournaments win %:
								 </td>
                         
								 <td>
									 '.(round((($player2TWon/$player2TPlayed)*100), 1)).'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Tournaments lost %:
								 </td>
                         
								 <td>
									 '.(round((($player2TLost/$player2TPlayed)*100), 1)).'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Tournaments drew %:
								 </td>
                         
								 <td>
									 '.(round((($player2TDrew/$player2TPlayed)*100), 1)).'
								 </td>
							 </tr>
							 
							 <tr>
								 <td colspan = "2">
									 <br/>
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Games played:
								 </td>
                         
								 <td>
									 '.$player2GPlayed.'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Games won:
								 </td>
                         
								 <td>
									 '.$player2GWon.'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Games lost:
								 </td>
                         
								 <td>
									 '.$player2GLost.'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Games drew:
								 </td>
                         
								 <td>
									 '.$player2GDrew.'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Games win %:
								 </td>
                         
								 <td>
									 '.(round((($player2GWon/$player2GPlayed)*100), 1)).'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Games lost %:
								 </td>
                         
								 <td>
									 '.(round((($player2GLost/$player2GPlayed)*100), 1)).'
								 </td>
							 </tr>
							 
							 <tr>
								 <td class = "textLeft">
									 Games drew %:
								 </td>
                         
								 <td>
									 '.(round((($player2GDrew/$player2GPlayed)*100), 1)).'
								 </td>
							 </tr>
						 </table><br/>
						 
						 <table class = "textCenter" id = "hallOfFameButtons2">
							 <tr>
								 <td>
									 <input type = "button" value = "Top in tournaments" id = "topTournaments" name = "topTournaments" class = "resetButton"/>
								 </td>
								 <td>
									 <input type = "button" value = "Top in plays" id = "topPlays" name = "topPlays" class = "resetButton"/>
								 </td>
								 <td>
									 <input type = "button" value = "Top in games" id = "topGames" name = "topGames" class = "resetButton"/>
								 </td>
							 </tr>
						 </table><br/>
						 
						 <table class = "textCenter buttonTable3">
							 <tr>
								 <td>
									 <input type = "button" value = "New game" id = "newGameButton" class = "resetButton"/>
								 </td>
								 <td>
									 <input type = "button" value = "Return to menu" id = "welcomePageButton" class = "resetButton"/>
								 </td>
								 <td>
									 <input type = "button" value = "Logout" id = "logoutButton" class = "resetButton"/>
								 </td>
							 </tr>
						 </table>
						 
						 <div id = "spacer"></div>
					 </div>'
         
					 .getHeaderFooter().
						 
					 '');
		 ?>
     </body>
 </html>