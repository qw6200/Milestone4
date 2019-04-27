CREATE TABLE db_user (
    username varchar(20) NOT NULL,
    pass varchar(255) NOT NULL,
    first_name varchar(20) NOT NULL,
    last_name varchar(20) NOT NULL,
    PRIMARY KEY (username)
);
CREATE TABLE user_preferences (
    userpref_id varchar(20) NOT NULL,
    rating float(2,1) NOT NULL,
    price smallint(3) NOT NULL,
    OS varchar(10) NOT NULL,
    FOREIGN KEY (userpref_id) REFERENCES db_user(username)
);
CREATE TABLE user_genres (
    userpref_id varchar(20) NOT NULL,
    genre varchar(20) NOT NULL,
    FOREIGN KEY (userpref_id) REFERENCES user_preferences(userpref_id)
);
CREATE TABLE game (
    game_id varchar(20) NOT NULL,
    rating float(2,1) NOT NULL,
    game_name varchar(20) NOT NULL,
    summary text NOT NULL,
    price smallint(3) NOT NULL,
    PRIMARY KEY (game_id)
);
CREATE TABLE game_info (
    gameinfo_id varchar(20) NOT NULL,
    setting varchar(30) NOT NULL,
    graphics varchar(10) NOT NULL,
    OS varchar(10) NOT NULL,
    release_date year NOT NULL,
    FOREIGN KEY (gameinfo_id) REFERENCES game(game_id)
);
CREATE TABLE spmp (
    gameinfo_id varchar(20) NOT NULL,
    singlemulti varchar(20) NOT NULL,
    FOREIGN KEY (gameinfo_id) REFERENCES game(game_id)
);
CREATE TABLE game_genres (
    gameinfo_id varchar(20) NOT NULL,
    genre varchar(20) NOT NULL,
    FOREIGN KEY (gameinfo_id) REFERENCES game(game_id)
);