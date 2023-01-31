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

	    	<!-- Css -->
			<link rel="stylesheet" href="/css/Message/messageView.css"/>
			<link rel="stylesheet" href="/css/modal.css"/>
		
		<!-- Js -->
	    	<script type="text/javascript" src="/js/messages.js"></script>

		<title>Message</title>
	</head>
		
	<body onload="message()">	
	<div class='mainContainer'>

		<!-- Nav -->
    	<?php $this->view('nav'); ?>

		<h1 class='title'> <?= _("My Messages") ?> </h1>

		<?php
			foreach($data['discountM'] as $item){
				echo "
					<div class='container'>
		    			<article class='card' style='width: 70%; margin-left: 15%;'>
		    				<div class='card-body'>
		    					<h6> " . _("Discount") . "</h6>
		            									
		    					<article class='card1'>
							                		
			                		<div class='card-body row'>
			                    		<div class='card-body row'>
			                    			<div class='col'> <strong>Message:</strong><br>$item->message</div>
				                    			<div class='col'> <strong> " . _("Date and Time:") . "</strong><br>$item->date_time</div>
					                			</div>
					                		</div>
							    </article>
							    	       	<hr style='display:inline-block'>
									        	<ul class='row'>
									        	</ul>
											</hr>
				    					</div>

						</article>
									</div>
									<br> 	
					";
			}

			$product_id_saved = 0;
			$message_id = 0;

			foreach($data['messages'] as $item){
				if($message_id == 0){
					$message_id = $item->message_id;
				}
							
				if($item->product_id != $product_id_saved && $product_id_saved != 0){
					echo'
						<button class="mbtn btn btn-primary turned-button" message_id= "' . $message_id . '" style="width: 120px; margin-left: 80%; margin-bottom: 3%;"> ' . _("Reply") . '</button>
						</article>
						</div>
				    	</article>
				    	</div>	
						<br> 
					';
					$message_id = $item->message_id;
				}

				if($item->product_id != $product_id_saved){
					echo "
						<div class='container' style='margin-bottom: 15px'>
		    				<article class='card' style='width: 70%; margin-left: 15%;'>
		        				<div class='card-body'>
		            				<h6> " . _("Product:") . "$item->name</h6>
		            							
		            					<article class='card1'>    		
								            
					";
				}
				echo"
					<div class='card-body row'>
			           	<div class='card-body row'>
							<div class='col'> <strong> " . _("Message:") . " </strong><br>$item->message</div>
							    <div class='col'> <strong> " . _("Date:") . "</strong><br>$item->date_time</div>
								    <div class='col'> <strong> " . _("Sent from:") . "</strong><br>$item->username</div>
									</div>
					    		</div>				            		
				";
				$product_id_saved = $item->product_id;
				$message_id = $item->message_id;	
			}

			if($data['messages'] != null){
				echo '
					<button class="mbtn btn btn-primary" message_id= "' . $message_id . '" style="width: 120px; margin-left: 80%; margin-bottom: 3%;"> ' . _("Reply") . '</button>';					
			}
		?>
	</body>

	<!-- modal -->
		<?php $this->view('modal'); ?>
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