 --
 -- Table structure for table 'UsersTTT'
 --
 
 DROP TABLE IF EXISTS UsersTTT;
 CREATE TABLE UsersTTT (
 
     username VARCHAR(20) NOT NULL, 
     email VARCHAR(30) NOT NULL UNIQUE, 
     password VARCHAR(20) NOT NULL,
	 color VARCHAR(7) NOT NULL,
	 tPlayed SMALLINT DEFAULT 0, 
     tWon SMALLINT DEFAULT 0, 
     tLost SMALLINT DEFAULT 0,
	 tDrew SMALLINT DEFAULT 0,
	 gPlayed SMALLINT DEFAULT 0,
	 gWon SMALLINT DEFAULT 0,
	 gLost SMALLINT DEFAULT 0,
	 gDrew SMALLINT DEFAULT 0,
    
     PRIMARY KEY (username)
     
     )
     
     -- Maintains referential integrity
     ENGINE = InnoDB DEFAULT CHARSET = latin1;