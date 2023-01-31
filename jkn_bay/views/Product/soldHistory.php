		<!-- Imports -->
    		<?php $this->view('header', ["style"=>'<link rel="stylesheet" href="/css/Product/soldHistory.css"/>',
    		"title"=>'Sodl History']); ?>

		<h1 class='title'> <?= _("My Sold Products") ?> </h1>	

		<?php
			$order_id = 0;
				foreach($data['order'] as $item){	
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
    									<h6> " . _("Order ID:") . " $item->order_id</h6>
    									
    									<article class='card1'>
				                		
				                		<div class='card-body row'>
				                    		<div class='card-body row'>
				                    			<div class='col'> <strong> " . _("Status:") . " </strong><br>$item->status</div>
				                    			<div class='col'> <strong> " . _("Buyer:") . " </strong><br>$item->username</div>
				                    			<div class='col'> <strong> " . _("Date:") . " </strong><br>$item->date</div>
				                			</div>
				                		</div>
				            		</article>
				            	<hr style='display:inline-block'>
					        	<ul class='row'>
							";
					}

						echo "
				            <ol class='col-md-4' >
								<figure class='itemside'>
			                        <div class='aside'><img src='/images/$item->image' class='img-sm border' style='max-width: 200px; max-height: 200px; min-height: 200px; min-width: 200px'></div>
			                        <figcaption class='info align-self-center'>
			                            <p class='title' style='width: 200px; text-align: center; margin-left: 2px;'>$item->name</p> 
			                            <span style='margin-left: 45%;'>($item->qty)</span>
			                        </figcaption>
			                    </figure>
				 			</ol>	 											               
						";
					$order_id = $item->order_id;	
				}	
		?>
	</body>		
</html>