	<!-- Imports -->
    		<?php $this->view('header', ["style"=>'<link rel="stylesheet" href="/css/Buyer/cart.css"/>',
    		"title"=>'Cart']); ?>

	<h1> <?= _("My Cart") ?> </h1>	

		<div id="divMainContainer">
			<table class="table table-striped">
				<tr><th></th><th> <?= _("Name") ?> </th><th> <?= _("Quantity") ?> </th><th> <?= _("Unit Price") ?> </th><th> <?= _("Product Price") ?> </th><th> <?= _("Actions") ?> </th></tr>
					<?php

						foreach($data['product'] as $item)
						{	echo"	
									<tr><td id='image'><img src='/images/$item->image' style='max-width: 150px; max-height: 150px;'></td><td>$item->name</td><td>$item->qty</td><td>$item->price</td><td>" . 
										$item->qty * $item->price . "</td><td>
									<a href='/Buyer/removeFromCart/$item->order_detail_id' class='btn btn-danger'>" . _("Delete") . "</a></td>
								";
						}
					?>
					<tr><th colspan=3> <?= _("Sub Total") ?> 
							<th class='discount'> <?= _("Discount code:") ?>  
								<form action="/Discount/applyDiscount/<?= $_SESSION['profile_id'] ?>" method='post'>
									<input type="text" class="form-control" name='code' style='max-width: 200px;'>
									<button type="submit" name='action' id='action' class="btn btn-success"> <?= _("Apply") ?> </button></th>
								</form>
							<th id="sum"><?= $data['cart']->total ?></th>
							<th><a href='/Buyer/checkout/' class='btn btn-success'> <?= _("Checkout") ?> </a></th></tr>
			</table>
</html>
