<?php
if(!isset($_SESSION)){
session_start();
}
if($_SESSION['login']  != 1){
  header("location: login.php");
}
?>
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
<html lang="en">

	<!-- begin::Head -->
	<head>
		<base href="">
		<meta charset="utf-8" />
		<title>Oxford</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<!--begin::Fonts -->
	   <!--end::Fonts -->

		<!--begin::Page Vendors Styles(used by this page) -->
		        <!--begin::Page Vendors Styles(used by this page) -->
        <link href="./assets/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css" rel="stylesheet" type="text/css" />
        <!--end::Page Vendors Styles -->
        <!--begin::Global Theme Styles(used by all pages) -->
        <link href="./assets/vendors/global/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />
        <link href="./assets/css/demo1/style.bundle.rtl.css" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles -->
        <!--begin::Layout Skins(used by all pages) -->
        <link href="./assets/css/demo1/skins/header/base/light.rtl.css" rel="stylesheet" type="text/css" />
        <link href="./assets/css/demo1/skins/header/menu/light.rtl.css" rel="stylesheet" type="text/css" />
        <link href="./assets/css/demo1/skins/brand/navy.rtl.css" rel="stylesheet" type="text/css" />
        <link href="./assets/css/demo1/skins/aside/navy.rtl.css" rel="stylesheet" type="text/css" />
        <link href="bootstrap-4.3.1-dist1/css/toast.css" rel="stylesheet" type="text/css" />
        <!--end::Layout Skins -->
        <link href="" rel="stylesheet">
        <link rel="shortcut icon" href="./assets/media/logos/favicon.ico" />
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

        body * :not(.fa):not(.la):not(.kt-widget-20__label):not(.kt-widget-19__label):not(.kt-aside-secondary__mobile-nav-toggler):not(.close) {
          font-family: 'Cairo', sans-serif !important;
        }

        body {

        }

        body,body *{
            direction: rtl !important;
            text-align: right !important;
        }
        input[type=email],.form_datetime {
          direction: ltr !important;
        }
        th {
          font-size: 16px;
          font-weight: 500;
          background-color: #FFFFCC;
        }
        td {
          text-align: center !important;
          font-size: 14px;
          color: #000000;
          font-weight: 500;
          text-shadow: 0px 0px 0px #000000;
          text-outline: 2px #FF3300;
        }
        .dropdown-menu {
          z-index: 100 !important;
        }

        ::placeholder ,:-ms-input-placeholder,::-webkit-input-placeholder {
          color: #FFFFFF !important;
          font-weight: normal !important;
        }
        fieldset {
        		border: 1px solid #ddd !important;
        		margin: 0;
        		xmin-width: 0;
        		padding: 10px;
        		position: relative;
        		border-radius:4px;
        		background-color: #F3F3F3;
        		padding-left:10px !important;
        		width:100%;
        }
        legend
        {
        	font-size:14px;
        	font-weight:bold;
        	margin-bottom: 0px;
        	width:auto;
        	border: 1px solid #ddd;
        	border-radius: 4px;
        	padding: 5px 5px 5px 10px;
            color:#FFFFFF;
        	background-color: #CC0000;
        }
        .btn.btn-link:focus, .btn.btn-link:hover {
          background-color: transparent !important;
          color:#0000FF !important;
          text-decoration: underline;
        }
         .user-img {
           width: 50px;
           height: 50px;
           border-radius: 10px;
         }
         .user-img-sm {
           width: 20px;
           height: 20px;
           border-radius: 10px;
         }
         .user-img-lg {
           width: 80px;
           height: 80px;
           border-radius: 10px;
         }
         label {
           color: #555555;
           font-weight: bold;
         }
         .nowrap{
            white-space: nowrap;
         }

        </style>
</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-aside-secondary--enabled kt-page--loading">
        <script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"metal": "#666666",
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
							"#666666",
							"#666666",
							"#666666",
							"#666666"
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
       <?php include_once("partials/_page-loader.php"); ?>
        <!--begin::Global Theme Bundle(used by all pages) -->
        <script src="assets/vendors/global/vendors.bundle.min.js" type="text/javascript"></script>
        <script src="assets/js/demo1/scripts.bundle.js" type="text/javascript"></script>
        <?php include_once("layout.php"); ?>
        <!--end::Global Theme Bundle -->
        <!--begin::Page Vendors(used by this page) -->
        <script src="assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
        <!--end::Page Vendors -->
        <!--begin::Page Scripts(used by this page) -->
        <script src="assets/js/demo1/pages/dashboard.js" type="text/javascript"></script>
        <script src="js/toast.js" type="text/javascript"></script>
		<!-- begin::Global Config(global config for global JS sciprts) -->

        <!-- end::Global Config -->
        <script>
            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
              });
        </script>
	</body>

	<!-- end::Body -->
</html>