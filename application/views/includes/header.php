<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$current_url = current_url();
$explode_url = explode('/', $current_url);
$cntArr = count($explode_url);
$getLastfield = $explode_url[$cntArr-1];

$assetsVal = base_url().'assets';
$activeStatus = (isset($_COOKIE['menu_police']) && !empty($_COOKIE['menu_police']) && $_COOKIE['menu_police'] == 'yes' ? 'yes' : '');
$base_url = base_url();
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-9E3EN79Y98"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-9E3EN79Y98');
	</script>
    
	<!-- Global site tag (gtag.js) - Google Analytics -->
       
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv='expires' content='0'>
	<meta http-equiv='pragma' content='no-cache'>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="SafeCity">
	<meta name="generator" content="SafeCity">
	<title>SafeCity</title>

	<!-- Bootstrap core CSS -->
	<link href="<?php echo $assetsVal; ?>/images/favicon.png" rel="icon" type="image/png" />
	<link href="<?php echo $assetsVal; ?>/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/select2.min.css">
	<link href="<?php echo $assetsVal; ?>/css/style.css" rel="stylesheet">
	<link href="<?php echo $assetsVal; ?>/css/media-query.css" rel="stylesheet">
	<link href="<?php echo $assetsVal; ?>/css/all.min.css" rel="stylesheet">
	<link href="<?php echo $assetsVal; ?>/css/animate.compat.css" rel="stylesheet" >
	<link href="<?php echo $assetsVal; ?>/css/style-form.css" rel="stylesheet" >
	<link href="<?php echo $assetsVal; ?>/css/custom.css" rel="stylesheet" >
</head>
<body>

	<!-- Header Start -->
	<!-- Top Bar Start -->
	<header>
<!-- 		<div id="topbar">
			<div class="container">
				<div class="languageBar">
					<div class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							English
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">Hindi</a>
							<a class="dropdown-item" href="#">Marathi</a>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<!-- Top Bar End -->


		<nav class="navbar navbar-expand-md navbar-light border-bottom mb-2">
			<div class="container">
				<div class="desktop_nav logoNav">
					<a class="navbar-brand" href="home"><img src="<?php echo $assetsVal; ?>/images/safecity-logo.png" class="img-fluid logo"></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
				</div>

				<?php
					$homeArr = array($base_url."home", $base_url."");
					$hospitalArr = array($base_url."hospital_loc", $base_url."hospital_map", $base_url."hospital_listing");
					$viewDataArr = array($base_url."view-data");
					$policeArr = array($base_url."policestation_loc", $base_url."policestation_map", $base_url."policestation_listing");
					$menuArr = array($base_url."contact_us", $base_url."about_safecity", $base_url."faqs", $base_url."volunteer_with_us", $base_url."donate", $base_url."legal_resources", $base_url."filling_fir");
				?>

				<div class="desktop_nav desktopMainNav" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item <?php echo (in_array($current_url, $homeArr)) ? "active" : ''; ?>">
							<a class="nav-link main_menu" href="home">
								<?php echo $this->lang->line('home_menu'); ?>
							</a>
						</li>
						<!--<li class="nav-item <?php //echo (in_array($current_url, $viewDataArr)) ? "active" : ''; ?>">
							<a class="nav-link main_menu" href="view-data">
								<?php //echo $this->lang->line('view_data'); ?>
							</a>
						</li>-->
						<li class="nav-item <?php echo (in_array($current_url, $hospitalArr)) ? "active" : ''; ?>">
							<a class="nav-link main_menu" href="hospital_loc">
								<?php echo $this->lang->line('hospital_menu'); ?>
							</a>
						</li>
						<li class="nav-item <?php echo (in_array($current_url, $policeArr)) ? "active" : ''; ?>">
							<a class="nav-link main_menu" href="policestation_loc">
								<?php echo $this->lang->line('police_menu'); ?>
							</a>
						</li>

						<!-- <li class="nav-item dropdown police_dropdown <?php //echo (in_array($current_url, $policeArr) || $activeStatus == 'yes') ? "active" : ''; ?>">
							<a class="nav-link police_dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?php //echo $this->lang->line('police_menu'); ?>
								<i class="fas fa-angle-down"></i>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item themeColor policestation_drop" href="policestation_loc">
									<?php //echo $this->lang->line('police_staion'); ?>
								</a>
								<a class="dropdown-item themeColor policestation_drop" href="legal_resources">
									<?php //echo $this->lang->line('legal_menu'); ?>
								</a>
							</div>
						</li> -->

						<li class="nav-item dropdown <?php echo (in_array($current_url, $menuArr) && $activeStatus != 'yes') ? "active" : ''; ?>">
							<a class="nav-link main_menu dropdown_menu" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?php echo $this->lang->line('menu_option'); ?>
								<i class="fas fa-angle-down"></i>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item themeColor legal_menu_drop" href="legal_resources">		<?php echo $this->lang->line('legal_menu'); ?>
								</a>
								<a class="dropdown-item themeColor" href="contact_us">
									<?php echo $this->lang->line('contact_menu'); ?>
								</a>
								<a class="dropdown-item themeColor" href="about_safecity">
									<?php echo $this->lang->line('about_safecity_menu'); ?>
								</a>
								<a class="dropdown-item themeColor" href="faqs">
									<?php echo $this->lang->line('faq_menu'); ?>
								</a>
								<a class="dropdown-item themeColor" href="volunteer_with_us">
									<?php echo $this->lang->line('volunteer_menu'); ?>
								</a>
								<a class="dropdown-item themeColor" href="donate">
									<?php echo $this->lang->line('donate_menu'); ?>
								</a>
								<a class="dropdown-item themeColor" href="wellness-resources">
									<?php echo $this->lang->line('wellness_menu'); ?>
								</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?php
									if(isset($_COOKIE['language_val']) && !empty($_COOKIE['language_val'])){
								?>
									<h6 class="languageShortForm">
										<?php
											if($_COOKIE['language_val']=="Arabic"){
												echo $this->lang->line('lang_arabic');
											}else{
												echo $_COOKIE['language_val'];
											}
										?>
									</h6>
								<?php } else { ?>
									<img src="<?php echo $assetsVal; ?>/images/material-translate.svg" width="20" class="img-fluid languageImg">
								<?php } ?>
							</a>
							<div class="dropdown-menu dropdown-menu-center languageSelect" aria-labelledby="navbarDropdown">
								<a class="dropdown-item themeColor" data-val="EN" data-id="1" data-mainval="English" data-lang="English">
									<?php echo $this->lang->line('lang_english'); ?>
								</a>
								<a class="dropdown-item themeColor" data-val="HI" data-id="42" data-mainval="हिंदी" data-lang="Hindi">
									<?php echo $this->lang->line('lang_hindi'); ?>
								</a>
								<a class="dropdown-item themeColor" data-val="MR" data-id="76" data-mainval="मराठी" data-lang="Marathi">
									<?php echo $this->lang->line('lang_marathi'); ?>
								</a>
								<a class="dropdown-item themeColor" data-val="MS" data-id="77" data-mainval="Malay" data-lang="Malay">
									<?php echo $this->lang->line('lang_malay'); ?>
								</a>
								<a class="dropdown-item themeColor" data-val="ES" data-id="27" data-mainval="Spanish" data-lang="Spanish">
									<?php echo $this->lang->line('lang_spanish'); ?>
								</a>
								<a class="dropdown-item themeColor" data-val="AR" data-id="6" data-mainval="Arabic" data-lang="Arabic">
									<?php echo $this->lang->line('lang_arabic'); ?>
								</a>
								<a class="dropdown-item themeColor" data-val="HR" data-id="43" data-mainval="Croatian" data-lang="Croatian">
									<?php echo $this->lang->line('lang_croatian'); ?>
								</a>
								<a class="dropdown-item themeColor" data-val="pt" data-id="89" data-mainval="Portuguese" data-lang="Portuguese">
									<?php echo $this->lang->line('lang_portuguese'); ?>
								</a>
								<a class="dropdown-item themeColor" data-val="ro" data-id="93" data-mainval="Romanian" data-lang="Romanian">
									<?php echo $this->lang->line('lang_romanian'); ?>
								</a>
								<a class="dropdown-item themeColor" data-val="ki" data-id="64" data-mainval="Kiswahili" data-lang="Kiswahili">
									<?php echo $this->lang->line('lang_kiswahili'); ?>
								</a>
								<a class="dropdown-item themeColor" data-val="uk" data-id="126" data-mainval="Ukrainian" data-lang="Ukrainian">
									<?php echo $this->lang->line('lang_ukrainian'); ?>
								</a>
								<a class="dropdown-item themeColor" data-val="sr" data-id="107" data-mainval="Serbian" data-lang="Serbian">
									<?php echo $this->lang->line('lang_serbian'); ?>
								</a>
							</div>
						</li>
						<li>
							<div>
								<a class="help_btn" href="help">
									<?php echo $this->lang->line('help_menu'); ?>
								</a>
							</div>
						</li>
					</ul>
				</div>

				<div class="mobile_nav w-100" id="myGroup">
					<div class="col-md-12 pr-0">
					<div class="row">
						<div class="col-md-6 w-50 pl-0">
							<a class="navbar-brand" href="home"><img src="<?php echo $assetsVal; ?>/images/safecity-mobile-logo.jpg" class="img-fluid logo"></a>
						</div>
						<div class="col-md-3 w-50 p-0 text-right">
							<button class="navbar-toggler mt-2 pl-2" type="button" data-toggle="collapse" data-target="#navbarlanguage" aria-controls="navbarlanguage" aria-expanded="false" aria-label="Toggle navigation">
								<img src="<?php echo $assetsVal; ?>/images/material-translate.svg" width="20" class="img-fluid">
							</button>
							<a class="navbar-brand text-danger font16 mt-1 mr-auto pl-2" href="help">
							<!-- 	<img src="<?php echo $assetsVal; ?>/images/help-icon.svg" class="img-fluid logo"> -->
							Help
							</a>
								<button class="navbar-toggler mt-1 pl-3" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
								<span><img src="<?php echo $assetsVal; ?>/images/m-Right-Icon.svg" class="img-fluid"></span>
							</button>
						</div>

					</div>
					</div>




				<div class="collapse mobile_nav mainMobileNav" id="navbarSupportedContent"  data-parent="#myGroup">
					<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
							<a class="nav-link main_menu" href="home">
								<?php echo $this->lang->line('home_menu'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" href="#">
								<?php echo $this->lang->line('view_data'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" href="hospital_loc">
								<?php echo $this->lang->line('hospital_menu'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" href="policestation_loc">
								<?php echo $this->lang->line('police_staion'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" href="legal_resources">
								<?php echo $this->lang->line('legal_menu'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" href="contact_us">
								<?php echo $this->lang->line('contact_menu'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" href="faqs">
								<?php echo $this->lang->line('faq_menu'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" href="about_safecity">
								<?php echo $this->lang->line('about_safecity_menu'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" href="volunteer_with_us">
								<?php echo $this->lang->line('volunteer_menu'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" href="donate">
								<?php echo $this->lang->line('donate_menu'); ?>
							</a>
						</li>
					</ul>
				</div>

				<div class="collapse mobile_nav mainMobileNav languageSelect" id="navbarlanguage"  data-parent="#myGroup">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link main_menu" data-val="EN" data-id="1" data-lang="English">
								<?php echo $this->lang->line('lang_english'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" data-val="HI" data-id="42" data-lang="Hindi">
								<?php echo $this->lang->line('lang_hindi'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" data-val="MR" data-id="76" data-lang="Marathi">
								<?php echo $this->lang->line('lang_marathi'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" data-val="MS" data-id="77" data-lang="Malay">
								<?php echo $this->lang->line('lang_malay'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" data-val="ES" data-id="27" data-lang="Spanish">
								<?php echo $this->lang->line('lang_spanish'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" data-val="AR" data-id="6" data-lang="Arabic">
								<?php echo $this->lang->line('lang_arabic'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" data-val="HR" data-id="43" data-lang="Croatian">
								<?php echo $this->lang->line('lang_croatian'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" data-val="pt" data-id="89" data-lang="Portuguese">
								<?php echo $this->lang->line('lang_portuguese'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" data-val="ro" data-id="93" data-lang="Romanian">
								<?php echo $this->lang->line('lang_romanian'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" data-val="ki" data-id="64" data-lang="Kiswahili">
								<?php echo $this->lang->line('lang_kiswahili'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" data-val="uk" data-id="126" data-lang="Ukrainian">
								<?php echo $this->lang->line('lang_ukrainian'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link main_menu" data-val="sr" data-id="107" data-lang="Serbian">
								<?php echo $this->lang->line('lang_serbian'); ?>
							</a>
						</li>
					</ul>
				</div>
			</div>

			</div>
		</nav>
	</header>
	<!-- Header End -->