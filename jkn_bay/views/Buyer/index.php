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

		<!-- CSS Styles -->
			<link rel="stylesheet" href="/css/Buyer/index.css"/>

	    <!-- Js -->
	    	<script type="text/javascript" src="/js/buyer.js"></script>

		<title>Buyer</title>
	</head>
	
	<body onload="changeCat()">
		<!-- Nav -->
    	<?php $this->view('nav'); ?>
		
		<!-- Title of page -->
		<h1> <?= _("Catelog") ?> </h1>
				
		<!-- Search for products -->	
		<div class='search'>
			<form action='/Profile/search/' method="get">
				<div class="input-group rounded">
					<div class="form-outline">
						<input type="text" id="searchbar" class="form-control" name="searchbar" placeholder="Search" />
					</div>
				  
				  	<button name="action" class="btn btn-primary" id="searchIcon">
				    	<i class="fa fa-search"></i>
				  	</button>
				</div>
			</form>
		</div>

		<div class='filters'>
			<label> <?= _("Filter by Category:") ?>
				<select class='form-select' name='category' id='category' onchange='changeURL(this)'>
					<option selected> None </option>
					<?php
						foreach ($data['categorys'] as $category){
							echo "	
								<option id='category' value='$category->category_id'>$category->nicename</option>";

						}
					?>
				</select>
			</label><br>
		</div>

		<?php
			foreach($data['product'] as $item) {	
				if($item->status == 'selling'){
					echo"
						<div id='container'>	
							<div class='product-details'>					
								<h3>$item->name</h3>
								<span class='desc'>$item->description</span>
								<br><br>
								";
								if(isset($_SESSION['profile_id'])){
									echo "
											<div class='controls'>
										<a href='/Buyer/viewSeller/$item->profile_id' class='btn btn-primary'>
							   				<span class='buy'> " . _("View Seller") . "</span>
							 			</a>
							 		</div>
								
										
									<div class='controls'>
										<a class='btn btn-success' href='/Buyer/addToCart/$item->product_id'>
						   					<span class='buy'> " . _("Add to Cart") . "</span>
						 				</a>
									</div>
									";
								}		
						echo "		
							</div>
							
							<div class='product-image'>
								<img src='/images/$item->image' alt=''>
								
									<div class='info'>
										<h2> " . _("Details") . "</h2>
										
										<ul>
											<li><strong> " . _("Quality:") .  " </strong>$item->state </li>
											<li><strong>  " . _("In stock:") .  "</strong>$item->quantity</li>
											<li><strong> " . _("Price:") .  "</strong>$$item->price</li>
											<li><strong>Rating:</strong>$item->rating</li>
										</ul>
									</div>
							</div>
						</div>
					";
				}
				 else{
					continue;
				}
			}		
		?>
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