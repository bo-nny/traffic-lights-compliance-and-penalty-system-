<!DOCTYPE html>
<html lang="en">
<head>
	<title>TLCPS</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        };
    </script>

	<!-- <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css"> -->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">

<!--=============================================================================================== -->
	<!-- <link rel="stylesheet" type="text/css" href="css/util.css"> -->
	<link rel="stylesheet" type="text/css" href="css/main.css">

<!--===============================================================================================-->
<script src="./js/authenitcation.js"></script>

</head>

<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form action="login.php" method="POST">
					<span class="login100-form-logo">
						<img src="./images/flag.png" alt="Logo">
					  </span>

					<span class="login100-form-title" style="color: white">
						Traffic Officer Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter Officer Id">
						<input class="input100" type="text" name="officerid" placeholder="officerid">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<!-- Display error message if exists -->
						<?php if (isset($errorMessage)): ?>
							<p style="color: red;"><?php echo $errorMessage; ?></p>
						<?php endif; ?>
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1" >
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							LogIn
						</button>
						<!-- <input type="submit" name="submit" value="login now" class="login100-form-btn"> -->

					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href=" " style="color: white" >
							Forgot Password?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>