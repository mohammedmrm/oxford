<?php
if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page ="";
}

?>
<?php include_once("partials/_header/base-mobile.php"); ?>

<!-- begin:: Root -->
<div class="kt-grid kt-grid--hor kt-grid--root">

	<!-- begin:: Page -->
	<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

		<?php include_once("partials/_aside/base.php"); ?>
        
		<!-- begin:: Wrapper -->
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            <?php include_once("partials/_header/base.php"); ?>
			<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                <?php
                  if(file_exists($page)){
                    include_once ($page);
                   }else{
                    include_once ("pages/dashboard.php" );
                  }
                ?>
            </div>

        	<?php include_once("partials/_footer/base.php"); ?>
		</div>

		<!-- end:: Wrapper -->

		<?php include_once("partials/_aside-secondary/base.php"); ?>
	</div>

	<!-- end:: Page -->
</div>

<!-- end:: Root -->

<!-- begin:: Topbar Offcanvas Panels -->


<?php include_once("partials/_topbar/offcanvas/user.php"); ?>

<!-- end:: Topbar Offcanvas Panels -->

<?php include_once("partials/_scrolltop.php"); ?>
