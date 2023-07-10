<?php

$exp = time()+604800;
setcookie("visited", "yes", $exp);

?>

<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Agora Markets Home</title>
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/66c5181835.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<div id="store-header">
		<i class="fa-solid fa-shop my-3 mx-1" style="font-size:48px;"></i>
		<i class="fa-brands fa-shopify my-3 mx-1" style="font-size:48px;"></i>
		<i class="fa-solid fa-cart-shopping my-3 mx-1" style="font-size:48px;"></i>
		<i class="fa-solid fa-cloud my-3 mx-1" style="font-size:48px;"></i>
		
	</div>

	<nav class="navbar navbar-expand-lg navbar-light" id="navi">
		<div class="container-fluid">
			<div>
			<a class="navbar-brand" style ="color: #761a1a; font-weight: bold;">Agora Markets</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			</div>
			
			
			<div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0" id="top-menu">
					<li class="nav-item mx-2">
						<a class="nav-link menu-link" style ="color: #00204a" aria-current="page" href="market/marketMain.php">Your Markets</a>
					</li>
					<li class="nav-item mx-2">
						<a class="nav-link menu-link" style ="color: #00204a;" href="market/productsMain.php">Your Products</a>
					</li>
					<li class="nav-item mx-2">
						<a class="nav-link menu-link" style ="color: #00204a;" href="userProfile.php">Your Account</a>
					</li>
				</ul>
				<form class="d-flex" style="margin-left: 3rem; margin-top: 1rem;">
					<input class="form-control ms-4" style="margin-right: 1rem;" type="search" placeholder="Search" aria-label="Search">
					<button class="btn my-button" type="submit">Search</button>
				</form>
			</div>
		</div>
	</nav>
	
	<div class="container px-5">
	<?php
		if (!isset($_COOKIE['visited'])) {
			echo '<h1 class="mt-5 mb-5 pt-4 pb-2 display-4">Welcome to Agora Markets</h1>';
		} else {
			echo '<h1 class="mt-5 mb-5 pt-4 pb-2 display-4">Welcome back!</h1>';
		}	
	?>
	<br /><h5 class="mt-5 mb-4" style="font-weight: normal">Agora consists of many markets. Please select to enter the individual markets that are available below: </h5> <br />
	
	<form action="market/processSelection.php" method="POST">
		<div class="form-group text-center">
          <select
            class="form-select form-div form-control"
            id="inputUserTypeSignup"
            aria-label="Default select example"
			name="market"
          >
            <option selected>Select available markets</option>
            <option value="le_ciel_gifts">Le_Ciel_Gifts</option>
          </select>
		</div>
		<button type="submit" class="btn btn-secondary mt-5 mb-2">Enter</button>
	</form>
	<br /><br /><i class="mt-5" style="color: #7c73e6">Create your own market as an admin <a href="market/signUpMarket.php" class="links">here.</a></i>
	
	<!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
      integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
      integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK"
      crossorigin="anonymous"
    ></script>
</body>
</html>	
