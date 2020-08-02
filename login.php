<!DOCTYPE html>
<!-- 
Theme: Keen - The Ultimate Bootstrap Admin Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: You must have a valid license purchased only from https://themes.getbootstrap.com/product/keen-the-ultimate-bootstrap-admin-theme/ in order to legally use the theme for your project.
-->
<html lang="en" >
    <!-- begin::Head -->
    <head><!--begin::Base Path (base relative path for assets of this page) -->
<base href="..."><!--end::Base Path -->
        <meta charset="utf-8"/>
        
        <title>تسجيل الدخول</title>
        <meta name="description" content="User login example"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!--begin::Fonts -->
<style>
        /* arabic */
        @font-face {
          font-family: 'Cairo';
          font-style: normal;
          font-weight: 400;
          font-display: swap;
          src: local('Cairo'), local('Cairo-Regular'), url(Cairofont.woff2) format('woff2');
          unicode-range: U+0600-06FF, U+200C-200E, U+2010-2011, U+204F, U+2E41, U+FB50-FDFF, U+FE80-FEFC;
        }
        /* latin-ext */
        @font-face {
          font-family: 'Cairo';
          font-style: normal;
          font-weight: 400;
          font-display: swap;
          src: local('Cairo'), local('Cairo-Regular'), url(Cairofont.woff2) format('woff2');
          unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        body * :not(.fa):not(.la):not(.kt-widget-20__label):not(.kt-widget-19__label):not(.kt-aside-secondary__mobile-nav-toggler) {
          font-family: 'Cairo', sans-serif !important;
        }

        body {

        }

        body,body *{
         }
        input[type=email],.form_datetime {
          direction: ltr !important;
        }
.kt-login-v1 .kt-login-v1__body {
  padding: 0px !important;
}


        </style>
        <!--end::Fonts -->

        
                    
            <!--begin::Page Custom Styles(used by this page) --> 
                             <link href="assets/css/demo1/pages/login/login-v1.css" rel="stylesheet" type="text/css" />
                        <!--end::Page Custom Styles -->
        
        <!--begin::Global Theme Styles(used by all pages) -->
                    <link href="assets/vendors/global/vendors.bundle.css" rel="stylesheet" type="text/css" />
                    <link href="assets/css/demo1/style.bundle.css" rel="stylesheet" type="text/css" />
                <!--end::Global Theme Styles -->

	    <!--begin::Layout Skins(used by all pages) -->
        
<link href="assets/css/demo1/skins/header/base/light.css" rel="stylesheet" type="text/css" />
<link href="assets/css/demo1/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
<link href="assets/css/demo1/skins/brand/navy.css" rel="stylesheet" type="text/css" />
<link href="assets/css/demo1/skins/aside/navy.css" rel="stylesheet" type="text/css" />	    <!--end::Layout Skins -->

        <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    </head>
    <!-- end::Head -->

    <!-- begin::Body -->
    <body  style="background-image:url(assets/media/misc/bg_1.jpg)"  class="kt-login-v1--enabled kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading"  >

       
    	
	<!-- begin:: Page -->
	<div class="kt-grid kt-grid--ver kt-grid--root">
		<div class="kt-grid__item  kt-grid__item--fluid kt-grid kt-grid--hor kt-login-v1" id="kt_login_v1">
	<!--begin::Item-->
	<div class="kt-grid__item">
		<!--begin::Heade-->
		<div class="kt-login-v1__head">
			<div class="kt-login-v1__logo">
				<a href="#">
					<img src="img/logos/logoW.jpg" width="100" alt=""/>
				</a>
			</div>	
			<div class="kt-login-v1__signup">
				<h4 class="kt-login-v1__heading"></h4>
				<a href="#"></a>
			</div>
		</div>
		<!--begin::Head-->
	</div>
	<!--end::Item-->

	<!--begin::Item-->
	<div class="kt-grid__item  kt-grid kt-grid--ver  kt-grid__item--fluid">
		<!--begin::Body-->
		<div class="kt-login-v1__body">
			<!--begin::Section-->
			<div class="kt-login-v1__section">
				<div class="kt-login-v1__info text-center">
					<h3 class="kt-login-v1__intro">اياًكان مستواك معنا ستتعلم</h3>
					<p>معهد اكسفورد لتعليم اللغة الانكليزية</p>
				</div>
			</div>	
			<!--begin::Section-->

			<!--begin::Separator-->
			<div class="kt-login-v1__seaprator"></div>
			<!--end::Separator-->

		 	<!--begin::Wrapper-->
			<div class="kt-login-v1__wrapper">
				<div class="kt-login-v1__container">
					<h3 class="kt-login-v1__title">
						معهد اكسفورد
					</h3>
					<h3 class="kt-login-v1__title">
						Oxford Languages Center
					</h3>
					<!--begin::Form-->
					<form class="kt-login-v1__form kt-form" action="" autocomplete="off">
						<div class="form-group">
                         <h4 class="text-danger" id="msg"></h4>
                        </div>
						<div class="form-group">
							<input class="form-control" type="text" placeholder="Username" id="username" autocomplete="off">
						</div>
						<div class="form-group">
							<input class="form-control" type="password" placeholder="Password" id="password" autocomplete="off">
						</div>

						<div class="kt-login-v1__actions">
							<a href="#" class="kt-login-v1__forgot">

							</a>
							<button type="button" onclick="login()" class="btn btn-pill btn-elevate">تسجيل الدخول</button>
						</div>
					</form>
					<!--end::Form-->

				</div>
			</div>
			<!--end::Wrapper-->
		</div>
		<!--begin::Body-->
	</div>
	<!--end::Item-->

	<!--begin::Item-->
	<div class="kt-grid__item">
		<div class="kt-login-v1__footer">
			<div class="kt-login-v1__menu">
				<a href="#">Privacy</a>
				<a href="#">Legal</a>
				<a href="#">Contact</a>
			</div>

			<div class="kt-login-v1__copyright">
				<a href="https://www.facebook.com/smartProg/">&copy; 2019 Developed and Desgined by Mohammed Ridha</a>
			</div>						
		</div>
	</div>
	<!--end::Item-->
</div>	</div>
	<!-- end:: Page -->
	


        <!-- begin::Global Config(global config for global JS sciprts) -->
        <script>
            var KTAppOptions = {
    "colors": {
        "state": {
            "brand": "#5d78ff",
            "metal": "#c4c5d6",
            "light": "#ffffff",
            "accent": "#00c5dc",
            "primary": "#5867dd",
            "success": "#34bfa3",
            "info": "#36a3f7",
            "warning": "#ffb822",
            "danger": "#fd3995",
            "focus": "#9816f4"
        },
        "base": {
            "label": [
                "#c5cbe3",
                "#a1a8c3",
                "#3d4465",
                "#3e4466"
            ],
            "shape": [
                "#f0f3ff",
                "#d9dffa",
                "#afb4d4",
                "#646c9a"
            ]
        }
    }
};
        </script>
        <!-- end::Global Config -->

    	<!--begin::Global Theme Bundle(used by all pages) -->
    	<script src="assets/vendors/global/vendors.bundle.js" type="text/javascript"></script>
		<script src="assets/js/demo1/scripts.bundle.js" type="text/javascript"></script>
				<!--end::Global Theme Bundle -->

         

                    
            <!--begin::Page Scripts(used by this page) -->
            <script src="assets/js/demo1/pages/custom/user/login.js" type="text/javascript"></script>
            <!--end::Page Scripts -->
<script type="text/javascript">

function login(){
    $.ajax({
    url:"script/_login.php",
    type:"POST",
    data:{username:$("#username").val(), password:$("#password").val()},
    beforeSend:function(){

    },
    success:function(res){
      console.log(res);
      if(res.msg == 1){
         window.location.href = "index.php";
      }else{
        $("#msg").text(res.msg);
      }
    },
    error:function(e){
      console.log(e.responseText);
    }
  });
}
$(document).keydown(function(e) {
  if (event.which === 13 || event.keyCode === 13 ) {
      event.stopPropagation();
      event.preventDefault();
      login();
  }
});
</script>
            </body>
    <!-- end::Body -->
</html>