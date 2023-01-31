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

			<!-- Css -->
			<link rel="stylesheet" href="/css/Buyer/orderHistory.css"/>
		
		<!-- Js -->
	    	<script type="text/javascript" src="/js/buyer.js"></script>

		<title>Order history</title>
	</head>
	
	<body>	
		<!-- Nav -->
    	<?php $this->view('nav'); ?>

		<h1 class='title'>My Orders</h1>	

		<div class="order">
		<?php
				$order_id = 0;
				foreach($data['order'] as $item){
					$rate = "<div id = '$item->product_id P'>
					<button id = 'myBtn' type='button' class='fa fa-thumbs-o-up btn1' name= 'ONN' onclick='javascript:toggle(this, $item->product_id);'></button>
					</div>";

					$rateSeller = "<div id = '$item->rate_seller_id L'>
						<button id = 'myBtn' type='button' class='fa fa-thumbs-o-up btn1' name= 'ONN' onclick='javascript:toggleSeller(this, $item->product_id);'></button>
					</div>";

					if($item->r_product_id != NULL && $item->r_profile_id != NULL){
							$rate = "<div id = '$item->product_id P'>
						<button id = 'myBtnOff' type='button' class='fa fa-thumbs-up btn2' name= 'OFF' onclick='javascript:toggle(this, $item->product_id);'></button>
					</div>";
					}

					if($item->rate_seller_id != NULL && $item->rate_profile_id != NULL){
							$rateSeller = "<div id = '$item->product_id L'>
						<button id = 'myBtnOff' type='button' class='fa fa-thumbs-up btn2' name= 'OFF' onclick='javascript:toggleSeller(this, $item->product_id);'></button>
					</div>";
					}
							
					if($order_id != $item->order_id){
							echo '
								</ul>
									</hr>
									</div>
								</article>
								</div>
								<br>
							';
						}
					if($order_id != $item->order_id){
									echo "
											<div class='container'>
												<article class='card' style='margin-bottom: 2%; width: 80%; margin-left: 10%;'>
	        									<div class='card-body'>
	            									<h6>Order: $item->order_id</h6>
	            									
	            									<article class='card1'>
								                		
								                		<div class='card-body row'>
								                    		<div class='card-body row'>
								                    			<div class='col'> <strong>Status:</strong><br>$item->status</div>
								                    			<div class='col'> <strong>Total:</strong><br>$$item->total</div>
								                    			<div class='col'> <strong>Date:</strong><br>$item->date</div>
								                    			
								                		</div>
								            		</article>
							            	<hr style='display:inline-block'>
								        	<ul class='row'>
								";
						}
						echo '
	            <ol class="col-md-4" >
								<figure class="itemside">
                      <div class="aside"><img src="/images/'. $item->image. '" class="img-sm border" style="max-width: 200px; max-height: 200px; min-height: 200px; min-width: 200px"></div>
                      <figcaption class="info align-self-center">
                          <p class="title" style="width: 200px; text-align: center; margin-left: 2px;">' . $item->name . '</p> 
                          <span style="margin-left: 45%;">Quantity:'. $item->qty . '</span>

                            <div class="col"> <strong>Rate Product:</strong><br><div id = "' . $item->product_id . ' R">

							<a id ="myRating ' .$item->product_id . '"> '. $item->rating .' </a>
							</div>
							 '. $rate . '
							 <div class="col"> <strong>Rate Seller: '. $item->username .'</strong><br><div id = "' . $item->product_id . ' J">
							<a id ="myRatingSeller ' .$item->product_id . '"> '. $item->ratingSeller .' </a>
							</div>
							 '. $rateSeller . '
                  </figcaption>
									</figure>
					 				</ol>	 											               
								';
						$order_id = $item->order_id;
						}	
		?>
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