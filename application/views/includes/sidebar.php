<?php $current_url = current_url(); ?>

<div class="navList">
	<ul class="nav flex-column">
		<li class="nav-item">
			<a class="nav-link <?php echo ($current_url == base_url()."legal_resources" ? "active" : ''); ?>" href="legal_resources">
				<?php echo $this->lang->line('legal_menu'); ?>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php echo ($current_url == base_url()."contact_us" ? "active" : ''); ?>" href="contact_us">
				<?php echo $this->lang->line('contact_menu'); ?>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php echo ($current_url == base_url()."about_safecity" ? "active" : ''); ?>" href="about_safecity">
				<?php echo $this->lang->line('about_safecity_menu'); ?>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php echo ($current_url == base_url()."faqs" ? "active" : ''); ?>" href="faqs">
				<?php echo $this->lang->line('faq_menu'); ?>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php echo ($current_url == base_url()."volunteer_with_us" ? "active" : ''); ?>" href="volunteer_with_us">
				<?php echo $this->lang->line('volunteer_menu'); ?>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php echo ($current_url == base_url()."donate" ? "active" : ''); ?>" href="donate">
				<?php echo $this->lang->line('donate_menu'); ?>
			</a>
		</li>

	</ul>
</div>   