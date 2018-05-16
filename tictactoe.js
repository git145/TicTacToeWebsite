 /* 
  * File: tictactoe.js
  * Module: COMP519
  * Author: Richard Kneale
  * Student ID: 200790336
  * Date created: 18th November 2016
  * Description: Contains script to manage a game of tic-tac-toe
  */

 /*
  * VARIABLES
  */
 
 // Game attributes
 // Default values have been identified
 var gameNumber = 1;
 var player1Wins = 0;
 var player2Wins = 0;
 var player1Token = "x";
 var player2Token = "o";
 var draws = 0;
 var resultQuote = "You have not yet completed a tournament!";
 
 /*
  * END OF VARIABLES
  */
 
 // These actions will occur when the designated pages are accessed
 window.onload = function()
 {
     // Read the title of the page
     var documentTitle = document.title;
	 
	 // Home page
     if (documentTitle == "Tic Tac Toe - Home")
     {
         // Redirect a user to the php pages that manage the Tic Tac Toe game
         window.location = "http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_login.php";
     }
	 
	 // Login page
     if (documentTitle == "Tic Tac Toe - Welcome")
     {
         // Redirect a user to the php pages that manage the Tic Tac Toe game
         document.getElementById("clearButton").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_login.php")};
     }
	 
	 // Registration page
     if (documentTitle == "Tic Tac Toe - Registration")
     {
         // Redirect a user to the php pages that manage the Tic Tac Toe game
         document.getElementById("clearButton").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_registration.php")};
     }
	 
	 // Menu page
     if (documentTitle == "Tic Tac Toe - Menu")
     {
         // Connect the buttons to their functions
		 document.getElementById("editButton").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_useredit.php")};
         document.getElementById("logoutButton").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_logout.php")};
     }
	 
	 // Edit preferences page
     if (documentTitle == "Tic Tac Toe - Edit Preferences")
     {
         // Connect the buttons to their functions
		 document.getElementById("cancelButton").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_menu.php")};
		 document.getElementById("menuButton").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_menu.php")};
         document.getElementById("logoutButton").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_logout.php")};
		 document.getElementById("deleteButton").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_deleteaccount.php")};
     }
    
     // Game page
     if (documentTitle == "Tic Tac Toe - Game")
     {
         // Assign names to the name spaces as they must be used multiple times
         var player1NameSpace = document.getElementById("player1Name");
         var player2NameSpace = document.getElementById("player2Name");
         
         // Get variables
         player1Name = player1NameSpace.value;
         player2Name = player2NameSpace.value;
         player1Color = document.getElementById("player1Color").value;
         player2Color = document.getElementById("player2Color").value;
         numberOfGames = document.getElementById("numberOfGames").value;
         
         // Resize the name spaces
         player1NameSpace.size = player1Name.length;
         player2NameSpace.size = player2Name.length;
    
         //Connect the buttons to their functions
         document.getElementById("gameReset").onclick = gameReset;
         document.getElementById("tournamentReset").onclick = tournamentReset;
         document.getElementById("menuButton").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_menu.php")};
		 document.getElementById("logoutButton").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_logout.php")};
         
         // Set up the tic tac toe canvas
         createCanvas();
         
         // Begin a new game
         newGameSetup();
     } // Game page
     
     // Results page
     if (documentTitle == "Tic Tac Toe - Results")
     {
         //Connect the buttons to their functions
         document.getElementById("topTournaments").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_hoftwon.php")};
		 document.getElementById("topPlays").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_hofgplayed.php")};
         document.getElementById("topGames").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_hofgwon.php")};
         document.getElementById("welcomePageButton").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_menu.php")};
         document.getElementById("newGameButton").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_game.php")};
		 document.getElementById("logoutButton").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_logout.php")};
     }
	 
	 // Hall of Fame pages
     if (documentTitle == "Tic Tac Toe - Hall of Fame")
     {
         //Connect the buttons to their functions
         document.getElementById("resultsButton").onclick = function(){window.history.back()};
		 document.getElementById("newGameButton").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_game.php")};
         document.getElementById("welcomePageButton").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_menu.php")};
		 document.getElementById("logoutButton").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/~m6rk/tictactoe_logout.php")};
     }
     
     // Error page
     if (documentTitle == "Tic Tac Toe - Error")
     {
         //Connect the button to its function
         document.getElementById("beginGameButton").onclick = function(){loadPage("http://cgi.csc.liv.ac.uk/cgi-bin/cgiwrap/m6rk/tictactoe_welcome.py")};
     }
 } // onload
 
 // Loads a specified webpage
 function loadPage(page)
 {
     location = page;
 }
 
 /*
  * TIC-TAC-TOE FUNCTIONS
  */
 
 // Identifies whether the tournament has een completed and begins a new game if it hasn't
 function newGameSetup()
 {
     // Clear the board
     squaresReset();
     
     // Resets the turn counter for each game
     gameTurn = 1;
     
     // If the tournament has been completed
     if (gameNumber > numberOfGames)
     {
         // Load the results page
         document.getElementById("resultsForm").submit();
     }
     
     // If the gameNumber is odd
     if ((gameNumber % 2) == 1)
     {
         // Player 1 goes first
         player1Token = "x";
         player2Token = "o";
     }
     
     // If the gameNumber is odd
     else
     {
         // Player 2 goes first
         player1Token = "o";
         player2Token = "x";
     }
     
     // Update the gameNumber and the scores
     // The values must be printed at the start of the game
     // The values must not be updated after the final game
     if (gameNumber <= numberOfGames)
     {
         document.getElementById("gameTracker").innerHTML = "HTML5 Tic-Tac-Toe: Game " + gameNumber + " of ";
         document.getElementById("player1Token").innerHTML = player1Token;
         document.getElementById("player1Wins").value = player1Wins;
         document.getElementById("player2Token").innerHTML = player2Token;
         document.getElementById("player2Wins").value = player2Wins;
         document.getElementById("draws").value = draws;
     }
 } // newGameSetup()
  
 // Create the canvas for the tic-tac-toe game
 function createCanvas()
 {
     // Create 9 canvases for the 9 squares in the game
     for (i = 0; i < 9; i++)
     {
         // Create the canvas
         var c = document.createElement("canvas");
         
         // Give the canvas a unique ID
         c.setAttribute('id','newcanvas'+(i+1));
         
         // Set the width and height of the cavas
         c.setAttribute('width',150);   
         c.setAttribute('height',150);
         
         // Give the canvas a unique Class
         c.className = i;                   
        
         // Tie the DOM events for each canvas to a function
         c.onmouseover = pickTurn;
         c.onmouseout = eraseMoves;
         c.onclick = makeMove;
        
         // Add the canvas to the division
         document.getElementById("tictactoe_board").appendChild(c);
        
         //Make some HTML5 modifications to each canvas
         var ctx=c.getContext('2d'); // Get the context for HTML5 manipulation
         ctx.fillStyle = '#FFFFFF'; // Make the canvas blank
         ctx.fillRect(i%3, 0, 148, 148); // Shape the canvas
     }
 } // createCanvas()

 // Fills empty squares with white rectangles when a game ends
 function terminateGame()
 {
     // For each square
     for (var i = 1; i <= 9; i++)
     {
         // Get a reference to the square
         var square = document.getElementById("newcanvas" + i.toString());
         
         // If the square is empty
         if(square.className != "x" && square.className != "o")
         {
             // Tell empty squares that the game is over
             square.className = "over";
             
             var squareContext = square.getContext('2d');
             
             // Change the fill color to gray
             squareContext.fillStyle = '#DDDDDD';
             
             // Add a rectangle to the square
             squareContext.fillRect(getColumn(i) - 1, 0, 148, 148);
         }
     }
 } // terminateGame()

 // Fills a square with a white rectangle
 function eraseMoves()
 {
     // Get a reference to the id of the square
     var squareId = (this.id.substring(this.id.length - 1));
     
     // If the square is empty and nobody has won
     if(this.className != "x" && this.className != "o" && this.className != "over")
     {
         var squareContext = document.getElementById(this.id).getContext('2d');
         
         // Change the fill color to white
         squareContext.fillStyle='#FFFFFF';
         
         // Add a rectangle to the square
         squareContext.fillRect(getColumn(squareId) - 1, 0, 148, 148);
     }
 }
 
 // Returns the column that a square is in
 function getColumn(identificationNumber)
 {
     var modulus = (identificationNumber % 3);
     var column = 0;
             
     if (modulus == 1 || modulus == 2)
         column = modulus;
     else
         column = 3;
            
     return column;
 }

 // Determines whether the game has been won
 function checkWin()
 {
     // Check for horizontal row of three
     for (var i = 1; i <= 9; i += 3)
     {
         // Get a reference to the class name of a square
         var squareClassName = document.getElementById("newcanvas" + i.toString()).className;
         
         if (squareClassName == document.getElementById("newcanvas"+(i+1)).className && 
             squareClassName == document.getElementById("newcanvas"+(i+2)).className)
         {
             winAlert(squareClassName);
             return 0;
         }
     }
    
     // Check for vertical row of three
     for (var i = 1; i < 4; i++)
     {
         // Get a reference to the class name of a square
         var squareClassName = document.getElementById("newcanvas" + i.toString()).className;
         
         if (squareClassName == document.getElementById("newcanvas"+(i+3)).className && 
             squareClassName == document.getElementById("newcanvas"+(i+6)).className)
         {
             winAlert(squareClassName);
             return 0;
         }
     }
     
     // Check for diagonal row of three
     if ((document.getElementById("newcanvas1").className == document.getElementById("newcanvas5").className &&
         document.getElementById("newcanvas1").className == document.getElementById("newcanvas9").className) || 
        (document.getElementById("newcanvas3").className == document.getElementById("newcanvas5").className && 
         document.getElementById("newcanvas3").className == document.getElementById("newcanvas7").className))
     { 
         winAlert(document.getElementById("newcanvas5").className);
         return 0;
     }
    
     // No moves have been made
     var numopen = 0;
    
     // Count how many moves have been made
     for (var i = 1; i <= 9; i++)
     {
         // Get a reference to the class name of a square
         var squareClassName = document.getElementById("newcanvas" + i.toString()).className;
         
         // Add one to the count if the square has been used
         if (squareClassName == "x" || squareClassName == "o")
             numopen++;
     }
    
     // If all possible moves have been made
     if (numopen == 9)
     {
         // If the final game has been won
         if (gameNumber == numberOfGames)
         {
             alert("Game over - it's a tie!");
         }
         
         // If gameNumber is odd
         else if ((gameNumber % 2) == 1)
         {
             alert("Game over - it's a tie!\nPlayer 1 is now 'o'. Player 2 is now 'x'.");
         }
         
         // If gameNumber is even
         else
         {
             alert("Game over - it's a tie!\nPlayer 1 is now 'x'. Player 2 is now 'o'.");
         }
         
         gameNumber++;
         draws++;
         
         // Print the scores before a reset
         document.getElementById("player1Token").innerHTML = player1Token;
         document.getElementById("player1Wins").value = player1Wins;
         document.getElementById("player2Token").innerHTML = player2Token;
         document.getElementById("player2Wins").value = player2Wins;
         document.getElementById("draws").value = draws;
         
         // Update the game attributes to prepare for a new game
         newGameSetup();
     }
 } // checkWin()
 
 // Inform the players that the game has been won
 function winAlert(squareClassName)
 {
     /*
      * UPDATE SCORES
      */
      
     // If the final game has been won
     if (gameNumber == numberOfGames)
     {
         // If gameNumber is odd
         if ((gameNumber % 2) == 1)
         {
             if (squareClassName == "x")
             {
                 player1Wins++;
                 alert("Game over - '" + player1Name + "' (x) wins!");
             }
             
             else
             {
                 player2Wins++;
                 alert("Game over - '" + player2Name + "' (o) wins!");
             }
         }
         
         // If gameNumber is even
         else
         {
             if (squareClassName == "x")
             {
                 player2Wins++;
                 alert("Game over - '" + player2Name + "' (x) wins!");
             }
             
             else
             {
                 player1Wins++;
                 alert("Game over - '" + player1Name + "' (o) wins!");
             }
         }
     }
     
     // If gameNumber is odd
     else if ((gameNumber % 2) == 1)
     {
         if (squareClassName == "x")
         {
             player1Wins++;
             alert("Game over - '" + player1Name + "' (x) wins!\nPlayer 1 is now 'o'. Player 2 is now 'x'.");
         }
         
         else
         {
             player2Wins++;
             alert("Game over - '" + player2Name + "' (o) wins!\nPlayer 1 is now 'o'. Player 2 is now 'x'.");
         }
     }
     
     // If gameNumber is even
     else
     {
         if (squareClassName == "x")
         {
             player2Wins++;
             alert("Game over - '" + player2Name + "' (x) wins!\nPlayer 1 is now 'x'. Player 2 is now 'o'.");
         }
         
         else
         {
             player1Wins++;
             alert("Game over - '" + player1Name + "' (o) wins!\nPlayer 1 is now 'x'. Player 2 is now 'o'.");
         }
     }
     
     /*
      * END OF UPDATE SCORES
      */
     
     // Close unused squares to input
     terminateGame();
     
     gameNumber++;
     
     // Print the scores before a reset
     document.getElementById("player1Token").innerHTML = player1Token;
     document.getElementById("player1Wins").value = player1Wins;
     document.getElementById("player2Token").innerHTML = player2Token;
     document.getElementById("player2Wins").value = player2Wins;
     document.getElementById("draws").value = draws;
     
     // Update the game attributes to prepare for a new game
     newGameSetup();
 } // winAlert()

 // Contains the script necessary for a player to make a move
 function makeMove()
 {
     // If a square is empty and useable
     if(this.className != "x" && this.className != "o" && this.className != "over")
     {
         // Get a reference to the highlighted square
         var square = document.getElementById(this.id);
         
         var squareContext = square.getContext('2d');
         
         // Calculate which player's gameTurn it is
         if ((gameTurn % 2) == 1)
             this.className = "x";
         else
             this.className = "o";
         
         gameTurn++;
         checkWin()
     }
 } // makeMove()

 // Determine which player's gameTurn it is
 function pickTurn()
 {
     // If a square is empty and useable
     if (this.className != "x" && this.className != "o" && this.className != "over")
     {
         // Get a reference to the id of the square
         var squareId = (this.id.substring(this.id.length - 1));
        
         // Player 1's gameTurn
         if ((gameTurn % 2) == 1)
         {
             var square = document.getElementById(this.id);
             var squareContext = square.getContext('2d');
             
             // Change the fillStyle to player 1's color
             if ((gameNumber % 2) == 1)                     // If the gameNumber is odd
                 squareContext.fillStyle = player1Color;
             else                                           // If the gameNumber is even
                 squareContext.fillStyle = player2Color;
             
             // Add a rectangle to the square
             squareContext.fillRect(getColumn(squareId) - 1, 0, 148, 148);
             
             // Change the fillStyle to black
             squareContext.fillStyle = '#000000';
             
             squareContext.font = "134px Arial"
             squareContext.fillText("X", 30,  125);
         } 
        
         // Player 2's gameTurn
         else
         {
             var square = document.getElementById(this.id);
             var squareContext = square.getContext('2d');
             
             // Change the fillStyle to player 2's color
             if ((gameNumber % 2) == 1)                     // If the gameNumber is odd
                 squareContext.fillStyle = player2Color;    
             else                                           // If the gameNumber is even
                 squareContext.fillStyle = player1Color;    
             
             // Add a rectangle to the square
             squareContext.fillRect(getColumn(squareId) - 1, 0, 148, 148);
             
             // Change the fillStyle to black
             squareContext.fillStyle = '#000000';
             
             squareContext.font = "134px Arial"
             squareContext.fillText("O",23,125);
         }
     }
 }

 // Resets the current game
 function gameReset()
 {
     squaresReset();
 }
 
 // Resets the tournament
 function tournamentReset()
 {
     squaresReset();
     
     // Reset game attributes
     gameNumber = 1;
     player1Wins = 0;
     player2Wins = 0;
     draws = 0;
     
     newGameSetup()
 }
 
 // Make squares useable
 function squaresReset()
 {
     for(i = 1; i <= 9; i++)
     {
         var square = document.getElementById("newcanvas"+i.toString());
         square.className = i;
         var squareContext=square.getContext('2d');
         squareContext.fillStyle = '#FFFFFF';
         squareContext.fillRect((i-1) % 3, 0, 148, 148);
     }
 }
 
 // Generates a winning quote based on which player has won the tournament
 function resultQuoteGenerator(playerName)
 {
     return "'" + playerName + "' is the overall winner!";
 }
 
 /*
  * END OF TIC-TAC-TOE FUNCTIONS
  */