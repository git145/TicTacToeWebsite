 <!DOCTYPE html> 

 <html lang = "en">
 
     <!--
         File: tictactoe_hofgplayed.php
         Module: COMP519
         Author: Richard Kneale
         Student ID: 200790336
         Date created: 1st January 2016
         Description: Displays the three users who have played the most games
       -->

     <head> 
         <meta charset = "utf-8"/>
         <title id = "pageTitle">Tic Tac Toe - Hall of Fame</title>
         <link rel = "stylesheet" type = "text/css" href = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_style.css" title = "styles"/>
         <script type = "text/javascript" src = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe.js"></script>
		 
		 <?php
			 // Redirect to login page if user isn't logged in
			 if (!(isset($_COOKIE["user"])))
			 {
				 print ('<script>window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_login.php";</script>');
			 }
			 
			 // If the user is logged in and has just played a game
			 else
			 {
				 // Import custom functions
				 require_once("tictactoe_functions.php");
				 
				 // GET DATA REGARDING TOP 3 PLAYERS IN TOURNAMENTS WON
				 // Create an object to represent the database
                 $db = new mysqli($db_host, $db_login, $db_password, $db_database);
				 
				 $sql = "SELECT * FROM ".$table." ORDER BY gPlayed DESC";
				 $result = $db->query($sql);
				 
				 // Get data for first player
				 $result->data_seek(0);
				 $row = $result->fetch_row();
				 $user1 = $row[$USERNAME];
				 $gPlayed1 = $row[$GAMES_PLAYED];
				 
				 // Get data for first player
				 $result->data_seek(1);
				 $row = $result->fetch_row();
				 $user2 = $row[$USERNAME];
				 $gPlayed2 = $row[$GAMES_PLAYED];
				 
				 // Get data for first player
				 $result->data_seek(2);
				 $row = $result->fetch_row();
				 $user3 = $row[$USERNAME];
				 $gPlayed3 = $row[$GAMES_PLAYED];
				 
				 //Close the connection to the database server (to ensure the information is stored properly)
				 $db->close();
			 }
		 ?>
     </head>
     
     <body>
         <?php
			 // Print the results page
			 print(  '<div id = "resultsSpace">
						 <div class = "textCenter boldText largeText" id = "hallOfFameTitle">Top 3 Players in Games Played</div><br/>
						 
						 <table id = "hallOfFameTable">
							 <tr>
								 <td class = "textLeft boldText">'.$user1.':</td>
								 <td class = "textCenter" id = "numberOfGames">'.$gPlayed1.'</td>
							 </tr>
             
							 <tr>
								 <td class = "textLeft boldText">'.$user2.':</td>
								 <td class = "textCenter" id = "numberOfGames">'.$gPlayed2.'</td>
							 </tr>
             
							 <tr>
								 <td class = "textLeft boldText">'.$user3.':</td>
								 <td class = "textCenter" id = "numberOfGames">'.$gPlayed3.'</td>
							 </tr>
						 </table><br/>
						 '.getHOFButtons().'
					 </div>'
         
					 .getHeaderFooter().
						 
					 '');
		 ?>
     </body>
 </html>