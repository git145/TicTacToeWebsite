 <!DOCTYPE html> 

 <html lang = "en">
 
     <!--
         File: tictactoe_functions.php
         Module: COMP519
         Author: Richard Kneale
         Student ID: 200790336
         Date created: 1st January 2016
         Description: Contains functions to be used by other pages
       -->

     <head> 
		 <meta charset = "utf-8"/>
         <title id = "pageTitle">Tic Tac Toe - Functions</title>
         <link rel = "stylesheet" type = "text/css" href = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_style.css" title = "styles"/>
         <script type = "text/javascript" src = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe.js"></script>
		 
		 <?php
			 // Default form values
			 $defaultUser = "";
			 $defaultEmail = "";
			 $defaultColor = "#0278CC";
			 $numberOfGames = "1";
			 
			 // Attributes to access the database
			 $table = "UsersTTT";
			 $db_host = "mysql";
			 $db_login = "m6rk";
			 $db_password = "05TaBlE05";
			 $db_database = "m6rk";
			 
			 // Map integers to column names (zero-indexed)
			 $USERNAME = 0;
			 $EMAIL = 1; 
			 $PASSWORD = 2;
			 $COLOR = 3;
			 $TOURNAMENTS_PLAYED = 4;
			 $TOURNAMENTS_WON = 5; 
			 $TOURNAMENTS_LOST = 6;
			 $TOURNAMENTS_DREW = 7;
			 $GAMES_PLAYED = 8;
			 $GAMES_WON = 9; 
			 $GAMES_LOST = 10;
			 $GAMES_DREW = 11;
			 
			 // Cookies expire after 24 hours.
			 $cookieTime = 86400;
			 
			 // Returns an item at random from a given array
			 function getRandomFromArray($array)
			 {
				 $randomArrayPosition = rand(0, (count($array)) - 1);
				 return $array[$randomArrayPosition];
			 }

			 // Returns a random font
			 function getRandomFont()
			 {
				 // Define an array of fonts
				 $fonts = array();
    
				 // Add fonts to an array
				 $fonts[] = "Georgia, serif";
				 $fonts[] = "Impact, Charcoal, sans-serif";
				 $fonts[] = "Comic Sans MS, cursive, sans-serif";
				 $fonts[] = "Arial, Helvetica, sans-serif";
				 $fonts[] = "Courier New, Courier, monospace";
				 $fonts[] = "Lucida Console, Monaco, monospace";
 
				 // Return a random font
				 return getRandomFromArray($fonts);
			 }

			 // Returns a random text color
			 function getRandomColor()
			 {
				 // Define an array of colors
				 $colors = array();
    
				 // Add colors to an array
				 $colors[] = "black";
				 $colors[] = "red";
				 $colors[] = "gray";
 
				 // Return a random color
				 return getRandomFromArray($colors);
			 }
 
			 // Returns a random welcome message
			 function getRandomWelcomeMessage()
			 {
				 // Define an array of welcome messages
				 $welcomeMessages = array();
    
				 // Add welcome messages to an array
				 $welcomeMessages[] = "Welcome"; # English
				 $welcomeMessages[] = "Willkommen"; # German
				 $welcomeMessages[] = "Bienvenidos"; # Spanish (plural)
				 $welcomeMessages[] = "Välkomna"; # Swedish (plural)
				 $welcomeMessages[] = "Bem-vindos"; # Portueguese (plural)
				 $welcomeMessages[] = "Benvenuti"; # Italian (male plural)
				 $welcomeMessages[] = "Benvenute"; # Italian (female plural)
				 $welcomeMessages[] = "Bienvenue"; # French
				 $welcomeMessages[] = "Welkom"; # Dutch
				 $welcomeMessages[] = "Velkommen"; # Danish
				 $welcomeMessages[] = "Tervetuloa"; # Finnish
 
				 // Return a random welcome message
				 return getRandomFromArray($welcomeMessages);
			 }
			 
			 function getHeaderFooter() 
			 {
				 return '<div id = "header" class = "headerFooter">
							 <div id = "title" class = "titleName">
								 Tic Tac Toe
							 </div>
						 </div>
 
						 <div id = "footer" class = "headerFooter">
							 <div id ="name" class = "titleName">
								 Richard Kneale 2016
							 </div>
						 </div>';
			 }
			 
			 function getFormButtons($submitButtonValue)
			 {
				 return  '<table class = "textCenter" id = "buttonTable">
							 <tr>
								 <td>
									 <input type = "submit" value = "'.$submitButtonValue.'" id = "submit" name = "submit"/>
								 </td>
						 
								 <td>
									 <input type = "button" value = "Clear form" id = "clearButton"/>
								 </td>
							 </tr>
						 </table><br/>';
			 }
			 
			 function getHOFButtons()
			 {
				 return  '<table class = "textCenter" id = "loginTable">
							 <tr>
								 <td>
									 <input type = "button" value = "Results" class = "resetButton" id = "resultsButton"/>
								 </td>
								 
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
						 </table>';
			 }
			 
			 function printLoginForm($username, $errorMessage)
			 {
				 print(	 '<div id = "mainSpace">
    
							 <div id = "welcomeMessageSpace" style = "color:'.getRandomColor().';font-family:'.getRandomFont().';">
								 '.getRandomWelcomeMessage().'!
							 </div>
         
							 <div id = "formSpace">
         
								 <br/>
         
								 <form action = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_processlogin.php" method = "post">
									 <table id = "loginTable">
										 <tr>
											 <td class = "textLeft">
												 Username/e-mail address:<br/><br/>
											 </td>
                 
											 <td class = "textRight">
												 <input type = "text" class = "ticTacToeInput" id = "inputUserEmail" name = "inputUserEmail" size = "20" value = "'.$username.'"/><br/><br/>
											 </td>
										 </tr>
             
										 <tr>
											 <td class = "textLeft">
												 Password:<br/><br/>
											 </td>
                 
											 <td class = "textRight">
												 <input type = "password" class = "ticTacToeInput" id = "inputPassword" name = "inputPassword" size = "20" value = ""/><br/><br/>
											 </td>
										 </tr>
									 </table>
									 '.getFormButtons("Login").'
								 </form>
        
							 </div><br/>
					 
							 <div id = "registrationLink">
								 <a href = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_registration.php">
									 New user? Create account
								 </a>
							 <div><br/>
							 
							 <div id = "errorMessage">'
								 .$errorMessage.
							 '<div>
         
						 </div>'
         
						 .getHeaderFooter().
						 
						 '');
			 }
			 
			 function printRegistrationForm($username, $email, $color, $errorMessage) 
			 {
				 print(  '<div id = "mainSpace">
    
							 <div id = "welcomeMessageSpace" style = "color:'.getRandomColor().';font-family:'.getRandomFont().';">
								 '.getRandomWelcomeMessage().'!
							 </div>
         
							 <div id = "formSpace">
         
								 <br/>
         
								 <form action = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_newuser.php" method = "post">
									 <table id = "loginTable">
										 <tr>
											 <td class = "textLeft">
												 Username:<br/><br/>
											 </td>
                 
											 <td class = "textRight">
												 <input type = "text" class = "ticTacToeInput" id = "inputUser" name = "inputUser" size = "20" value = "'.$username.'"/><br/><br/>
											 </td>
										 </tr>
             
										 <tr>
											 <td class = "textLeft">
												 E-mail address:<br/><br/>
											 </td>
                 
											 <td class = "textRight">
												 <input type = "text" class = "ticTacToeInput" id = "inputEmail" name = "inputEmail" size = "20" value = "'.$email.'"/><br/><br/>
											 </td>
										 </tr>
										 
										 <tr>
											 <td class = "textLeft">
												 Repeat e-mail address:<br/><br/>
											 </td>
                 
											 <td class = "textRight">
												 <input type = "text" class = "ticTacToeInput" id = "inputRepeatEmail" name = "inputRepeatEmail" size = "20" value = ""/><br/><br/>
											 </td>
										 </tr>
								 
										 <tr>
											 <td class = "textLeft">
												 Password:<br/><br/>
											 </td>
                 
											 <td class = "textRight">
												 <input type = "password" class = "ticTacToeInput" id = "inputPassword" name = "inputPassword" size = "20" value = ""/><br/><br/>
											 </td>
										 </tr>
										 
										 <tr>
											 <td class = "textLeft">
												 Repeat password:<br/><br/>
											 </td>
                 
											 <td class = "textRight">
												 <input type = "password" class = "ticTacToeInput" id = "inputRepeatPassword" name = "inputRepeatPassword" size = "20" value = ""/><br/><br/>
											 </td>
										 </tr>
								 
										 <tr>
											 <td class = "textLeft">
												 Token color:<br/><br/>
											 </td>
                 
											 <td class = "textRight">
												 <input type = "color" class = "ticTacToeInput" id = "inputColor" name = "inputColor" size = "20" value = "'.$color.'"/><br/><br/>
											 </td>
										 </tr>
									 </table>
									 '.getFormButtons("Submit").'
								 </form>
        
							 </div><br/>
					 
							 <div id = "registrationLink">
								 <a href = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_login.php">
									 Existing user? Log in
								 </a>
							 <div><br/>
						 
							 <div id = "errorMessage">'
								 .$errorMessage.
							 '<div>
         
						 </div>'
					 
						 .getHeaderFooter().
					 
						 '');
			 }
			 
			 function printMenuForm($numberOfGames, $errorMessage) 
			 {
				 print(  '<div id = "mainSpace">
    
							 <div id = "welcomeMessageSpace" style = "color:'.getRandomColor().';font-family:'.getRandomFont().';">
								 '.getRandomWelcomeMessage().'&nbsp'.$_COOKIE["user"].'!
							 </div>
         
							 <div id = "formSpace">
         
								 <br/>
         
								 <form action = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_processgames.php" method = "post">
									 <table id = "menuTable">
										 <tr>
											 <td class = "textLeft">
												 Number of games:<br/><br/>
											 </td>
                 
											 <td class = "textRight">
												 <input type = "text" class = "ticTacToeInput" id = "inputNumberOfGames" name = "inputNumberOfGames" size = "1" value = "'.$numberOfGames.'"/><br/><br/>
											 </td>
										 </tr>
									 </table>
                 
									 <input type = "submit" value = "Begin game" id = "submit" name = "submit" class = "textCenter"/>
								 </form><br/>
								 
								 <input type = "button" value = "Settings" id = "editButton" name = "editButton" class = "textCenter"/><br/><br/>
								 <input type = "button" value = "Logout" id = "logoutButton" name = "logoutButton" class = "textCenter"/><br/><br/>
        
							 </div><br/>
						 
							 <div id = "errorMessage">'
								 .$errorMessage.
							 '<div>
         
						 </div>'
					 
						 .getHeaderFooter().
					 
						 '');
			 }
			 
			 function printEditPreferencesForm($color, $errorMessage) 
			 {
				 print(	 '<div id = "mainSpace">
         
							 <div id = "formSpace">
         
								 <br/>
         
								 <form action = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_savechanges.php" method = "post">
									 <table id = "gameControls">
										 <tr>
											 <td class = "textLeft">
												 New e-mail address:<br/><br/>
											 </td>
                 
											 <td class = "textRight">
												 <input type = "text" class = "ticTacToeInput" id = "inputEmail" name = "inputEmail" size = "20" value = "'.$email.'"/><br/><br/>
											 </td>
										 </tr>
										 
										 <tr>
											 <td class = "textLeft">
												 Repeat new e-mail address:<br/><br/>
											 </td>
                 
											 <td class = "textRight">
												 <input type = "text" class = "ticTacToeInput" id = "inputRepeatEmail" name = "inputRepeatEmail" size = "20" value = ""/><br/><br/>
											 </td>
										 </tr>
										 
										 <tr>
											 <td class = "textLeft">
												 Old password:<br/><br/>
											 </td>
                 
											 <td class = "textRight">
												 <input type = "password" class = "ticTacToeInput" id = "inputOldPassword" name = "inputOldPassword" size = "20" value = ""/><br/><br/>
											 </td>
										 </tr>
								 
										 <tr>
											 <td class = "textLeft">
												 New password:<br/><br/>
											 </td>
                 
											 <td class = "textRight">
												 <input type = "password" class = "ticTacToeInput" id = "inputPassword" name = "inputPassword" size = "20" value = ""/><br/><br/>
											 </td>
										 </tr>
										 
										 <tr>
											 <td class = "textLeft">
												 Repeat new password:<br/><br/>
											 </td>
                 
											 <td class = "textRight">
												 <input type = "password" class = "ticTacToeInput" id = "inputRepeatPassword" name = "inputRepeatPassword" size = "20" value = ""/><br/><br/>
											 </td>
										 </tr>
										 
										 <tr>
											 <td class = "textLeft">
												 New token color:<br/><br/>
											 </td>
                 
											 <td class = "textRight">
												 <input type = "color" class = "ticTacToeInput" id = "inputColor" name = "inputColor" size = "20" value = "'.$color.'"/><br/><br/>
											 </td>
										 </tr>
									 </table>
									 
									 <table id = "menuTable">
										 <tr>
											 <td class = "textCenter">
												 <input type = "submit" value = "Save changes" id = "submit" name = "submit" class = "textCenter"/><br/>
											 </td>
                 
											 <td class = "textCenter">
												 <input type = "button" value = "Cancel" id = "cancelButton" name = "cancelButton" class = "textCenter"/><br/>
											 </td>
										 </tr>
									 </table>
                 
								 </form><br/>
								 
								 <input type = "button" value = "Return to menu" id = "menuButton" name = "menuButton" class = "textCenter"/><br/><br/>
								 <input type = "button" value = "Delete account" id = "deleteButton" name = "deleteButton" class = "textCenter"/><br/><br/>
								 <input type = "button" value = "Logout" id = "logoutButton" name = "logoutButton" class = "textCenter"><br/><br/>
        
							 </div><br/>
							 
							 <div id = "errorMessage">'
							 .$errorMessage.
							 '<div>
							 
							 <div id = "spacer"></div>
         
						 </div>'
         
						 .getHeaderFooter().
						 
						 '');
			 }
		 ?>
     </head>
     
     <body>
     </body>
 </html>