<div class="admin-leftbar">
    <div class="logo">
        <img src="<?php echo base_url() ?>assets/admin/images/safecity.png">
    </div>
    <div class="leftbar-options-holder">
        <a href="<?php echo base_url() ?>admin" class="leftbar-options-content">
            <img src="<?php echo base_url() ?>assets/admin/images/dashboard-svg.svg">
            <span class="leftbar-options-content__title fs-16">Dashboard</span>
        </a>
        <!-- <a href="<?php //echo base_url() ?>admin/forms" class="leftbar-options-content <?php //echo $this->uri->segment(2)=='forms'?'active':''?>">
            <img src="<?php //echo base_url() ?>assets/admin/images/forms-svg.svg">
            <span class="leftbar-options-content__title fs-16">Forms</span>
        </a> -->
		<?php if($this->ion_auth_acl->has_permission('incident_all')) : ?>
        <a href="<?php echo base_url() ?>admin/incident_reports" class="leftbar-options-content <?=$this->uri->segment(2)=='incident_reports'?'active':''?>">
            <img src="<?php echo base_url() ?>assets/admin/images/incident-svg.svg">
            <span class="leftbar-options-content__title fs-16">Download Incident Reports</span>
        </a>
        <?php endif; ?>
        <?php if($this->ion_auth_acl->has_permission('incident_all')) : ?>
        <a href="<?php echo base_url() ?>admin/incidents" class="leftbar-options-content <?=$this->uri->segment(2)=='incidents'?'active':''?>">
            <img src="<?php echo base_url() ?>assets/admin/images/incident-svg.svg">
            <span class="leftbar-options-content__title fs-16">Incidents</span>
        </a>
        <?php endif; ?>
		
		<?php if($this->ion_auth_acl->has_permission('incident_all')) : ?>
        <a href="<?php echo base_url() ?>admin/volunteer_incidents" class="leftbar-options-content <?=$this->uri->segment(2)=='volunteer_incidents'?'active':''?>">
            <img src="<?php echo base_url() ?>assets/admin/images/incident-svg.svg">
            <span class="leftbar-options-content__title fs-16">Volunteer Incidents</span>
        </a>
        <?php endif; ?>
		
        <?php if($this->ion_auth_acl->has_permission('safety_tip_all')) : ?>
        <a href="<?php echo base_url() ?>admin/safety-tips" class="leftbar-options-content <?=$this->uri->segment(2)=='safety-tips'?'active':''?>">
            <img src="<?php echo base_url() ?>assets/admin/images/safetytip.svg">
            <span class="leftbar-options-content__title fs-16">Safety Tips</span>
        </a>
        <?php endif; ?>
        <?php if($this->ion_auth_acl->has_permission('client_all')) : ?>
        <a href="<?php echo base_url() ?>admin/clients" class="leftbar-options-content <?=$this->uri->segment(2)=='clients'?'active':''?>">
            <img src="<?php echo base_url() ?>assets/admin/images/clientss-svg.svg">
            <span class="leftbar-options-content__title fs-16">Clients</span>
        </a>
        <?php endif; ?>
		<?php if($this->ion_auth_acl->has_permission('settings_all')) : ?>
        <a href="<?php echo base_url() ?>admin/helplines" class="leftbar-options-content <?=$this->uri->segment(2)=='helplines'?'active':''?>">
            <img src="<?php echo base_url() ?>assets/admin/images/userprofile-svg.svg">
            <span class="leftbar-options-content__title fs-16">Help Lines</span>
        </a>
        <?php endif; ?>
		<?php if($this->ion_auth_acl->has_permission('pages_all')) : ?>
        <a href="<?php echo base_url() ?>admin/legal_resources" class="leftbar-options-content <?=$this->uri->segment(2)=='legal_resources'?'active':''?>  <?=$this->uri->segment(2)=='add_new_language'?'active':''?>">
            <img src="<?php echo base_url() ?>assets/admin/images/dashboard-svg.svg">
            <span class="leftbar-options-content__title fs-16">Legal Resources</span>
        </a>
        <?php endif; ?>
		<?php if($this->ion_auth_acl->has_permission('pages_all')) : ?>
        <a href="<?php echo base_url() ?>admin/options" class="leftbar-options-content <?=$this->uri->segment(2)=='options'?'active':''?>">
            <img src="<?php echo base_url() ?>assets/admin/images/dashboard-svg.svg">
            <span class="leftbar-options-content__title fs-16">Options</span>
        </a>
        <?php endif; ?>
        <?php if($this->ion_auth_acl->has_permission('pages_all')) : ?>
        <a href="<?php echo base_url() ?>admin/pages" class="leftbar-options-content <?=$this->uri->segment(2)=='pages'?'active':''?>">
            <img src="<?php echo base_url() ?>assets/admin/images/pages-svg.svg">
            <span class="leftbar-options-content__title fs-16">Pages</span>
        </a>
        <?php endif; ?>
        <?php if($this->ion_auth_acl->has_permission('chats_all')) : ?>
        <!-- <a href="<?php echo base_url() ?>admin/chats" class="leftbar-options-content <?=$this->uri->segment(2)=='chats'?'active':''?>">
            <img src="<?php echo base_url() ?>assets/admin/images/chat-svg.svg">
            <span class="leftbar-options-content__title fs-16">Chats</span>
        </a> -->
        <?php endif; ?>
        <?php if($this->ion_auth_acl->has_permission('settings_all')) : ?>
        <a href="<?php echo base_url() ?>admin/user-profiles" class="leftbar-options-content <?=$this->uri->segment(2)=='user-profiles'?'active':''?>">
            <img src="<?php echo base_url() ?>assets/admin/images/userprofile-svg.svg">
            <span class="leftbar-options-content__title fs-16">User Profiles</span>
        </a>
        <?php endif; ?>
        <a href="<?php echo base_url() ?>admin/my-profile" class="leftbar-options-content <?=$this->uri->segment(2)=='my-profile'?'active':''?>">
            <img src="<?php echo base_url() ?>assets/admin/images/profile-svg.svg">
            <span class="leftbar-options-content__title fs-16">My Profile</span>
        </a>
        <!-- <?php if($this->ion_auth_acl->has_permission('settings_all')) : ?>
        <a href="<?php echo base_url() ?>admin/settings/admins" class="leftbar-options-content">
            <img src="<?php echo base_url() ?>assets/admin/images/setting.svg">
            <span class="leftbar-options-content__title fs-16">Settings</span>
        </a>
        <?php endif; ?> -->
    </div>

</div>
<!-- Client sidebar -->
<?php if($_SESSION['is_subclient']): ?>
<div class="admin-table__sidebar bg-white">
    <div class="sidelogo">
        <?php
            $client_logo = $_SESSION['client_data'] && $_SESSION['client_data']->logo?$_SESSION['client_data']->logo:'assets/admin/images/safecity.png';
            $client_logo = base_url().$client_logo;
        ?>
        <img src="<?=$client_logo?>">
    </div>
    <div class="titlenew">
        <?=$_SESSION['client_data']?$_SESSION['client_data']->name:''?>
    </div>
    <div class="admin-table__sidebar--content">
        <a class="" href="<?php echo base_url() ?>admin">Dashboard</a>
        <a class="<?=$this->uri->segment(3)=='incidents'?'active':''?>" href="<?php echo base_url() ?>admin/clients/incidents">Incidents</a>
        <a class="<?=$this->uri->segment(3)=='safety-tips'?'active':''?>" href="<?php echo base_url() ?>admin/clients/safety-tips">Safety Tips</a>
        <a class="<?=$this->uri->segment(3)=='pages'?'active':''?>" href="<?php echo base_url() ?>admin/clients/pages">Pages</a>
        <a class="<?=$this->uri->segment(3)=='chats'?'active':''?>" href="<?php echo base_url() ?>admin/clients/chats">Chats</a>
        <a class="<?=$this->uri->segment(3)=='user-profiles'?'active':''?>" href="<?php echo base_url() ?>admin/clients/user-profiles">User Profiles</a>
    </div>
</div>
<?php endif; ?>
<!-- Client sidebar end -->