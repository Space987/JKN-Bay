<div class='navbar'>
	<?php 
	if(!isset($_SESSION['username'])){
			echo '
    		<a  href ="/Buyer/index">' . _("Home") . '</a>
    		<a></a>
    		<a></a>
				<img src="/images/jknimage.png" alt="JKN" />
    		<a></a>
    		<a  href ="/Profile/index"> ' . _("Login") . '</a>
    		<div class="dropdown">
                      <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ' . _("Languages") . '
                    </a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="?lang=fr_CA">Francais</a>
                    <a class="dropdown-item" href="?lang=en">English</a>
                  </div>
                </div>
    		<a href ="/Profile/register"> ' . _("Sign up") . '</a>
    	';
	} else{
		if($_SESSION['role'] != null){
			if($_SESSION['role'] == 'seller'){
			echo '
				<a class="nav-link" href ="/Product/index"> ' . _("Home") . '</a>
		        <a class="nav-link" href ="/Message/indexSellerMes"> ' . _("Messages") . '</a>
		        <a class="nav-link" href ="/Product/add"> ' . _("New Product") . '</a>
				<img src="/images/jknimage.png" alt="JKN" style="max-width: 150px; max-height: 150px;"/>
		        <a class="nav-link" href ="/Profile/edit/<?= $_SESSION["profile_id"]?"> ' . _("My profile") . '</a>
				<a class="nav-link" href ="/Product/soldHistory">' . _("History") . '</a>
				<div class="dropdown">
                      <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ' . _("Languages") . '
                    </a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="?lang=fr_CA">French</a>
                    <a class="dropdown-item" href="?lang=en">English</a>
                  </div>
                </div>
				<a class="nav-link" href ="/Profile/logout">Logout</a>
			';}
			if($_SESSION['role'] == 'buyer'){
				echo '
				<a class="active" href ="/Buyer/index"> ' . _("Home") . '</a>
				<a  href ="/Buyer/viewCart"> ' . _("Cart") . '</a>
				<a  href ="/Message/indexBuyerMes"> ' . _("Messages") . '</a>
				<img src="/images/jknimage.png" alt="JKN" style="max-width: 150px; max-height: 150px;"/>
				<a  href ="/Profile/edit/<?= $_SESSION["profile_id"]?"> ' . _("My profile") . '</a>
				<a  href ="/Buyer/orderHistory"> ' . _("History") . '</a>
				<div class="dropdown">
                      <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ' . _("Languages") . '
                    </a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="?lang=fr_CA">French</a>
                    <a class="dropdown-item" href="?lang=en">English</a>
                  </div>
                </div>
				<a  href ="/Profile/logout"> ' . _("Logout") . '</a>
				';
			}
		}
	}
	?>
</div>