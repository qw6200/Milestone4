<?php
include('edit_form.php');

// connect to the database
include('../db_setup.php');

    // query db

$game_id = $_GET['game_id'];
$result = mysqli_query($conn, "SELECT * FROM game_db.game join game_db.game_info on game.game_id = game_db.game_info.gameinfo_id
join game_db.game_genres on game_db.game.game_id = game_db.game_genres.gameinfo_id
join game_db.spmp on game_db.game.game_id = game_db.spmp.gameinfo_id
where game_db.game.game_id = '$game_id'");
if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

$row = mysqli_fetch_array($result);
// check that the 'id' matches up with a row in the databse
if($row) {
    // get data from db
    $game_id = $row['game_id'];
    $rating = $row['rating'];
    $game_name = $row['game_name'];
    $summary = $row['summary'];
    $price = $row['price'];
    $genre = $row['genre'];
    $setting = $row['setting'];
    $graphics = $row['graphics'];
    $os= $row['OS'];
    $release_date = $row['release_date'];
    $singlemulti = $row['singlemulti'];

    // show form
    edit_form($game_id, $rating, $game_name, $summary, $price, $genre, $setting, $graphics, $os, $release_date, $singlemulti);
} else {
    // if no match, display result
    echo "No results!";
}
