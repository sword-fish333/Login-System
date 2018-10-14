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
	<?php
	$email=$passwd=$error="";
	$errorflag=false;
	$erroremail="<h3 class='errormail'>Email required...</h3>";
	$errorpasswd="<h3 class='errorpasswd'>Password required...</h3>";
	if(isset($_POST['submit'])){
		if(empty($_POST['email'])){
			echo $erroremail;
			$errorflag=false;
		}elseif(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
	$erroremail="<h3 class='errormail'>Invalid email...</h3>";
	echo $erroremail;
			$errorflag=false;


		}else{
			$email=validation_input($_POST['email']);
			$errorflag=true;
		}

		if(empty($_POST['password'])){
			echo $errorpasswd;
			$errorflag=false;
		}else{
			$len=strlen($_POST['password']);
			if($len>15 || $len<3){
				$errorpasswd="<h3 class='errorpasswd'>Password must be between 3 and 15 characters...</h3>";
				echo $errorpasswd;
				$errorflag=false;
			}else{
				$passwd=validation_input($_POST['password']);
				$errorflag=true;
			}
		}

		if($errorflag==true){
			$query="SELECT * FROM log WHERE uname='$_POST[email]' AND passwd='$_POST[password]'";
			$execute=mysqli_query($conn,$query);
			$row=mysqli_fetch_array($execute);
			if($row>0){
				$_SESSION['user_id']=$row['id'];
				$home_url='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/Home.php';
				header("location:".$home_url);
			}else{

			$error="username or password do not match..!";

			}
		}
	}

	function validation_input($data){
		$data=trim($data);
		$data=stripcslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}
	?>
	<img src="images/minimal_poster.jpg" class="img1">
<section>
	<form action="Login.php" method="POST">
		<div class="container">
			<div class="div1">
				<h1>Login Page</h1>
							
			</div>
			<div class="div2">
				<img src="images/amelie.jpg" >
				<h4>Need an account? <a href="">Sign up!</a></h4>
				<input type="text" name="email" placeholder="email">
				<input type="password" name="password" placeholder="password">
				<span style="color: red; font-weight: bold;"><?php echo $error; ?></span>
				<input type="Submit" name="submit" id="sub" value="Sing in">
				<a href="">Forgot your password ?</a>
			</div>
		</div>
	</form>
</section>
</body>
</html>