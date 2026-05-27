<title><?= $title . ' | ' . PROJECT_NAME ?></title>
	
	<link rel="stylesheet" href="<?= base_url('assets/website/css/bootstrap.min.css') ?>">
	<!-- Plugin css -->
	<link rel="stylesheet" href="<?= base_url('assets/website/css/plugin.css') ?>">

	<!-- stylesheet -->
	<link rel="stylesheet" href="<?= base_url('assets/website/css/style.css') ?>">
	<!-- responsive -->
	<link rel="stylesheet" href="<?=base_url('assets/website/css/responsive.css') ?>">
	
	<link href="<?= base_url(LOGO.$Setting->logo) ?>" rel="shortcut icon">

<header class="header">
		<div class="overlay"></div>
		
		<!--Main-Menu Area Start-->
		<div class="mainmenu-area mainmenu-area2">
			<div class="container">
				<div class="row">
					<div class="col-lg-12" style="padding-left:0px !important; padding-right:0px !important;">                 
						<nav class="navbar navbar-expand-lg navbar-light">
							<a class="navbar-brand d-lg-none" href="<?= base_url('/') ?>">
								<img class="l2" src="<?= base_url('assets/website/images/logo.png') ?>" alt="">
							</a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu" aria-controls="main_menu"
								aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<a class="navbar-brand d-none d-lg-block" href="<?= base_url('/') ?>">
										<img class="l2" src="<?= LOGO.$Setting->logo ?>" alt="">
									</a>
							<div class="collapse navbar-collapse fixed-height" id="main_menu">
								<div class="main-menu-inner">
									<ul class="navbar-nav mr-auto">
										<li class="nav-item">
											<a class="nav-link" href="<?= base_url('/') ?>">Home</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="<?= base_url('about-us') ?>">About us</a>
										</li>
										
										<li class="nav-item">
											<a class="nav-link" href="<?= base_url('privacy-policy') ?>">Privacy Policy</a>
										</li>
									<ul class="navbar-nav ml-auto">
									<li class="nav-item">
											<a class="nav-link" href="<?= base_url('terms-conditions') ?>">Terms & Conditions</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="<?= base_url('refund-policy') ?>">Refund Policy</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="<?= base_url('contact-us') ?>">Contact us</a>
										</li>
										
										
									</ul>
								</div>
								
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<!--Main-Menu Area Start-->
	</header>
	