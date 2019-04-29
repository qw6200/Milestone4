<?php
// Include setup connection file
require_once "db_setup.php";
 
// initialize with empty values
$username = $pass = $confirm_password = $first_name = $last_name = "";
$username_err = $password_err = $confirm_password_err = $first_name_err = $last_name_err = "";
 
// POST when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT username FROM game_db.db_user WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
        
            $param_username = trim($_POST["username"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else if(strlen(trim($_POST["username"])) > 20){
                    $username_err = "Username can be at most 20 characters.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["pass"]))){
        $password_err = "Please enter a password.";
    } else if(strlen(trim($_POST["pass"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $pass = trim($_POST["pass"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($pass != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    // First name
    if(empty(trim($_POST["first_name"]))){
        $first_name_err = "Please type in your first name.";    
    } else {
        $first_name = trim($_POST["first_name"]);
    }
    // Last name
    if(empty(trim($_POST["last_name"]))){
        $last_name_err = "Please type in your last name.";
    } else {
        $last_name = trim($_POST["last_name"]);
    }
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($first_name_err) && empty($last_name_err)){
        // create hashed pass variable
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT); // Creates a password hash

        $sql = "INSERT INTO game_db.db_user (username, pass, first_name, last_name) VALUES ('$username', '$hashed_password', '$first_name', '$last_name');";
        $sql .= "INSERT INTO game_db.user_preferences (userpref_id, rating, price, OS) VALUES ('$username', '0', '0', 'windows')";

        if ($conn->multi_query($sql)) {
            do {
                /* store first result set */
                if ($result = $conn->store_result()) {
                    while ($row = $result->fetch_row()) {
                        printf("%s\n", $row[0]);
                    }
                    $result->free();
                }
            } while ($conn->next_result());
            echo "New record created successfully";
            header("location:login.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
	<style type="text/css">
		body {
			font: 14px sans-serif;
		}

		.wrapper {
			width: 350px;
			padding: 20px;
		}
	</style>
</head>

<body>
<header class="banner">

<div class="bannerpart1">
    <h3>CSC261: Game Database</h3>
</div>

<div class="bannerpart2">
    <?php include 'inc/navroot.inc';?>
</div>

</header>
	<div class="wrapper">
		<h2>Sign Up</h2>
		<p>Please fill this form to create an account.</p>
		<form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]); ?>" method="post">
			<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
				<label>Username</label>
				<input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
				<span class="help-block">
					<?php echo $username_err; ?>
				</span>
			</div>
			<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
				<label>Password</label>
				<input type="password" name="pass" class="form-control" value="<?php echo $pass; ?>">
				<span class="help-block">
					<?php echo $password_err; ?>
				</span>
			</div>
			<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
				<label>Confirm Password</label>
				<input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
				<span class="help-block">
					<?php echo $confirm_password_err; ?>
				</span>
            </div>
            <div class="form-group <?php echo (!empty($first_name)) ? 'has-error' : ''; ?>">
				<label>First Name</label>
				<input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>">
				<span class="help-block">
					<?php echo $first_name_err; ?>
				</span>
            </div>
            <div class="form-group <?php echo (!empty($last_name)) ? 'has-error' : ''; ?>">
				<label>Last Name</label>
				<input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
				<span class="help-block">
					<?php echo $last_name_err; ?>
				</span>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" value="Submit">
				<input type="reset" class="btn btn-default" value="Reset">
			</div>
			<p>Already have an account?
				<a href="login.php">Login here</a>.</p>
		</form>
	</div>
</body>

</html>