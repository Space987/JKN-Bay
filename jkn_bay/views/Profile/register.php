<html>
	<head>
		<meta charset="utf-8" />
		
		<!-- Jquery -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

		<!-- Bootstrap Css --> 
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

		<!-- Bootstrap JS -->
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

		<!-- Alertify -->
			<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
			<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
			<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
			<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
			<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
		
		<!-- Font-Awesome -->
	        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- Scripts -->
			<script type="text/javascript" src="/js/popup.js"></script>

		<!-- Nav CSS -->
			<link rel="stylesheet" href="/css/nav.css"/>			
			<link rel="stylesheet" href="/css/Profile/register.css"/>

		<title>Register</title>
	</head>

	<body onload="loadImage()">	
		<!-- Nav -->
    	<?php $this->view('nav'); ?>
		<!-- Form to allow user to sign up -->
			<form action='' method='post' enctype="multipart/form-data">
 			<h1> <?= _("Sign Up") ?> </h1>

	 		<h4> <?= _("When you register to a new account you get a one time use discount code for 20 percent off") ?> </h4>

			<div class="form-group-left">
				<label for="username"> <?= _("Username") ?> </label>
				<input type="text" class="form-control" id="username" name='username' placeholder="Enter username">
			</div>

			<div class="form-group">
				<label for="password"> <?= _("Password") ?> </label>
				<input type="password" class="right form-control" id="password" name="password" placeholder="Enter Password">
			</div>

			<div class="form-group-left">
				<label for="passwordConf"> <?= _("Password Confirmation") ?> </label>
				<input type="password" class="form-control" id="passwordConf" name="password_confirmation" placeholder="Re-enter Password">
		    </div>

    		<div class="form-group">
				<label for="first_name"> <?= _("First Name") ?> </label>
				<input type="text" class="right form-control" id="first_name" name="first_name" placeholder="Enter First Name">
			</div>

			<div class="form-group-left">
    			<label for="last_name"> <?= _("Last Name") ?> </label>
    			<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name">
 			</div>

 			<div class="form-group">
    			<label for="postal_code"> <?= _("Postal Code") ?> </label>
    			<input type="text" class="right form-control" id="postal_code" name="postal_code" placeholder="Enter Postal Code">
    		</div>

		    <div class="form-group-left">
	    		<label for="city"> <?= _("City") ?> </label>
	    		<input type="text" class="form-control" id="city" name="city" placeholder="Enter City">
	 		</div>

	 		<div class="form-group">
	  			<?= _("Select Account Type") ?> 
				<label for="role_buy"> <input type="radio" id="role_buy" name="role" value="buyer"> <?= _("Buyer") ?> </label>
				<label for="role_sell"> <input type="radio" id="role_sell" name="role" value="seller"> <?= _("Seller") ?> </label>
			</div>

			<div class="form-group-left">
				<label for="image_preview"><?= _("Profile Picture") ?> </label>
				<input type="file" name="image" id="image" /><br>
	    		<img id='image_preview' src='/images/blank.jpg' style="max-width:200px; max-height:200px; min-height: 200px; min-width: 200px;"/><br>
			</div>

			<div class="form-group-button">
				<br><br>
				<button type="submit" name='action'class="btn btn-success"> <?= _("Sign up") ?> </button>	
			</div>
		</form>
	</body>
</html>


	<!-- PopUp Acceptances -->
		<?php
		if(isset($_GET['message'])){
			echo"<script>popUpSuccess('$_GET[message]');</script>";
		}
		?>

		<?php
		if(isset($_GET['error'])){
			echo"<script>popUpError('$_GET[error]');</script>";
		}
		?>	