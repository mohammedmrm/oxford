
<!-- begin:: Aside Secondary -->

<button class="kt-aside-secondary-close kt-hide " id="kt_aside_secondary_close_btn"><i class="la la-close"></i></button>-->
<div class="kt-aside-secondary" id="kt_aside_secondary">
	<div class="kt-aside-secondary__toggle" id="kt_aside_secondary_toggler"></div>
	<button class="kt-aside-secondary__mobile-nav-toggler" id="kt_aside_secondary_mobile_nav_toggler" data-toggle="kt-tooltip" title="Aside Secondary" data-placement="left"></button>
	<div class="kt-aside-secondary__content">
<!--		<button class="btn btn-sm btn-circle btn-icon kt-aside-secondary__close" id="kt_aside_secondary_close" data-toggle="tooltip" title="Layout Builder" data-placement="اضافة طالب">
			<i class="la la-close"></i>
		</button>-->
	   <!--	<div class="tab-content">
			<div class="tab-pane fade " id="kt_aside_secondary_tab_1" role="tabpanel">
				<div class="kt-aside-secondary__content-head">
					اضافة طالب
				</div>
				<div class="kt-aside-secondary__content-body kt-scroll">
					<form class="kt-form" id="addStudentForm">
						<div class="kt-section kt-section--first">
							<div class="form-group">
                               <label>الرقم التسلسلي:</label>
                               <label id="l_reg_number"></label>
                               <input type="hidden" value="" name="reg_number" id="reg_number" />
                               <input type="hidden" value="" name="serial" id="serial" />
                               <span class="form-text text-danger" id="err_reg_number"></span>
							</div>
							<div class="form-group">
								<label>الاسم:</label>
								<input type="email" name="name" class="form-control" placeholder="الاسم الكامل">
								<span class="form-text text-danger" id="err_name"></span>
							</div>
							<div class="form-group">
								<label>رقم الهاتف:</label>
								<input type="phone" name="phone" class="form-control" placeholder="رقم الهاتف">
								<span class="form-text text-danger" id="err_phone"></span>
							</div>
							<div class="form-group">
								<label>تاريخ الميلاد:</label>
								<input class="form-control" type="date" value="" name="birthday">
								<span class="form-text text-danger" id="err_birthday"></span>
							</div>
							<div class="form-group">
								<label>الجنس:</label>
                                <div class="kt-radio-list">
      							<label class="kt-radio kt-radio--bold kt-radio--brand">
      								<input type="radio" value="1" name="gender"> ذكر
                                    <span></span>
      							</label>
                                <label class="kt-radio kt-radio--bold kt-radio--brand">
      								<input type="radio" value="0" name="gender"> انثى
                                    <span></span>
      							</label>
                                <span class="form-text text-danger"  id="err_gender"></span>
      						    </div>
							</div>
							<div class="form-group">
								<label>صورة شخصية:</label>
								<input class="form-control" type="file" name="img">
								<span class="form-text text-danger" id="err_img"></span>
							</div>
                            <div class="form-group">
								<label>جواز السفر:</label>
								<input class="form-control" type="file"  name="passport">
								<span class="form-text text-danger" id="err_passport"></span>
							</div>
							<div class="form-group">
								<label>المستمسكات:</label>
								<input class="form-control" type="file"  name="id1">
								<span class="form-text text-danger"  id="err_id1"></span>
							</div>
							<div class="form-group">
								<label>نوع الدفع:</label>
                                <select class="form-control" name="payment_type">
        							<option>-- اختر نوع الدفع --</option>
        							<option value="1">نقدي</option>
        							<option value="2">اقساط</option>
        						</select>
                                <span class="form-text text-danger" id="err_payment_type"></span>
							</div>
						</div>
						<div class="kt-form__actions">
							<button type="button" onclick="addStudent()" class="btn btn-primary">اضافة</button>
							<button type="reset" class="btn btn-secondary">الغأ</button>
						</div>
					</form>
				</div>
			</div>
			<div class="tab-pane fade" id="kt_aside_secondary_tab_2" role="tabpanel">
				<div class="kt-aside-secondary__content-head">
					New Report
				</div>
				<div class="kt-aside-secondary__content-body kt-scroll">
					<form class="kt-form">
						<div class="kt-section kt-section--first">
							<div class="form-group">
								<label>Name:</label>
								<input type="email" class="form-control" placeholder="Enter full name">
								<span class="form-text text-danger">Please enter report name</span>
							</div>
							<div class="form-group">
								<label for="exampleSelect">Category:</label>
								<select class="form-control" id="exampleSelect">
									<option>Finance</option>
									<option>Sales</option>
									<option>System</option>
									<option>Customers</option>
									<option>Orders</option>
								</select>
								<span class="form-text text-danger">Please select report category</span>
							</div>
							<div class="form-group">
								<label>Revenue:</label>
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">#</span></div>
									<input type="text" class="form-control" placeholder="Units" aria-describedby="basic-addon1">
									<div class="input-group-append"><span class="input-group-text">$</span></div>
								</div>
								<span class="form-text text-danger">Please enter treshhold name</span>
							</div>
							<div class="form-group">
								<label>Filter:</label>
								<div class="kt-checkbox-list">
									<label class="kt-checkbox">
										<input type="checkbox"> Pending transations
										<span></span>
									</label>
									<label class="kt-checkbox">
										<input type="checkbox"> Include margins
										<span></span>
									</label>
									<label class="kt-checkbox">
										<input type="checkbox"> Include balance
										<span></span>
									</label>
								</div>
							</div>
						</div>
						<div class="kt-form__actions">
							<button type="reset" class="btn btn-primary">Submit</button>
							<button type="reset" class="btn btn-secondary">Cancel</button>
						</div>
					</form>
				</div>
			</div>
			<div class="tab-pane fade" id="kt_aside_secondary_tab_3" role="tabpanel">
				<div class="kt-aside-secondary__content-head">
					Notifications
				</div>
				<div class="kt-aside-secondary__content-body kt-aside-secondary__content-body--fit-x kt-scroll">
					<div class="kt-notification">
						<a href="#" class="kt-notification__item">
							<div class="kt-notification__item-icon">
								<i class="flaticon-time-2"></i>
							</div>
							<div class="kt-notification__item-details">
								<div class="kt-notification__item-title">
									New order has been received
								</div>
								<div class="kt-notification__item-time">
									2 hrs ago
								</div>
							</div>
						</a>
						<a href="#" class="kt-notification__item">
							<div class="kt-notification__item-icon">
								<i class="flaticon-upload-1"></i>
							</div>
							<div class="kt-notification__item-details">
								<div class="kt-notification__item-title">
									New customer is registered
								</div>
								<div class="kt-notification__item-time">
									3 hrs ago
								</div>
							</div>
						</a>
						<a href="#" class="kt-notification__item">
							<div class="kt-notification__item-icon">
								<i class="flaticon-interface-8"></i>
							</div>
							<div class="kt-notification__item-details">
								<div class="kt-notification__item-title">
									Application has been approved
								</div>
								<div class="kt-notification__item-time">
									3 hrs ago
								</div>
							</div>
						</a>
						<a href="#" class="kt-notification__item">
							<div class="kt-notification__item-icon">
								<i class="flaticon-file"></i>
							</div>
							<div class="kt-notification__item-details">
								<div class="kt-notification__item-title">
									New file has been uploaded
								</div>
								<div class="kt-notification__item-time">
									5 hrs ago
								</div>
							</div>
						</a>
						<a href="#" class="kt-notification__item">
							<div class="kt-notification__item-icon">
								<i class="flaticon-user"></i>
							</div>
							<div class="kt-notification__item-details">
								<div class="kt-notification__item-title">
									New user feedback received
								</div>
								<div class="kt-notification__item-time">
									8 hrs ago
								</div>
							</div>
						</a>
						<a href="#" class="kt-notification__item">
							<div class="kt-notification__item-icon">
								<i class="flaticon-cogwheel"></i>
							</div>
							<div class="kt-notification__item-details">
								<div class="kt-notification__item-title">
									System reboot has been successfully completed
								</div>
								<div class="kt-notification__item-time">
									12 hrs ago
								</div>
							</div>
						</a>
						<a href="#" class="kt-notification__item">
							<div class="kt-notification__item-icon">
								<i class="flaticon-light"></i>
							</div>
							<div class="kt-notification__item-details">
								<div class="kt-notification__item-title">
									New order has been placed
								</div>
								<div class="kt-notification__item-time">
									15 hrs ago
								</div>
							</div>
						</a>
						<a href="#" class="kt-notification__item kt-notification__item--read">
							<div class="kt-notification__item-icon">
								<i class="flaticon-interface-2"></i>
							</div>
							<div class="kt-notification__item-details">
								<div class="kt-notification__item-title">
									Company meeting canceled
								</div>
								<div class="kt-notification__item-time">
									19 hrs ago
								</div>
							</div>
						</a>
						<a href="#" class="kt-notification__item">
							<div class="kt-notification__item-icon">
								<i class="flaticon-diagram"></i>
							</div>
							<div class="kt-notification__item-details">
								<div class="kt-notification__item-title">
									New report has been received
								</div>
								<div class="kt-notification__item-time">
									23 hrs ago
								</div>
							</div>
						</a>
						<a href="#" class="kt-notification__item">
							<div class="kt-notification__item-icon">
								<i class="flaticon-pie-chart"></i>
							</div>
							<div class="kt-notification__item-details">
								<div class="kt-notification__item-title">
									Finance report has been generated
								</div>
								<div class="kt-notification__item-time">
									25 hrs ago
								</div>
							</div>
						</a>
						<a href="#" class="kt-notification__item">
							<div class="kt-notification__item-icon">
								<i class="flaticon-speech-bubble-1"></i>
							</div>
							<div class="kt-notification__item-details">
								<div class="kt-notification__item-title">
									New customer comment recieved
								</div>
								<div class="kt-notification__item-time">
									2 days ago
								</div>
							</div>
						</a>
						<a href="#" class="kt-notification__item">
							<div class="kt-notification__item-icon">
								<i class="flaticon-warning"></i>
							</div>
							<div class="kt-notification__item-details">
								<div class="kt-notification__item-title">
									New customer is registered
								</div>
								<div class="kt-notification__item-time">
									3 days ago
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	-->
    </div>
	<div class="kt-aside-secondary__nav kt-grid kt-grid--hor">
<!--		<div class="kt-grid__item kt-grid__item--fluid kt-aside-secondary__nav-body">
			<ul class="kt-aside-secondary__nav-toolbar nav nav-tabs" role="tablist" id="kt_aside_secondary_nav">
				<li class="kt-aside-secondary__nav-toolbar-item nav-item " data-toggle="kt-tooltip" title="اضافة طالب" data-placement="left">
					<a class="kt-aside-secondary__nav-toolbar-icon nav-link " data-toggle="tab" href="#kt_aside_secondary_tab_1" role="tab">
						<i class="flaticon2-add kt-font-brand"></i>
						<span class="kt-badge kt-badge--dot kt-badge--md kt-badge--danger"></span>
					</a>
				</li>
				<li class="kt-aside-secondary__nav-toolbar-item nav-item" data-toggle="kt-tooltip" title="Reports" data-placement="left">
					<a class="kt-aside-secondary__nav-toolbar-icon nav-link" data-toggle="tab" href="#kt_aside_secondary_tab_2" role="tab">
						<i class="flaticon2-chart kt-font-danger"></i>
					</a>
				</li>
				<li class="kt-aside-secondary__nav-toolbar-item nav-item" data-toggle="kt-tooltip" title="Notifications" data-placement="left">
					<a class="kt-aside-secondary__nav-toolbar-icon nav-link" data-toggle="tab" href="#kt_aside_secondary_tab_3" role="tab">
						<i class="flaticon-rotate kt-font-success"></i>
					</a>
				</li>
			</ul>
		</div>-->
		<div class="kt-grid__item kt-aside-secondary__nav-foot">
<!--			<ul class="kt-aside-secondary__nav-toolbar">
				<li class="kt-aside-secondary__nav-toolbar-item" data-toggle="kt-tooltip" title="Quick menu" data-placement="left">
					<a class="kt-aside-secondary__nav-toolbar-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-exclamation-circle kt-font-warning"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-left">
						<ul class="kt-nav">
							<li class="kt-nav__section kt-nav__section--first">
								<span class="kt-nav__section-text">Quick Links</span>
							</li>
							<li class="kt-nav__item">
								<a href="https://themes.getbootstrap.com/product/keen-the-ultimate-bootstrap-admin-theme/" class="kt-nav__link">
									<i class="kt-nav__link-icon fa fa-donate"></i>
									<span class="kt-nav__link-text">Purchase Keen</span>
								</a>
							</li>
							<li class="kt-nav__item">
								<a href="https://keenthemes.com/keen/?page=docs" class="kt-nav__link">
									<i class="kt-nav__link-icon fa fa-book"></i>
									<span class="kt-nav__link-text">Documentation</span>
								</a>
							</li>
							<li class="kt-nav__item">
								<a href="https://keenthemes.com/keen/preview/demo1/builder.php" target="_blank" class="kt-nav__link">
									<i class="kt-nav__link-icon fa fa-charging-station"></i>
									<span class="kt-nav__link-text">Layout Builder</span>
								</a>
							</li>
							<li class="kt-nav__item">
								<a href="https://keenthemes.com/support" class="kt-nav__link" id="export_excel">
									<i class="kt-nav__link-icon fa fa-headset"></i>
									<span class="kt-nav__link-text">Theme Support</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
			</ul>-->
		</div>
	</div>
</div>
<!-- end:: Aside Secondary -->

<script>

function addStudent(){
    var myform = document.getElementById('addStudentForm');
    var fd = new FormData(myform);
  $.ajax({
    url:"script/_addStudent.php",
    type:"POST",
    data:fd,
    processData: false,  // tell jQuery not to process the data
    contentType: false,
   	cache: false,
    beforeSend:function(){
     $("#err_name").text("");
     $("#err_phone").text("");
     $("#err_birthday").text("");
     $("#err_gender").text("");
     $("#err_img").text("");
     $("#err_passport").text("");
     $("#err_id1").text("");
     $("#addStudentForm").addClass("loading");
    },
    success:function(res){
        $("#addStudentForm").removeClass("loading");
        console.log(res);
       if(res.success == 1){
         $("#name").val("");
         $("#phone").val("");
         $("#birthday").val("");
         Toast.success('تم الاضافة');
         getStudentNumber();
       }else{
         $("#err_name").text(res.error.name);
         $("#err_phone").text(res.error.phone);
         $("#err_birthday").text(res.error.birthday);
         $("#err_gender").text(res.error.gender);
         $("#err_payment_type").text(res.error.payment_type);
         $("#err_reg_number").text(res.error.reg_number);
         $("#err_img").text(res.error.img);
         $("#err_passport").text(res.error.passport);
         $("#err_id1").text(res.error.id1);
           Toast.warning("هناك بعض المدخلات غير صالحة",'خطأ');
       }

    },
    error:function(e){
       $("#addStudentForm").removeClass("loading");
       console.log(e);
       Toast.error('خطأ');
    }
  });
}
function getStudentNumber(){
  $.ajax({
    url:"script/_studentNumberBuilder.php",
    type:"POST",
    beforeSend:function(){

    },
    success:function(res){
       $("#l_reg_number").text(res.reg_number);
       $("#reg_number").val(res.reg_number);
       $("#serial").val(res.serial);
      console.log(res);
    },
    error:function(e){
     console.log(e);

    }
  });

}
//getStudentNumber();
</script>
