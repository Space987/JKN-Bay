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
	    	<script type="text/javascript" src="/js/edit.js"></script>

		<!-- Nav CSS -->
			<link rel="stylesheet" href="/css/nav.css"/>
			<link rel="stylesheet" href="/css/Product/editProduct.css"/>

		<title>Edit Product</title>
	</head>

	<body onload="changeImage('<?= $data['product']->image ?>'), loadImage(), loadVariable('<?= $data['product']->state ?>' , '<?= $data['product']->category_id ?>')">
	   	<!-- Nav -->
    	<?php $this->view('nav'); ?>

	   	<h1> <?= _("Product") ?> </h1>

		<!-- Display Product Info -->
		<div class="col-md-5 border-right">
    		<div class="p-3 py-5">		
				<h2> <?= _("Edit Product") ?>  </h2>

					<form action='' method='post' enctype="multipart/form-data">
						<div class="form-group">
							<label for="name"> <?= _("Name") ?> </label>
							<input type="text" class="form-control" id="name" name='name' value="<?= $data['product']->name ?>">
						</div>

						<div class="form-group">
							<label for="description"> <?= ("Description") ?> </label>
							<input type="text" class="form-control" id="description" name="description" value="<?= $data['product']->description ?>">
						</div>
		
				<div class = "right">
					<div class="form-group">
						<label for="price"> <?= _("Price") ?> </label>
						<input type="text" min="0" step='0.01' class="form-control" id="price" name="price" value="<?= $data['product']->price ?>">
					</div>

					<div class="form-group">
						<label for="quantity"> <?= _("Quantity") ?> </label>
						<input type="text" min="0" class="form-control" id="quantity" name="quantity" value="<?= $data['product']->quantity ?>">
					</div>

					<div class="form-group" id='states'>
						<p> <?= _("Condition") ?> </p>
			    		<input type="radio" id="state_new" name="state" value="new">
						<label for="state_new"> <?= _("New") ?> </label>
			  			<input type="radio" id="state_used" name="state" value="used">
						<label for="state_used"> <?= _("Used") ?> </label>
	  				</div>
					<div class="form-group">
			    			<label> <?= _("Category:") ?> 
							<select name='category' id='category' value=''>
									<option>None </option>
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
						<label> <?= _("Image:") ?> <input type="file" name="image" id="image" /></label><img id='image_preview' src='/images/blank.jpg' style="max-width:200px;max-height:200px" /><br>
					</div>

					<button type="submit" name='action' value='Register' class="btn btn-success"> <?= _("Save Changes") ?> </button>
				</div>

			</form>
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