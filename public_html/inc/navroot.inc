<nav>
     <ul>
        <li><a href="welcome.php">Home</a></li>
        <li><a href="account.php">Account</a></li>
        <li><?php if(isset($_SESSION['username'])) { ?>
				<a href="logout.php">Logout</a>
				<?php } else { ?>
				<a href="login.php">Login</a>
				<?php } ?></li>
    </ul>
</nav>