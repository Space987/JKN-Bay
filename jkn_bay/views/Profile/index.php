		<!-- Imports -->
    		<?php $this->view('header', ["style"=>'<link rel="stylesheet" href="/css/Profile/login.css"/>',
    		"title"=>'Login']); ?>

	<body>	
		<!-- Form to allow user to login -->
			<form action='' method='post'>
				<div id="main" class='float-container' style="margin-top: 5%;">
					<div class='float-child'>
						<h2 style="margin-bottom: 3%;"> <?= _("Login") ?> </h2>

						<label><?= _("Username") ?> </label>
						<input type="text" name='username' class="form-control" style='max-width: 60%;  margin-bottom: 5%; '/>

						<label><?= _("Password") ?> </label>
						<input type="password" name='password' class="form-control" style='max-width:60%;  margin-bottom: 5%;'/>

						<button type="submit" name='action' class='btn btn-primary'  style='margin-left: 48%;' value='Login'><?= _("Login") ?> </button>
						<p style="margin-top: 2%; margin-left: 20%;"> <?= _("Don't have an account?") ?> <a href ="/Profile/register"> <?= _("Sign Up") ?> </a></p>
					</div>

					<div class='float-child'>
						<h2> <?= _("Welcome to JKN Bay") ?> </h2>
						<p>
							<?= _("The company, which caters to individual sellers and small businesses, is a market leader in e-commerce worldwide. JKN-Bay is headquartered in Montreal, Canada. Customers can participate in Web sites set up within their own country or use one of the company's international sites.") ?> 
							<br></br>
						</p>
					</div>
				</div>
			</form> 
	</body>
</html>