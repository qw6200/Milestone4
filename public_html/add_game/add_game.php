<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="../css/styles.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
	 crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
	 crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
	 crossorigin="anonymous"></script>
</head>

<body>

	<?php
require_once('../db_setup.php');
$sql = "USE jhur3_1;";
if ($conn->query($sql) === TRUE) {
   // echo "using Database tbiswas2_company";
} else {
   echo "Error using  database: " . $conn->error;
}
// Query:
$game_id = $_POST['game_id'];
$rating = $_POST['rating'];
$game_name = $_POST['game_name'];
$summary = $_POST['summary'];
$rating= $_POST['rating'];
$sql = "INSERT INTO game values ('$game_id', $rating, '$game_name',
'$summary', $rating);";


#$sql = "SELECT * FROM Students where Username like 'amai2';";
$result = $conn->query($sql);

if ($result === TRUE) {
	echo "New record created successfully";
	$myfile = fopen("../games_pages/$game_id.php", "w") or die("Unable to open file!");
	$txt = file_get_contents('create_game_page.php');
	fwrite($myfile, $txt);
	fclose($myfile);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
} 
//$stmt = $conn->prepare("Select * from Students Where Username like ?");
//$stmt->bind_param("s", $username);
//$result = $stmt->execute();
//$result = $conn->query($sql);
?>
	<div class="backbuttoncontainer">
		<button class="backbutton" onclick="location.href='add_game.html'" type="button">Click to Go Back!</button>
	</div>

	<?php
$conn->close();
?>

</body>

</html>