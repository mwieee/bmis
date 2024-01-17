<?php
session_start();

if (isset($_SESSION['id'])) {
 		header('location:home.php');
 	}
?>
<html style="background: #7C81AD; background-repeat: no-repeat; background-size:cover;">
<title>Barangay Management Information System</title>
<link rel="stylesheet" type="text/css" href="Css/b.css">
<link rel="shortcut icon"  href="Icon/newlogo.png">
<!-- <script src="css/ism-2.2.min.js"></script>
<link rel="stylesheet" href="Css/slider.css">  -->
<style type="text/css">
	.nav {
  background-color: #2e4a62;
  border: none;
  width: 100%;
  position:fixed;
  overflow: hidden;
  top: 0;
  left: 0;
  text-transform: uppercase;
  font-family: calibri;
}
</style>
<div class="nav">
	<a href="index.php">home</a>
	<a href="about.php">about</a>
</div>

<body>
<div class="container"  >	
	<!-- <img src="Picture/indang1.jpg" style="float:left" width="60%" height="73%"> -->
</div>
	<div class="right" >
	<section class="banner">Sign In</section> </br> </br>
	<center><img src="Icon/newlogo.png" height="100" width="100" ></center>
	<form method="POST">
			<input type="text" name="username" required autofocus placeholder="Enter Username">
			<input type="password" name="password" required autofocus placeholder="Enter Password">
			
			<input type="Submit" name="submit" value="Enter">
			<script>
function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "Passwordrd";
    }
}
</script>
	</div>

		</form>
</div>

<?php
include('db.php');

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$qry = mysqli_query($db, "SELECT * FROM Accounts WHERE Username ='$username'");
	$count = mysqli_num_rows($qry);

	if ($count > 0) {
		$accnt = mysqli_fetch_array($qry);
		$pass=$accnt['Password'];

		
		$_SESSION['id'] = $accnt['ID'];


		if($pass==$password && $username==$username){
				
		$pos = $accnt['position_id'];
				$position=$accnt['Position'];
				$committee=$accnt['Committee'];
				$fullname = $accnt['Fullname'];
				$_SESSION['LOGIN_STATUS'] = true;
				$_SESSION['position'] = $position;
				$_SESSION['USER'] = $username;
				$_SESSION['committee'] = $committee;
				$_SESSION['password'] = $password;
				$_SESSION['positionID'] = $pos;
				$_SESSION['fullname'] = $fullname;
				$_SESSION['position_id'] = $accnt['position_id'];
				echo "<script>alert('Welcome.');</script>";
				echo '<script>window.location = "home.php";</script>';


		}
		else {
		echo "<script>alert('Incorrect Password.');</script>";
		}

	}
	else {
	echo "<script>alert('Invalid username.');</script>";
	}

} 
?>

</body>
</html>


