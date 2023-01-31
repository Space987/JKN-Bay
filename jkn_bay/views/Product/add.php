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
			<link rel="stylesheet" href="/css/Product/addProduct.css"/>

		<title>Add Product</title>
	</head>
	
	<body onload="loadImage()">
		<!-- Nav -->
    	<?php $this->view('nav'); ?>

		<h1> <?= _("Add your Product") ?> </h1>
		<div class="col-md-5">
	    	<div class="p-3 py-5">
				<form action='' method='post' enctype="multipart/form-data">
					<div class="form-group">
						<label for="name"> <?= _("Name:") ?> </label>
				   		<input type="text" class="form-group" id="name" name='name'>
				   	</div>

				   	<div class="form-group">
				   		<label for="desc"> <?= _("Description:") ?> </label>
				   		<input type="text" class="form-group" id="desc" name='description'>
				   	</div>

				   	<div class="form-group">
			    		<label for="price"> <?= _("Price:") ?> </label>
			    		<input type="number" min="0" step='0.01' class="form-group" id="price" name='price'>
					</div>

					<div class="form-group">
						<label for="quantity"> <?=_("Quantity in Stock:") ?> </label>
			    		<input type="number" min="0" class="form-group" id="quantity" name='quantity'>
			    	</div>

			    	<div class="form-group">
				   		<label> <?= _("Filter by Category:") ?> 
							<select name='category' id='category'>
								<option selected>None</option>
									<?php
										foreach ($data['categorys'] as $category){
											echo "	
											<option id='category' value='$category->category_id'>$category->nicename</option>";
									}
								?>
							</select>
						</label>
			    	</div>

			    	<div class="form-group">
						<p> <?= _("Condition") ?> </p>
			    		<input type="radio" id="state_new" name="state" value="new" checked>
						<label for="state_new"> <?= _("New") ?> </label>
			  			<input type="radio" id="state_used" name="state" value="used">
						<label for="state_used"> <?= _("Used") ?> </label>
			  		</div>
						
					<div class="form-group">
						<label for="image_preview"> <?= _("Image") ?> </label>
						<input type="file" name="image" id="image" />
			    		<img id='image_preview' src='/images/blank.jpg' style="max-width:200px;max-height:200px"/><br>
			    	</div>		
		  			<button type="submit" name="action" class="btn btn-success"> <?= _("Add your new Product") ?> </button>
				</form>
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