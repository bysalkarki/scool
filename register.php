<?php
include("config.php");
$error = "";
$msg = "";
if (isset($_REQUEST['reg'])) {
	$name = $_REQUEST['name'];
	$email = $_REQUEST['email'];
	$phone = $_REQUEST['phone'];
	$pass = $_REQUEST['pass'];
	$utype = $_REQUEST['utype'];

	$uimage = $_FILES['uimage']['name'];
	$temp_name1 = $_FILES['uimage']['tmp_name'];
	$pass = sha1($pass);

	$query = "SELECT * FROM user where uemail='$email'";
	$res = mysqli_query($con, $query);
	$num = mysqli_num_rows($res);

	if ($num == 1) {
		$error = "<p class='alert alert-warning'>Email Id already exists</p> ";
	} else {
		$sql = "INSERT INTO user (uname,uemail,uphone,upass,utype,uimage) VALUES ('$name','$email','$phone','$pass','$utype','$uimage')";
		$result = mysqli_query($con, $sql);
		move_uploaded_file($temp_name1, "admin/user/$uimage");
		if ($result) {
			$msg = "<p class='alert alert-success'>Registered Successfully</p> ";
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Meta Tags -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" href="images/favicon.ico">

	<!--	Fonts
	========================================================-->
	<link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

	<!--	Css Link
	========================================================-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/layerslider.css">
	<link rel="stylesheet" type="text/css" href="css/color.css">
	<link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<script>
		function validateForm() {
			var name = document.forms["regForm"]["name"].value;
			var email = document.forms["regForm"]["email"].value;
			var phone = document.forms["regForm"]["phone"].value;
			var pass = document.forms["regForm"]["pass"].value;
			var uimage = document.forms["regForm"]["uimage"].value;

			var namePattern = /^[A-Za-z\s]+$/; 
			var emailPattern = /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/;
			var phonePattern = /^(97|98)\d{8}$/;

			if (name == "" || email == "" || phone == "" || pass == "" || uimage == "") {
				alert("Please fill all the fields.");
				return false;
			}

			if (!namePattern.test(name)) {
				alert("Please enter a valid name.");
				return false;
			}

			if (!emailPattern.test(email)) {
				alert("Please enter a valid email.");
				return false;
			}

			if (!phonePattern.test(phone)) {
				alert("Please enter a valid phone number.");
				return false;
			}

			if (pass.length < 6) {
				alert("Password must be at least 6 characters long.");
				return false;
			}

			var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
			if (!allowedExtensions.exec(uimage)) {
				alert("Please upload a valid image file (JPEG/PNG).");
				return false;
			}

			return true;
		}
	</script>
</head>

<body>
	<div id="page-wrapper">
		<div class="row">
			<?php include("include/header.php"); ?>
			<div class="page-wrappers login-body full-row bg-gray">
				<div class="login-wrapper">
					<div class="container">
						<div class="loginbox">
							<div class="login-right">
								<div class="login-right-wrap">
									<h1>Register</h1>
									<p class="account-subtitle">Access to our dashboard</p>
									<?php echo $error; ?><?php echo $msg; ?>
									<form name="regForm" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
										<div class="form-group">
											<input type="text" name="name" class="form-control" placeholder="Your Name*">
										</div>
										<div class="form-group">
											<input type="email" name="email" class="form-control" placeholder="Your Email*">
										</div>
										<div class="form-group">
											<input type="text" name="phone" class="form-control" placeholder="Your Phone*" maxlength="10">
										</div>
										<div class="form-group">
											<input type="password" name="pass" class="form-control" placeholder="Your Password*">
										</div>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" class="form-check-input" name="utype" value="user" checked>User
											</label>
										</div>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" class="form-check-input" name="utype" value="agent">Agent
											</label>
										</div>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" class="form-check-input" name="utype" value="builder">Builder
											</label>
										</div>
										<div class="form-group">
											<label class="col-form-label"><b>User Image</b></label>
											<input class="form-control" name="uimage" type="file" accept=".jpeg,.jpg,.png">
										</div>
										<button class="btn btn-success" name="reg" value="Register" type="submit">Register</button>
									</form>
									<div class="text-center dont-have">Already have an account? <a href="login.php">Login</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php include("include/footer.php"); ?>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<!--jQuery Layer Slider -->
	<script src="js/greensock.js"></script>
	<script src="js/layerslider.transitions.js"></script>
	<script src="js/layerslider.kreaturamedia.jquery.js"></script>
	<!--jQuery Layer Slider -->
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/tmpl.js"></script>
	<script src="js/jquery.dependClass-0.1.js"></script>
	<script src="js/draggable-0.1.js"></script>
	<script src="js/jquery.slider.js"></script>
	<script src="js/wow.js"></script>
	<script src="js/custom.js"></script>
</body>

</html>