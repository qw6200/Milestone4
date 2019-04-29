<?php
// creates the edit record form
function edit_form($game_id, $rating, $game_name, $summary, $price, $genre, $setting, $graphics, $os, $release_date, $singlemulti) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <main>
        <div class="form-container">
            <h2> Update Game </h2>
            <form action="update_query.php" method="post">
                Game ID:
                <input type="text" name="game_id" value="<?php echo $game_id; ?>">
                <br> Rating
                <input type="text" name="rating" value="<?php echo $rating; ?>">
                <br> Game Name
                <input type="text" name="game_name" value="<?php echo $game_name; ?>">
                <br> Summary
                <input type="textarea" name="summary" value="<?php echo $summary; ?>">
                <br> Price
                <input type="number" name="price" value="<?php echo $price; ?>">
                <br> Genre
                <input type="text" name="genre" value="<?php echo $genre; ?>">
                <br> Setting
                <input type="text" name="setting" value="<?php echo $setting; ?>">
                <br> Graphics
                <input type="text" name="graphics" value="<?php echo $graphics; ?>">
                <br> Operating System
                <input type="text" name="OS" value="<?php echo $os; ?>">
                <br> Release Date
                <input type="text" name="release_date" value="<?php echo $release_date; ?>">
                <br> SinglePlayer or Multiplayer
                <input type="text" name="singlemulti" value="<?php echo $singlemulti; ?>">
                <input type="submit">
            </form>
        </div>
        <div class="backbuttoncontainer">
            <button class="backbutton" onclick="location.href='../welcome.php'" type="button">Back to Home
                Page!</button>
        </div>
    </main>
</body>

</html>
<?php
}