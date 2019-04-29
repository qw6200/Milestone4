<?php

// connect to the database

include('edit_form.php');

include('../db_setup.php');

    // get form data, making sure it is valid
    $game_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['game_id']));
	$rating = mysqli_real_escape_string($conn, htmlspecialchars($_POST['rating']));
	$game_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['game_name']));
	$summary = mysqli_real_escape_string($conn, htmlspecialchars($_POST['summary']));
    $price = mysqli_real_escape_string($conn, htmlspecialchars($_POST['price']));
    $genre = mysqli_real_escape_string($conn, htmlspecialchars($_POST['genre']));
    $setting = mysqli_real_escape_string($conn, htmlspecialchars($_POST['setting']));
	$graphics = mysqli_real_escape_string($conn, htmlspecialchars($_POST['graphics']));
    $os = mysqli_real_escape_string($conn, htmlspecialchars($_POST['OS']));
    $release_date = mysqli_real_escape_string($conn, htmlspecialchars($_POST['release_date']));
    $singlemulti = mysqli_real_escape_string($conn, htmlspecialchars($_POST['singlemulti']));

	// check to make sure both fields are entered
    if ($game_id == '' || $rating == '' || $game_name == '' || $summary == '' || $price == '' ||
    $genre == '' || $setting == '' || $graphics == '' || $os == '' || $release_date == '' || $singlemulti == '') {

        $error = 'ERROR: Please fill in all required fields!';
        edit_form($game_id, $rating, $game_name, $summary, $price, $genre, $setting, $graphics, $os, $release_date, $singlemulti);

	} else {
        $sql = "UPDATE game_db.game, game_db.game_info, game_db.spmp, game_db.game_genres
                SET game.rating=$rating, game.game_name='$game_name', game.summary='$summary', game.price=$price,
                game_info.setting='$setting', game_info.graphics='$graphics', game_info.OS='$os', game_info.release_date=$release_date,
                spmp.singlemulti='$singlemulti',
                game_genres.genre='$genre'
                WHERE game.game_id='$game_id' AND game_info.gameinfo_id='$game_id' AND spmp.gameinfo_id='$game_id' AND game_genres.gameinfo_id='$game_id'";
        if ($conn->query($sql) === TRUE) {
            header("location: ../welcome.php");
        } else {
            echo "Error updating record: " . $conn->error;
        }
        // finish insertion and create game page
        // if ($result === TRUE) {
        //     $myfile = fopen("../games_pages/$game_id.php", "w") or die("Unable to open file!");
        //     $txt = file_get_contents('create_game_page.php');
        //     fwrite($myfile, $txt);
        //     fclose($myfile);
        //     header("location: login.php");
        // }
    }

