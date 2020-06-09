
<!--begin: User Bar -->
<div class="kt-header__topbar-item kt-header__topbar-item--user">
	<div class="kt-header__topbar-wrapper" id="kt_offcanvas_toolbar_profile_toggler_btn1">

		<!--use "kt-rounded" class for rounded avatar style-->
		<div class="kt-header__topbar-user kt-rounded-">
			<span class="kt-header__topbar-welcome kt-hidden-mobile">مرحبا,</span>
			<span class="kt-header__topbar-username  kt-hidden-mobile"><?php echo $_SESSION['user_details']['name'];?></span>
			<img alt="Pic" src="
            <?php
              if($_SESSION['user_details']['img'] == "_"){
                echo "img/staff/default.png";
              }else{
                echo "img/staff/".$_SESSION['user_details']['img'];
              }
            ?>
            " class="kt-rounded-" />

			<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
			<span class="kt-badge kt-badge--username kt-badge--lg kt-hidden  kt-badge--brand  kt-badge--bold"><?php echo $_SESSION['user_details']['name'];?></span>
		</div>
	</div>
</div>

<!--end: User Bar -->