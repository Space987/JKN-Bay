		<!-- Imports -->
    		<?php $this->view('header', ["style"=>'<link rel="stylesheet" href="/css/Buyer/index.css"/>',
    		"title"=>'Buyer']); ?>

		<div class="container rounded bg-white mt-5 mb-5">
	    	<div class="row">
	        	<div id = "profileMenu" class=" border-right">
	            	<div class="d-flex flex-column align-items-center text-center p-3 py-5">
	            		<img class="rounded-circle mt-5" style ="width: 200px; height: 200px;" src="/images/<?= $data['profile']->image?>">
	            		<span id='firstnameS' class="firstName"><?=$data['profile']->first_name?></span>
	            		<span class="text-black-50"><?=$data['profile']->last_name?></span>
	            		<span>Seller Rating: <span class="text-black-50"><?=$data['profile']->ratingSeller?></span></span>
	            	</div>
	        	</div>

	        	<div class="col-md-3">
	                <h4 class="text-right"> <?= _("Products") ?> </h4>
	                <?php
	                    foreach($data['products'] as $item){
	                    	if($item->status == 'selling'){
								echo"
									<div id='container'>	
										<div class='product-details'>					
											<h1 id='nameI'>$item->name</h1>	
															 	
											<span class='desc'>$item->description</span>		
											<a href='/Message/contactSeller/$item->profile_id/$item->product_id' class='btn btn-primary'>
										   				<span class='buy'> " . _("Contact Seller") . "</span>
										 	</a>
																				
											<div class='control2'>
												<a class='btn btn-success' href='/Buyer/addToCart/$item->product_id'>
													<span class='buy'> " . _("Add to Cart") . "</span>
										 		</a>
											</div>
										</div>
											
										<div class='product-image'>
											<img src='/images/$item->image' alt=''>
											
												<div class='info'>
													<h2> " . _("Details") . "</h2>
													
													<ul>
														<li><strong> " . _("Quality:") . "</strong>$item->state </li>
														<li><strong> " . _("In stock:") . "</strong>$item->quantity</li>
														<li><strong> " . _("Price:") . "</strong>$$item->price</li>
														<li><strong> " . _("Rating:") . "  </strong>$item->rating</li>
													</ul>
												</div>
										</div>
									</div>
								";
							}
						}
					?> 
				</div>
			</div>
		</div>
	</body>
</html>