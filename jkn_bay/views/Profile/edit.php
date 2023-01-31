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
			<link rel="stylesheet" href="/css/Profile/edit.css"/>

		<!-- Js -->
	    	<script type="text/javascript" src="/js/edit.js"></script>

		<title>Edit Profile</title>
	</head>
	
	<body onload="changeImage('<?= $data->image ?>'), loadImage()">

		<!-- Nav -->
    	<?php $this->view('nav'); ?>
      		
		<h1 style="margin: 3% 0% 3% 42%"> <?= _("Edit Profile") ?> </h1>
		<!-- Form to allow user to edit profile -->
			<div class="everything">
				<div class="col-md-5">
		    		<div class="p-3 py-5">
						<form action='' method='post' enctype="multipart/form-data">
							<div class="form-group">
								<label><?= _("Username") ?> </label>
								<input type="text" class="form-control" name='username' value="<?= $data->username ?>">
							
								<label><?= _("First Name") ?> </label>
								<input type="text" class="form-control" name="first_name" value="<?= $data->first_name ?>">
							
								<label> <?= _("Last Name") ?> </label>
								<input type="text" class="form-control" name="last_name" value="<?= $data->last_name ?>">
							
								<label> <?= _("Postal Code") ?> </label>
								<input type="text" class="form-control" name="postal_code" value="<?= $data->postal_code ?>">
							
								<label> <?= _("City") ?> </label>
								<input type="text" class="form-control" name="city"value="<?= $data->city ?>">
								
								<label> <?= _("Profile Image:") ?> <input type="file" name="image" id="image" />
								</label><img id='image_preview' src='/images/blank.jpg' style="max-width:200px; max-height: 200px" /><br>
								
								<button style='margin-left: 37%; margin-top: 4%;' type="submit" name='action' class="btn btn-success"> <?= _("Save") ?> </button>
							</div>
						</form>
					</div>
				</div>
			</div>		
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