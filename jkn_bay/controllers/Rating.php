<?php
namespace jkn_bay\controllers;

class Rating extends \jkn_bay\core\Controller{

	public function addRating($product_id){

			$product = new \jkn_bay\models\Rating();
			$product = $product->get($product_id);	
			$product->rating = $product->rating + 1;

			$product = $product->changeRatingData();


			$rating = new \jkn_bay\models\Rating();
			$rating->product_id = $product_id;
			$rating->profile_id = $_SESSION['profile_id'];
			$rating = $rating->addRatingStatus();

 			
			header('location:/Buyer/orderHistory?message=ratingAdded');
	}
	public function subRating($product_id){

			$product = new \jkn_bay\models\Rating();
			$product = $product->get($product_id);	
			$product->rating = $product->rating - 1;
			

			$product = $product->changeRatingData();

			$rating2 = new \jkn_bay\models\Rating();
			$rating2->product_id = $product_id;
			$rating2->profile_id = $_SESSION['profile_id'];
			$rating2 = $rating2->subRatingStatus();

 			
			header('location:/Buyer/orderHistory?message=ratingSubtracted');
	}

	public function addRatingSeller($product_id){

			$seller = new \jkn_bay\models\Rating();
			$seller = $seller->getSeller($product_id);	
			$seller->ratingSeller = $seller->ratingSeller + 1;

			$oldId = $seller->profile_id;
			$seller = $seller->changeRatingDataSeller();

		
			$rating = new \jkn_bay\models\Rating();
			$rating->seller_id = $oldId;
			$rating->profile_id = $_SESSION['profile_id'];
			$rating = $rating->addRatingStatusSeller();

 			
			header('location:/Buyer/orderHistory?message=ratingAdded');
	}
	public function subRatingSeller($product_id){

			$seller = new \jkn_bay\models\Rating();
			$seller = $seller->getSeller($product_id);	
			$seller->ratingSeller = $seller->ratingSeller - 1;

			$oldId = $seller->profile_id;
			$seller = $seller->changeRatingDataSeller();


			$rating = new \jkn_bay\models\Rating();
			$rating->seller_id = $oldId;
			$rating->profile_id = $_SESSION['profile_id'];
			$rating = $rating->subRatingStatusSeller();

 			
			

 			
			header('location:/Buyer/orderHistory?message=ratingSubtracted');
	}	
}