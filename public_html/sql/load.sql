LOAD DATA LOCAL INFILE 'C:/MAMP/db/mysql/game_db/user_preferences.csv' 
INTO TABLE user_preferences
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY "\r\n";

LOAD DATA LOCAL INFILE 'C:/MAMP/db/mysql/game_db/user_genres.csv' 
INTO TABLE user_genres
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY "\r\n";

LOAD DATA LOCAL INFILE 'C:/MAMP/db/mysql/game_db/game.csv' 
INTO TABLE game
CHARACTER SET latin1
FIELDS TERMINATED BY '|' 
ENCLOSED BY '"'
LINES TERMINATED BY "\r\n";

LOAD DATA LOCAL INFILE 'C:/MAMP/db/mysql/game_db/game_info.csv' 
INTO TABLE game_info
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY "\r\n";

LOAD DATA LOCAL INFILE 'C:/MAMP/db/mysql/game_db/spmp.csv' 
INTO TABLE spmp
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY "\r\n";

LOAD DATA LOCAL INFILE 'C:/MAMP/db/mysql/game_db/game_genres.csv' 
INTO TABLE game_genres
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY "\r\n";