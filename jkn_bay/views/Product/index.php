		<!-- Imports -->
    		<?php $this->view('header', ["style"=>'<link rel="stylesheet" href="/css/Product/index.css"/>',
    		"title"=>'Seller Page']); ?>

		<h1 class="display"> <?= _("My Products") ?> </h1>
	
		<div>
			<?php
				foreach($data['product'] as $item){
					if($item->status == 'selling'){
						echo"
							<div id='container'>	
								<div class='product-details'>					
									<h3 type='name'>$item->name</h3>
						 			
									<span class='desc'>$item->description</span	>
									<br><br>
									
										<div class='controls'>
												<a class='btn btn-primary' href='/Product/edit/$item->product_id'>
							   					<span class='buy'> " . _("Edit") . "</span>
							 				</a>
										</div>

										<div class='controls'>
												<a class='btn btn-danger' href='/Product/delete/$item->product_id'>
							   					<span class='buy'> " . _("Delete") . "</span>
							 				</a>
										</div>

								</div>
							
								<div class='product-image'>
									<img src='/images/$item->image' alt=''>
							
									<div class='info'>
										<h2> " . _("Details") . " </h2>
										<ul>
											<li><strong> " . _("Quality:") .  "</strong>$item->state </li>
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
	</body>		
</html>