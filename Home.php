<?php

session_start();

$conn=mysqli_connect('localhost','root','','php_login');

if(!$conn){
	die("Connection failed ".mysqli_connect_error()."==>".mysqli_connect_errno());
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Login form</title>
	<style>
	@import url('https://fonts.googleapis.com/css?family=Berkshire+Swash|Courgette|Cousine');
	@import url('https://fonts.googleapis.com/css?family=Merriweather');
	</style>
</head>
<body>
	<img src="images/minimal_poster.jpg" class="img1">
<section>
	<form action="Home.php" method="POST">
		<div class="container">
			<div class="div1">
				<h1>You haved loged in! </h1>
							
			</div>
			<div class="div2" >
				<?php
						$query="SELECT * FROM log WHERE id='$_SESSION[user_id]'";
						$execute=mysqli_query($conn,$query);
						$row=mysqli_fetch_array($execute);

				?>
				<h3 style="color: #DC143C; margin-top: 60%;">Welcome <?php  echo $row['uname']; ?></h3>
				<?php
					if(!empty($_POST['logout'])){
				
					session_destroy();
					$home_url='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/Login.php';
				header("location:".$home_url);
				}
				?>
				<input type="submit" name="logout" value="Logout">
			</div>
		</div>
	</form>
</section>
</body>
</html>