
<!-- begin::Offcanvas Toolbar Profile -->
<div id="kt_offcanvas_toolbar_profile1" class="kt-offcanvas-panel">
	<div class="kt-offcanvas-panel__head">
		<h3 class="kt-offcanvas-panel__title">
			الملف الشخصي
		</h3>
        <h3 class="kt-offcanvas-panel__title">
			<a href="logout.php" calss="btn btn-link">تسجيل الخروج</a>
		</h3>
		<a href="#" class="kt-offcanvas-panel__close" id="kt_offcanvas_toolbar_profile_close1"><i class="flaticon2-delete"></i></a>
	</div>
	<div class="kt-offcanvas-panel__body">
		<div class="kt-user-card-v3 kt-margin-b-30">
			<div class="kt-user-card-v3__avatar">
				<img src="
                 <?php
                    if($_SESSION['user_details']['img'] == "_"){
                      echo "img/staff/default.png";
                    }else{
                      echo "img/staff/".$_SESSION['user_details']['img'];
                    }
                  ?>
            " alt="" />
			</div>
			<div class="kt-user-card-v3__detalis">
				<a href="#" class="kt-user-card-v3__name">
					<?php echo $_SESSION['user_details']['name'];?>
				</a>
				<div class="kt-user-card-v3__desc">
			<?php
              require_once("script/dbconnection.php");
              $sql = "select * from role where id=?";
              $res = getData($con,$sql,[$_SESSION['user_details']['role_id']]);
              if(count($res) == 1){
                echo $res[0]['name'];
              }
            ?>
				</div>
				<div class="kt-user-card-v3__info">
					<a href="#" class="kt-user-card-v3__item">
						<i class="flaticon-email-black-circular-button kt-font-brand"></i>
						<span class="kt-user-card-v3__tag"><?php echo $_SESSION['user_details']['email'];?></span>
					</a>
					<a href="#" class="kt-user-card-v3__item">
						<i class="flaticon-twitter-logo-button kt-font-success"></i>
						<span class="kt-user-card-v3__tag"><?php echo $_SESSION['user_details']['phone'];?></span>
					</a>
				</div>
			</div>
		</div>
		<div class="kt-offcanvas-panel__section kt-margin-t-50">
         <?php echo $res[0]['name']; ?>
		</div>
		<div class="kt-widget-1">
			<div class="kt-widget-1__items">
				<div class="kt-widget-1__item">
					<div class="kt-widget-1__item-info">
						<a href="#">
							<div class="kt-widget-1__item-title">تاريخ المباشرة</div>
						</a>
						<div class="kt-widget-1__item-desc"><?php echo $_SESSION['user_details']['date'];?></div>
					</div>
					<div class="kt-widget-1__item-stats">
						<div class="kt-widget-1__item-value">+79%</div>
						<div class="kt-widget-1__item-progress">
							<div class="progress">
								<div class="progress-bar bg-danger" role="progressbar" style="width: 79%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="kt-widget-1__item">
					<div class="kt-widget-1__item-info">
						<a href="#">
							<div class="kt-widget-1__item-title">عنوان السكن</div>
						</a>
						<div class="kt-widget-1__item-desc"><?php echo $_SESSION['user_details']['address'];?></div>
					</div>
					<div class="kt-widget-1__item-stats">
						<div class="kt-widget-1__item-value">+21%</div>
						<div class="kt-widget-1__item-progress">
							<div class="progress">
								<div class="progress-bar bg-brand" role="progressbar" style="width: 60%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="kt-widget-1__item">
					<div class="kt-widget-1__item-info">
						<a href="#">
							<div class="kt-widget-1__item-title">تاريخ انتهاء العقد</div>
						</a>
						<div class="kt-widget-1__item-desc"><?php echo $_SESSION['user_details']['end_date'];?></div>
					</div>
					<div class="kt-widget-1__item-stats">
						<div class="kt-widget-1__item-value">-16%</div>
						<div class="kt-widget-1__item-progress">
							<div class="progress">
								<div class="progress-bar  bg-success" role="progressbar" style="width: 80%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="kt-offcanvas-panel__section kt-margin-t-50">
			معلومات اخرى
		</div>
		<div class="kt-widget-4">
			<div class="kt-widget-4__items">
				<div class="kt-widget-4__item">
					<div class="kt-widget-4__item-content">
						<div class="kt-widget-4__item-section">
							<div class="kt-widget-4__item-pic">
								<img class="" src="assets/media/product-logos/logo1.png" alt="">
							</div>
							<div class="kt-widget-4__item-info">
								<a href="#">
									<div class="kt-widget-4__item-username">مقدار الراتب</div>
								</a>
								<div class="kt-widget-4__item-desc"></div>
							</div>
						</div>
					</div>
					<div class="kt-widget-4__item-content">
						<div class="kt-widget-4__item-price">
							<span class="kt-widget-4__item-badge">$</span>
							<span class="kt-widget-4__item-number"><?php echo $_SESSION['user_details']['salary'];?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="kt-margin-t-40">
			<a href="?page=pages/profile.php"><button type="button" class="btn btn-brand btn-font-sm btn-upper btn-bold">full profile</button></a>
		</div>
	</div>
</div>
<script>
var headerMenuOffcanvas = new KTOffcanvas('kt_offcanvas_toolbar_profile1', {
    overlay: true,
    baseClass: 'kt-offcanvas-panel',
    closeBy: 'kt_offcanvas_toolbar_profile_close1',
    toggleBy: {
        target: 'kt_offcanvas_toolbar_profile_toggler_btn1',
        state: 'kt-offcanvas-panel--on'
    }
});
</script>
<!-- end::Offcanvas Toolbar Profile -->