<style type="text/css">
.docs {
  height:150px;
  display: block;
  float: right;
  padding: 10px;
}
.tit {
  display: inline-block;
  padding: 5px;
  font-size: 16px;
  width: 120px;
}
.val{
  display: inline-block;
  padding: 5px;
  font-size: 16px;
}

</style>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<!--Begin::App-->
<div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
    <!--Begin:: App Aside Mobile Toggle-->
    <button class="kt-app__aside-close" id="kt_profile_aside_close">
        <i class="la la-close"></i>
    </button>
    <!--End:: App Aside Mobile Toggle-->

    <!--Begin:: App Aside-->
    <div class="kt-grid__item kt-app__toggle kt-app__aside kt-app__aside--sm kt-app__aside--fit" id="kt_profile_aside" style="opacity: 1;">
        <!--Begin:: Portlet-->
<div class="kt-portlet" id="profileDiv">
    <div class="kt-portlet__body">
        <div class="kt-widget kt-widget--general-1">
            <div class="kt-media kt-media--brand kt-media--md kt-media--circle">
                <img src="" id="img" alt="image">
            </div>
            <div class="kt-widget__wrapper">
                <div class="kt-widget__label">
                    <a href="#" id="user_name" class="kt-widget__title">

                            </a>
                    <span class="kt-widget__desc" id="role_name">

                            </span>
                </div>

            </div>
        </div>
    </div>

    <div class="kt-portlet__separator"></div>

    <div class="kt-portlet__body">
        <ul class="kt-nav kt-nav--bolder kt-nav--fit-ver kt-nav--v4" role="tablist">
            <li class="kt-nav__item ">
                   <span class="tit">الاسم: </span>
                   <span class="val" id="name" ></span>
            </li>
            <li class="kt-nav__item  ">
                   <span class="tit">الفرع: </span>
                   <span class="val" id="branch"></span>
            </li>
            <li class="kt-nav__item  ">
                <span class="tit">تاريخ المباشرة: </span>
                <span class="val" id="start_date"></span>

            </li>
            <li class="kt-nav__item ">
                <span class="tit">انتهاء العقد: </span>
                <span class="val" id="end_date"></span>
            </li>
        </ul>
    </div>

    <div class="kt-portlet__separator"></div>

    <div class="kt-portlet__body">
        <ul class="kt-nav kt-nav--bolder kt-nav--fit-ver kt-nav--v4" role="tablist">
            <li class="kt-nav__item">
                    <span class="tit">البريد الاكتروني</span>
                    <span class="val" id="email"></span>

            </li>
            <li class="kt-nav__item">
                <span class="tit">رقم الهاتف : </span>
                <span class="val" id="phone"></span>
            </li>
            <li class="kt-nav__item">
                <span class="tit">الراتب</span>
                <span class="val" id="salary"></span>

            </li>
        </ul>
    </div>
</div>
<!--End:: Portlet-->

<!--Begin:: Portlet-->
<div class="kt-portlet kt-portlet--head-noborder">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title  kt-font-danger"> المستمسكات</h3>
        </div>
    </div>
    <div class="col-md-12" id="docs">

    </div>
</div>
<!--End:: Portlet-->    </div>
    <!--End:: App Aside-->

    <!--Begin:: App Content-->
    <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
        <div class="kt-portlet">
            <form class="kt-form kt-form--label-right" id="userprofileForm">
                <div class="kt-portlet__body">
                    <div class="kt-section kt-section--first">
                        <div class="kt-section__body">
                            <div class="row">
                                <label class="col-xl-3"></label>
                                <div class="col-lg-9 col-xl-6">
                                    <h3 class="kt-section__title kt-section__title-sm">معلومات الموظف</h3>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">الصورة الشخصية</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_profile_avatar">
                                        <div class="kt-avatar__holder" style="background-image: url(&quot;http://keenthemes.com/keen/preview/default/custom/user/assets/media/users/100_3.jpg&quot;);"></div>
                                        <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pen"></i>
                                            <input type="file" name="e_img" accept=".png, .jpg, .jpeg">
                                        </label>
                                        <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                                    <i class="fa fa-times"></i>
                                                </span>
                                    </div>
                                    <span class="form-text text-danger" id="e_img_err"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">الاسم الكامل</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control" type="text" id="e_name" name="e_name" value="">
                                </div>
                                <span class="form-text text-danger" id="e_name_err"></span>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">العنوان</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control" type="text" id="e_address" name="e_address" value="">
                                </div>
                                <span class="form-text text-danger" id="e_address_err"></span>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">كلمة السر</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control" type="password" type="text" id="e_password" name="e_password" value="">
                                </div>
                                <span class="form-text text-danger" id="e_password_err"></span>
                            </div>
                            <div class="row">
                                <label class="col-xl-3"></label>
                                <div class="col-lg-9 col-xl-6">
                                    <h3 class="kt-section__title kt-section__title-sm">معلومات الاتصال</h3>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">رقم الهاتف</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                        <input type="text" class="form-control" value="" placeholder="Phone" id="e_phone" name="e_phone" aria-describedby="basic-addon1">
                                    </div>
                                    <span class="form-text text-danger" id="e_phone_err"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">البريد الالكتروني</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                        <input type="text" class="form-control" value="" placeholder="Email" id="e_email" name="e_email" aria-describedby="basic-addon1">
                                    </div>
                                    <span class="form-text text-danger" id="e_email_err"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-3 col-xl-3">
                            </div>
                            <div class="col-lg-9 col-xl-9">
                                <button type="button" onclick="updateUser()" class="btn btn-success">حفظ التغيرات</button>&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--End:: App Content-->
</div>
<!--End::App-->	</div>
<script src="assets/js/demo1/pages/custom/profile/profile.js" type="text/javascript"></script>
<script>
function getUser(){
$.ajax({
  url:"script/_getUser.php",
  type:"POST",
  beforeSend:function(){
    $("#profileDiv").addClass('loading');
  },
  success:function(res){
    $("#profileDiv").removeClass('loading');
    console.log(res);
    if(res.success == 1){
      $.each(res.data,function(){
        if(this.documents != "_" && this.documents != "" ){
          documents =this.documents;
        }else{
          documents ='default.png';
        }
        $("#user_name").text(this.name);
        $("#name").text(this.name);
        $("#e_name").val(this.name);
        $("#branch").text(this.branch_name);
        $("#img").attr('src','img/staff/'+this.img);
        $("#email").text(this.email);
        $("#e_email").val(this.email);
        $("#phone").text(this.phone);
        $("#e_phone").val(this.phone);
        $("#e_address").val(this.address);
        $("#start_date").text(this.date);
        $("#end_date").text(this.end_date);
        $("#salary").text('$'+this.salary);
        $("#docs").append("<img class='docs' heigth='100' src='img/staff/"+documents+"'/>" );
      });
    }
    },
   error:function(e){
    $("#profileDiv").removeClass('loading');
    console.log(e);
  }
});
}
getUser();
function updateUser(){
    var myform = document.getElementById('userprofileForm');
    var fd = new FormData(myform);
  $.ajax({
    url:"script/_updateUser.php",
    type:"POST",
    data:fd,
    processData: false,  // tell jQuery not to process the data
    contentType: false,
   	cache: false,
    beforeSend:function(){
     $("#e_name_err").text("");
     $("#e_phone_err").text('');
     $("#e_salary_err").text('');
     $("#e_address_err").text('');
     $("#e_email_err").text('');
     $("#e_password_err").text('');
     $("#e_documents_err").text('');
     $("#e_img_err").text('');
     $("#userprofileForm").addClass("loading");
    },
    success:function(res){
       $("#userprofileForm").removeClass("loading");
       console.log(res);
       if(res.success == 1){
         Toast.success('تم حفظ التغيرات');
        getUser()
       }else{
         $("#e_name_err").text(res.error.name);
         $("#e_phone_err").text(res.error.phone);
         $("#e_email_err").text(res.error.email);
         $("#e_address_err").text(res.error.address);
         $("#e_password_err").text(res.error.password);
         $("#e_img_err").text(res.error.img);
         Toast.warning("هناك بعض المدخلات غير صالحة",'خطأ');
       }

    },
    error:function(e){
       $("#userprofileForm").removeClass("loading");
       console.log(e);
       Toast.error('خطأ');
    }
  });
}
</script>