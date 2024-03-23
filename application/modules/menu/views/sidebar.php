<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$current_url = current_url();
?>


<!-- navigation start -->
	<?php
		if(isset($_COOKIE['menu_police']) && !empty($_COOKIE['menu_police']) && $_COOKIE['menu_police'] == 'yes'){
	?>
			<div class="breadcums">
				<a href="policestation_loc"><?php echo $this->lang->line('police_menu'); ?></a> 
				<span> > </span> 
				<a href="legal_resources"><?php echo $this->lang->line('legal_menu'); ?></a>
			</div>
	<?php } ?>

	<div class="navList">
		<ul class="nav flex-column">
			<li class="nav-item">
				<a class="nav-link <?php echo ($current_url == base_url()."legal_resources" ? 'active' : '')?>" href="legal_resources">
					<?php echo $this->lang->line('legal_submenu_ipc'); ?>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link fir_menu <?php echo ($current_url == base_url()."filling_fir" ? 'active' : '')?>" href="filling_fir">
					<?php echo $this->lang->line('legal_submenu_fir'); ?>
				</a>
			</li>
		</ul>
	</div>
<!-- navigation end -->