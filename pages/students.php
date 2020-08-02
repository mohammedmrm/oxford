<!-- begin:: Subheader -->
<!--<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="top">
                    <span>اضافة طالب</span>
                    <a data-toggle="modal" data-target="#addStudentsModal" class="btn btn-icon btn btn-label btn-label-brand btn-bold" data-toggle="dropdown" data-offset="0px,0px" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon2-add-1"></i>

                    </a>
                </div>
            </div>
        </div>
    </div>
</div>-->
<!-- end:: Subheader -->
<!-- begin:: Content -->
<style type="text/css">
.table {
 white-space: nowrap;
}

</style>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				الطلاب
			</h3>
		</div>
	</div>

	<div class="kt-portlet__body">
     <form id="filtterStudentsForm">
		<!--begin: Datatable -->
          <fieldset><legend>فلتر</legend>
          <div class="row kt-margin-b-20">
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>الفرع:</label>
            	<select onchange="getStudents()" class="form-control kt-input" id="branch" name="branch" data-col-index="6">
            	</select>
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>المستوى:</label>
            	<select onchange="getStudents()" data-show-subtext="true" data-live-search="true"  class="selectpicker form-control kt-input" id="f_level" name="level" data-col-index="7">
            		<option value="">Select</option>
            	</select>
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>حالة الطالب:</label>
            	<select onchange="getStudents()" data-show-subtext="true" data-live-search="true"  class="selectpicker form-control kt-input" id="f_student_status" name="f_student_status" data-col-index="7">
            		<option value="">Select</option>
            	</select>
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>نوع الدفع:</label>
            	<select onchange="getStudents()" class="form-control selectpicker kt-input" id="f_payment_type" name="payment_type" data-col-index="7">
							<option>-- اختر نوع الدفع --</option>
							<option value="1">نقدي</option>
							<option value="2">اقساط</option>
            	</select>
            </div>
            <div class="col-lg-4 kt-margin-b-10-tablet-and-mobile">
            <label>الفترة الزمنية :</label>
            <div class="input-daterange input-group" id="kt_datepicker">
  				<input onchange="getStudents()" type="date" class="form-control kt-input" name="start" id="start" placeholder="من" data-col-index="5">
  				<div class="input-group-append">
  					<span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
  				</div>
  				<input onchange="getStudents()" type="date" class="form-control kt-input" name="end"  id="end" placeholder="الى" data-col-index="5">
          	</div>
            </div>

          </div>
          <div class="row kt-margin-b-20">
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>رقم الطالب:</label>
            	<input id="student_number" name="student_number" onkeyup="getStudents()" type="text" class="form-control kt-input" placeholder="" data-col-index="0">
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>اسم الطالب:</label>
            	<input  onkeyup="getStudents()" type="text" name="student_name" class="form-control kt-input" placeholder="" data-col-index="1">
            </div>
            <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
              	<label>عدد السجلات في الصفحة الواحدة</label>
              	<select onchange="getStudents()" class="form-control kt-input" name="limit" data-col-index="7">
              		<option value="10">10</option>
              		<option value="15">15</option>
              		<option value="20">20</option>
              		<option value="25">25</option>
              		<option value="30">30</option>
              		<option value="50">50</option>
              	</select>
            </div>
            <?php if($a == 4){?>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>اضافة طالب جديد:</label>
            	<button type="button" data-toggle="modal" data-target="#addStudentsModal" class="btn btn-primary"> <i class="flaticon2-add-1"></i> اضافة طالب</button>
            </div>
           <?php } ?>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
          </div>
          </fieldset>
		  <table class="table table-striped table-bordered table-hover  responsive no-wrap" id="tb-student">
			       <thead>
	  						<tr>
								<th>#</th>
								<th>رقم الطالب</th>
								<th>الاسم</th>
								<th>رقم الهاتف</th>
								<th>الفرع</th>
								<th>الحالة</th>
								<th>تاريخ التسجيل</th>
								<th>تعديل</th>
								<th>الجواز</th>
								<th>المستمسكات 1</th>
								<th>المستمسكات 2</th>
								<th>المستمسكات 3</th>
							</tr>
      	            </thead>
                            <tbody id="studentesTable">
                            </tbody>
		</table>
        <div class="kt-section__content kt-section__content--border">
		<nav aria-label="...">
			<ul class="pagination" id="pagination">

			</ul>
        <input type="hidden" id="p" name="p" value="<?php if(!empty($_GET['p'])){ echo $_GET['p'];}else{ echo 1;}?>"/>
		</nav>
     	</div>
        </form>
		<!--end: Datatable -->
	</div>
</div>	</div>
<!-- end:: Content -->


<!--begin::Page Vendors(used by this page) -->
<script src="assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->



<!--begin::Page Scripts(used by this page) -->
<script src="assets/js/demo1/pages/components/datatables/extensions/responsive.js" type="text/javascript"></script>
<script type="text/javascript">
function getStudents(){
$.ajax({
  url:"script/_getStudents.php",
  type:"POST",
  data:$("#filtterStudentsForm").serialize(),
  beforeSend:function(){
    $("#pagination").html("");
    $("#tb-student").addClass("loading");
  },
  success:function(res){

  if(res.role != 1 && res.role != 3){
    $("#branch").attr("disabled",true);
  }else{
    $("#branch").attr("disabled",false);
  }
   $("#branch").selectpicker("refresh");
   $("#tb-student").removeClass("loading");
   $("#tb-student").DataTable().destroy();
   $("#studentesTable").html("");
   $("#studentesTable").html("");
      if(res.pages >= 1){
     if(res.page > 1){
         $("#pagination").append(
          '<li class="page-item"><a href="#" onclick="getstudentspage('+(Number(res.page)-1)+')" class="page-link">السابق</a></li>'
         );
     }else{
         $("#pagination").append(
          '<li class="page-item disabled"><a href="#" class="page-link">السابق</a></li>'
         );
     }
     if(Number(res.pages) <= 5){
       i = 1;
     }else{
       i =  Number(res.page) - 5;
     }
     if(i <=0 ){
       i=1;
     }
     for(i; i <= res.pages; i++){
       if(res.page != i){
         $("#pagination").append(
          '<li class="page-item"><a href="#" onclick="getstudentspage('+(i)+')"  class="page-link">'+i+'</a></li>'
         );
       }else{
         $("#pagination").append(
          '<li class="page-item active"><span class="page-link">'+i+'</span></li>'
         );
       }
       if(i == Number(res.page) + 5 ){
         break;
       }
     }
     if(res.page < res.pages){
         $("#pagination").append(
          '<li class="page-item"><a href="#" onclick="getstudentspage('+(Number(res.page)+1)+')" class="page-link">التالي</a></li>'
         );
     }else{
         $("#pagination").append(
          '<li class="page-item disabled"><a href="#" class="page-link">التالي</a></li>'
         );
     }
   }
   $.each(res.data,function(){
     if(this.passport == '_'){
       passport = 'd.png';
     }else{
       passport = this.passport
     }

     if(this.id1 == '_'){
       id1 = 'd.png';
     }else{
       id1 = this.id1
     }
     if(this.id2 == '_'){
       id2 = 'd.png';
     }else{
       id2 = this.id2
     }
     if(this.id3 == '_'){
       id3 = 'd.png';
     }else{
       id3 = this.id3
     }

     btns= "";
     if(res.role == 4 ){
       btns =   '<button type="button" class="btn btn-lg btn-link  text-primary" tooltip="تعديل معلومات الطالب" onclick="editStudent('+this.id+')" data-toggle="modal" data-target="#editStudentsModal"><span class="flaticon-edit"></sapn></button>'+
                '<button type="button" class="btn btn-lg btn-link  text-success" onclick="updateStudnetid('+this.id+')" data-toggle="modal" data-target="#transferStudentsModal"><span class="fa fa-route"></sapn></button>'+
                '<button type="button" class="btn btn-lg btn-link  text-info"    onclick="PaysStudent('+this.id+')" data-toggle="modal" data-target="#PaysStudentModal"><span class="fa fa-money-check-alt"></sapn></button>'+
                '<button type="button" class="btn btn-lg btn-link  text-warning"    onclick="chargeStudentid('+this.id+')" data-toggle="modal" data-target="#chargeStudentModal"><span class="fa fa-money-check-alt"></sapn></button>'+
                '<button type="button" class="btn btn-lg btn-link  text-info"    onclick="gratuatedStudent('+this.id+')" data-toggle="modal" data-target="#graduatedStudentModal"><span class="fa fa-graduation-cap"></sapn></button>';
     }
     status = this.status;
     if(this.students_status_id == 4 ){
        status = '<span class="kt-menu__link-badge"><span class=" kt-badge kt-badge--danger kt-badge--inline"><span class="fa fa-graduation-cap"></span></span></span>'
        btns= "<h2 class='text-success'>الطالب متخرج</h2>";
     }else if(this.students_status_id == 3 && (res.role == 3 || res.role == 4)){
       btns='<button type="button" class="btn btn-link  text-success" onclick="unkickStudnet('+this.id+')" data-toggle="modal" data-target="#unkickStudentsModal"><span class="fa fa-eye"></sapn></button>';
     }else if(this.students_status_id == 2 && (res.role == 3 || res.role == 4)){
       btns='<button type="button" class="btn btn-lg btn-link  text-success" onclick="unkickStudnet('+this.id+')" data-toggle="modal" data-target="#unkickStudentsModal"><span class="fa fa-eye"></sapn></button>';
     }
     if(res.role == 3 && this.students_status_id == 1){
           btns= btns + '<button type="button" class="btn btn-lg btn-link  text-warning" onclick="kickStudnet('+this.id+')" data-toggle="modal" data-target="#kickStudentsModal"><span class="fa fa-eye-slash"></sapn></button>'+
                        '<button type="button" class="btn btn-lg btn-link  text-danger"  onclick="deleteStudent('+this.id+')" data-toggle="modal" data-target="#deleteStudentsModal"><span class="flaticon-delete"></sapn></button>';
      }

     $("#studentesTable").append(
       '<tr>'+
            '<td>'+
              '<img class="user-img" src="img/student/'+this.img+'"/>'+
            '</td>'+
            '<td width="200px"><a href="RegistrationForm.php?id='+this.id+'" target="_blank" title="استمارة التسجيل">'+this.student_number+'</a></td>'+
            '<td><a target="_blank" href="contract.php?id='+this.id+'" target="_blank">'+this.name+'</a></td>'+
            '<td><a href="studentReport.php?id='+this.id+'" target="_blank">'+this.phone+'</a></td>'+
            '<td>'+this.branch_name+'</td>'+
            '<td>'+status+'</td>'+
            '<td>'+this.date+'</td>'+
            '<td>'+ btns +
            '</td>'+
            '<td><a target="_blank" href="img/student/'+passport+'"><img width="60px" src="img/student/'+passport+'"/></a></td>'+
            '<td><a target="_blank" href="img/student/'+id1+'"><img width="60px" src="img/student/'+id1+'"/></a></td>'+
            '<td><a target="_blank" href="img/student/'+id2+'"><img width="60px" src="img/student/'+id2+'"/></a></td>'+
            '<td><a target="_blank" href="img/student/'+id3+'"><img width="60px" src="img/student/'+id3+'"/></a></td>'+

       '</tr>');
     });
     $("#tb-student").DataTable().destroy();
     var myTable= $('#tb-student').DataTable({
     columns:[
    //"dummy" configuration
        { visible: true }, //col 1
        { visible: true }, //col 2
        { visible: true }, //col 3
        { visible: true }, //col 4
        { visible: true }, //col 5
        { visible: true }, //col 6
        { visible: true }, //col 7
        { visible: true }, //col 8
        { visible: true }, //col 9
        { visible: true }, //col 10
        { visible: true }, //col 11
        { visible: true }, //col 12
        ],
       "bPaginate": false,
       "bLengthChange": false,
       "bFilter": false,
       serverPaging: true
  });
    },
   error:function(e){
    $("#tb-student").removeClass("loading");
    console.log(e);
  }
});
}
getStudents();

</script>
<?php if($a == 4 || $a == 3){?>
<div class="modal fade " id="addStudentsModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">اضافة طالب</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
           <!--begin::Form-->
                <form class="kt-form" id="addStudentForm">
						<div class="row">
						<div class="col-md-6">
							<div class="form-group">
                               <label>الرقم التسلسلي:</label>
                               <label id="l_reg_number1"></label>
                               <input type="hidden" value="" name="reg_number" id="reg_number1">
                               <input type="hidden" value="5" name="serial" id="serial1">
                               <span class="form-text text-danger" id="err_reg_number1"></span>
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
								<label>عنوان السكن:</label>
								<textarea class="form-control"  name="address"></textarea>
								<span class="form-text text-danger" id="err_address"></span>
							</div>
							<div class="form-group">
								<label>اسم الكفيل:</label>
								<input class="form-control" type="tele"  name="gran_name">
								<span class="form-text text-danger" id="err_gran_name"></span>
							</div>
							<div class="form-group">
								<label>رقم هاتف الكفيل:</label>
								<input class="form-control" type="tele"  name="gran_phone">
								<span class="form-text text-danger" id="err_gran_phone"></span>
							</div>
							<div class="form-group">
								<label>الجنس:</label>
                                <div class="kt-radio-list">
      							<label class="kt-radio kt-radio--bold kt-radio--brand">
      								<input type="radio" value="1" id="male" name="gender"> ذكر
                                    <span></span>
      							</label>
                                <label class="kt-radio kt-radio--bold kt-radio--brand">
      								<input type="radio" value="2" id="female" name="gender"> انثى
                                    <span></span>
      							</label>
                                <span class="form-text text-danger" id="err_gender"></span>
      						    </div>
							</div>
							<div class="form-group">
								<label>المجموعة (الصف):</label>
                                <select class="form-control" id="group" name="group">
        							<option>-- اختر المستوى --</option>
        						</select>
                                <span class="form-text text-danger" id="group_err"></span>
							</div>
							<div class="form-group">
								<label>صورة شخصية:</label>
								<input class="form-control" type="file" name="img">
								<span class="form-text text-danger" id="err_img"></span>
							</div>
                            <div class="form-group">
								<label>جواز السفر:</label>
								<input class="form-control" type="file" name="passport">
								<span class="form-text text-danger" id="err_passport"></span>
							</div>
							<div class="form-group">
								<label>المستمسكات:</label>
								<input class="form-control" type="file" name="id1">
								<span class="form-text text-danger" id="err_id1"></span>
							</div>
                        </div>
                        <div class="col-md-6">
							<div class="form-group">
								<label>ملحق مستمسكات 1:</label>
								<input class="form-control" type="file" name="id2">
								<span class="form-text text-danger" id="err_id2"></span>
							</div>
							<div class="form-group">
								<label>ملحق مستمسكات 2:</label>
								<input class="form-control" type="file" name="id3">
								<span class="form-text text-danger" id="err_id3"></span>
							</div>
							<div class="form-group">
								<label>التحصيل الدراسي:</label>
								<input class="form-control" type="text"  name="cer">
								<span class="form-text text-danger" id="err_cer"></span>
							</div>
							<div class="form-group">
								<label>اللغات التي يتكلمها الطالب:</label>
								<input class="form-control" type="text"  name="lngs">
								<span class="form-text text-danger" id="err_lngs"></span>
							</div>
							<div class="form-group">
								<label>المستوى الدراسي:</label>
                                <select class="form-control" id="level" name="level">
        							<option>-- اختر المستوى --</option>
        						</select>
                                <span class="form-text text-danger" id="level_err"></span>
							</div>
							<div class="form-group">
								<label>رسوم التسجيل:</label>
								<input class="form-control" type="number" value="20" name="reg_fee">
								<span class="form-text text-danger" id="err_reg_fee"></span>
							</div>
							<div class="form-group">
								<label>الخصم:</label>
								<input class="form-control" type="number" value="0" name="discount">
								<span class="form-text text-danger" id="err_discount"></span>
							</div>
							<div class="form-group">
								<label>نوع الدفع:</label>
                                <select class="form-control" onchange="PayBtnStatus()" id="payment_type" name="payment_type">
        							<option>-- اختر نوع الدفع --</option>
        							<option value="1">نقدي</option>
        							<option value="2">اقساط</option>
        						</select>
                                <span class="form-text text-danger" id="err_payment_type"></span>
							</div>
                            <div class="form-group">
        						<label>اضافة قسط:</label>
        						<button type="button" onclick="addPay()" id="PayBtn" class="btn btn-success" placeholder="">
                                 <span class="flaticon-add"></span>&nbsp;اضافة قسط
                                </button>
        						<button type="button" onclick="payReset()"  class="btn btn-info" placeholder="">
                                 <span class="flaticon-refresh"></span>
                                </button>
    					    </div>
                            <div id="Pays"></div>
                            <span class="form-text text-danger" id="pays_err"></span>
                        </div>
                        </div>
						<div class="kt-form__actions">
							<button type="button" onclick="addStudent1()" class="btn btn-primary">اضافة</button>
							<button type="reset" data-dismiss="modal" class="btn btn-secondary">الغأ</button>
						</div>
					</form>
			<!--end::Form-->
		<!--end::Portlet-->
        </div>
      </div>

    </div>
  </div>
<?php } ?>
<?php if($a == 4 || $a == 3){?>
<div class="modal fade" id="editStudentsModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">تعديل معلومات الطالب</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
        <!--begin::Form-->
			<form class="kt-form" id="editStudentsForm">
            <div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>الاسم:</label>
								<input type="text" id="e_name" name="e_name" class="form-control" placeholder="الاسم الكامل">
								<span class="form-text text-danger" id="e_err_name"></span>
							</div>
							<div class="form-group">
								<label>رقم الهاتف:</label>
								<input type="phone" id="e_phone" name="e_phone" class="form-control" placeholder="رقم الهاتف">
								<span class="form-text text-danger" id="e_phone_err"></span>
							</div>
							<div class="form-group">
								<label>تاريخ الميلاد:</label>
								<input class="form-control" type="date" value="" id="e_birthday" name="e_birthday">
								<span class="form-text text-danger" id="e_birthday_err"></span>
							</div>
							<div class="form-group">
								<label>الجنس:</label>
                                <select class="form-control"  id="e_gender" name="e_gender">
        							<option>-- اختر الجنس --</option>
        							<option value="1">ذكر</option>
        							<option value="2">انثى</option>
        						</select>
                                <span class="form-text text-danger" id="e_gender_err"></span>
							</div>
							<div class="form-group">
								<label>المجموعة:</label>
                                <select class="form-control" id="e_group" name="e_group">
        							<option value="">-- اختر مجموعة --</option>
        						</select>
                                <span class="form-text text-danger" id="e_group_err"></span>
							</div>
                      </div>
                        <div class="col-md-6">
							<div class="form-group">
								<label>صورة شخصية:</label>
								<input class="form-control" type="file" name="e_img">
								<span class="form-text text-danger" id="e_img_err"></span>
							</div>
                            <div class="form-group">
								<label>جواز السفر:</label>
								<input class="form-control" type="file" name="e_passport">
								<span class="form-text text-danger" id="e_passport_err"></span>
							</div>
							<div class="form-group">
								<label>المستمسكات:</label>
								<input class="form-control" type="file" name="e_id1">
								<span class="form-text text-danger" id="e_id1_err"></span>
							</div>
                            <div class="form-group">
								<label>ملحق مستمسكات 1:</label>
								<input class="form-control" type="file" name="e_id2">
								<span class="form-text text-danger" id="e_id2_err"></span>
							</div>
							<div class="form-group">
								<label>ملحق مستمسكات 2:</label>
								<input class="form-control" type="file" name="e_id3">
								<span class="form-text text-danger" id="e_id3_err"></span>
							</div>
                        </div>
                        </div>

	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="updateStudent()" class="btn btn-brand">حفظ التغيرات</button>
						<button type="reset" data-dismiss="modal" class="btn btn-secondary">الغاء</button>
					</div>
				</div>
                <input type="hidden" name="editstudentid" id="editstudentid"/>
			</form>
			<!--end::Form-->
		<!--end::Portlet-->
        </div>
      </div>

    </div>
  </div>
<?php } ?>
<?php if($a == 4 || $a == 3){?>
<div class="modal fade" id="transferStudentsModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">نقل الطالب الى فرع اخر</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="transferStudentsForm">
				<div class="kt-portlet__body">
					<div class="form-group">
						<label>الفرع:</label>
                        <select class="form-control" name="e_student_branch" id="e_student_branch">

                        </select>
                        <span class="form-text  text-danger" id="e_student_branch_err"></span>
					</div>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="transferStudent()" class="btn btn-brand">حفظ التغيرات</button>
						<button type="reset" data-dismiss="modal" class="btn btn-secondary">الغاء</button>
					</div>
				</div>
                <input type="hidden" name="student_id" id="student_id"/>
			</form>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->
        </div>
      </div>

    </div>
  </div>
<?php } ?>
<?php if($a == 4 || $a == 3){?>
<div class="modal fade" id="suspendStudentsModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">تأجيل مباشرة الطالب</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="suspendStudentsForm">
				<div class="kt-portlet__body">
					<div class="form-group">
						<label>تأجيل حتى تاريخ:</label>
                        <input type="date" class="form-control" name="suspendStudentDate" id="suspendStudentDate"/>
                        <span class="form-text  text-danger" id="suspendStudentDate_err"></span>
					</div>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="suspendStudent()" class="btn btn-brand">حفظ التغيرات</button>
						<button type="reset" data-dismiss="modal" class="btn btn-secondary">الغاء</button>
					</div>
				</div>
			</form>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->
        </div>
      </div>

    </div>
  </div>
<?php } ?>
<?php if($a == 4 || $a == 3 || $a==2){?>
<div class="modal fade" id="PaysStudentModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">تعديل الاقساط</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->


			<!--begin::Form-->
			<form class="kt-form" id="NewPaysStudentForm">
               <div class="row">
               <div class="col-md-4">
                  <label>الاقساط المستلمة : </label><label dir="ltr" id="pays_recived" class="text-success"></label>
               </div>
               <div class="col-md-4">
                 <label>الاقساط الغير مؤكده : </label><label dir="ltr" id="pays_unconfirmed" class="text-warning"></label>
               </div>
               <div class="col-md-4">
                 <label>الاقساط غير المستلمة : </label><label dir="ltr" id="pays_unrecived" class="text-danger"></label>
               </div>
               </div>
               <hr />
               <div class="row">
                 <div class="col-md-12 text-center">
                   <label>المبلغ المطلوب : </label><label class="text-info" dir="ltr" id="pays_require_onced"></label><label> + الاجور الاضافية </label>
                 </div>
               </div>
               <hr />
               <div class="row">
                 <div class="col-md-6">
<!--				 <div class="form-group">
    				 <label>الاجور الاضافية:</label>
    				 <input type="number" id="e_extra" name="e_extra" class="form-control" placeholder="Extra Fees">
    				 <span class="form-text text-danger" id="e_extra_err"></span>
				 </div>-->
                   <h3>الاقساط السابقة</h3>
                   <div id="oldPays"></div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                  		<label>نوع الدفع:</label>
                        <select class="form-control" onchange="NewPayBtnStatus()" id="Newpayment_type" name="Newpayment_type">
							<option>-- اختر نوع الدفع --</option>
							<option value="1">نقدي</option>
							<option value="2">اقساط</option>
						</select>
                        <span class="form-text text-danger" id="err_Newpayment_type"></span>
                  	 </div>
                     <div class="form-group">
						<label>اضافة قسط:</label>
						<button type="button" onclick="addNewPay()" id="NewPayBtn" class="btn btn-success" placeholder="">
                         <span class="flaticon-add"></span>&nbsp;اضافة قسط
                        </button>
						<button type="button" onclick="NewpayReset()" class="btn btn-info" placeholder="">
                         <span class="flaticon-refresh"></span>
                        </button>
                        <span class="form-text">في حالة تعديل الاقساط سيتم حذف جميع الاقساط السابقة غير مستلمة والغير مؤكدة واستبدلها بالاقساط الجديدة</span>
    				 </div>
                     <div id="NewPays"></div>
                     <span class="form-text text-danger" id="Newpays_err"></span>
                     <input type="hidden" name="paysStudent_id" id="paysStudent_id" />
                 </div>
               </div>
        		<div class="kt-form__actions">
        			<button type="button" onclick="updateStudentPays()" class="btn btn-primary">اضافة</button>
        			<button type="reset" data-dismiss="modal" class="btn btn-secondary">الغأ</button>
        		</div>
			</form>
			<!--end::Form-->
		<!--end::Portlet-->
        </div>
      </div>

    </div>
  </div>
<?php } ?>

<?php if($a == 4 || $a == 3 || $a==2){?>
<div class="modal fade" id="chargeStudentModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">تغريم الطالب</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->


			<!--begin::Form-->
			<form class="kt-form" id="chargeStudentForm">
               <div class="row">
               <div class="col-12">
                  <div class="form-group">
                  <label>مقدار الغرامه</label>
                  <input type="number" min="1" max="400" step="1" class="form-control"  name="charge_amount" />
                  <label class="text-danger" id="charge_amount_err"></label>
                  </div>
               </div>
               </div>
               <div class="row">
               <div class="col-12">
                  <div class="form-group">
                  <label>السبب</label>
                  <textarea class="form-control" name="charge_reason"></textarea>
                  <label class="text-danger" id="charge_reason_err"></label>
                  </div>
               </div>
               <input type="hidden" id="charge_student_id" name="charge_student_id" />
               <label class="text-danger" id="charge_student_err"></label>
               </div>
               <div class="kt-form__actions">
        			<button type="button" onclick="StudentCharge()" class="btn btn-primary">اضافة</button>
        			<button type="reset" data-dismiss="modal" class="btn btn-secondary">الغأ</button>
        		</div>
			</form>
			<!--end::Form-->
		<!--end::Portlet-->
        </div>
      </div>

    </div>
  </div>
<?php } ?>
<script type="text/javascript" src="js/getBraches.js"></script>
<script type="text/javascript" src="js/getLevels.js"></script>
<script type="text/javascript" src="js/getGroups.js"></script>
<script type="text/javascript" src="js/getStudentStatus.js"></script>
<script>
getBraches($("#branch"));
getBraches($("#e_student_branch"));
getStudentStatus($("#f_student_status"));
getLevels($("#level"));
getLevels($("#f_level"));
getGroups($("#e_group"));
getGroups($("#group"));
function addStudent1(){
    var myform = document.getElementById('addStudentForm');
    var fd = new FormData(myform);
  $.ajax({
    url:"script/_addStudent1.php",
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
     $("#err_address").text("");
     $("#err_gran_name").text("");
     $("#err_cer").text("");
     $("#err_lngs").text("");
     $("#err_gran_phone").text("");
     $("#err_reg_fee").text("");
     $("#err_discount").text("");
     $("#group_err").text("");
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
         getStudentNumber1();
         getStudents();
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
         $("#err_id2").text(res.error.id2);
         $("#err_id3").text(res.error.id3);
         $("#err_address").text(res.error.address);
         $("#err_gran_name").text(res.error.gran_name);
         $("#err_lngs").text(res.error.lngs);
         $("#err_cer").text(res.error.cer);
         $("#err_gran_phone").text(res.error.gran_phone);
         $("#err_reg_fee").text(res.error.reg_fee);
         $("#err_discount").text(res.error.discount);
         $("#level_err").text(res.error.level);
         $("#pays_err").text(res.error.pays_err);
         $("#group_err").text(res.error.group);
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
function editStudent(id){
  $("#editstudentid").val(id);
  $.ajax({
    url:"script/_getStudent.php",
    data:{id: id},
    success:function(res){
      if(res.success == 1){
        $.each(res.data,function(){
          $('#e_name').val(this.name);
          $('#e_phone').val(this.phone);
          $('#e_birthday').val(this.birthday);
          $('#e_group').val(this.group_id);
          $('#e_gender').val(this.gender);
          console.log(this.gender);
        });
      }
      console.log(res);
    },
    error:function(e){
      console.log(e);
    }
  });
}
function updateStudent(){
    var myform = document.getElementById('editStudentsForm');
    var fd = new FormData(myform);
    $.ajax({
       url:"script/_updateStudent.php",
       type:"POST",
       data:$("#editStudentsForm").serialize(),
       data:fd,
       processData: false,  // tell jQuery not to process the data
       contentType: false,
       cache: false,
       beforeSend:function(){
         $("#editStudentsForm").addClass("loading");
       },
       success:function(res){
         console.log(res);
       $("#editStudentsForm").removeClass("loading");
       if(res.success == 1){
         $("#kt_form input").val("");
          Toast.success('تم التحديث');
          getStudents();
       }else{
           Toast.warning("هناك بعض المدخلات غير صالحة او قد لم تقم باجراء اي تغير",'خطأ');
       }
           $("#e_name_err").text(res.error["name"]);
           $("#e_birthday_err").text(res.error["birthday"]);
           $("#e_phone_err").text(res.error["phone"]);
           $("#e_gender_err").text(res.error["gender"]);
           $("#e_group_err").text(res.error["group"]);
           $("#e_extra_err").text(res.error["extra"]);
           $("#e_img_err").text(res.error["img"]);
           $("#e_passport_err").text(res.error["passport"]);
           $("#e_id1_err").text(res.error["id1"]);
           $("#e_id2_err").text(res.error["id2"]);
           $("#e_id3_err").text(res.error["id3"]);
       },
       error:function(e){
        $("#editStudentsForm").removeClass("loading");
        Toast.error('خطأ');
        console.log(e);
       }
    })
}
var indecater = 1;
function addPay(){
 pay =     			'<div class="form-group">'+
    						'<label>القسط '+indecater+'</label><br />'+
                            '<input type="text" name="PayPrice[]" class="form-control" placeholder="مبلغ القسط">'+
                            '<input type="date" name="PayDate[]" class="form-control" placeholder="تاريخ الاستحقاق">'+
    						'<span class="form-text  text-danger" id="Pay_err"></span>'+
    					'</div>'
if(indecater < 4){
$("#Pays").append(pay);
 indecater = indecater +1;
 }else{
   Toast.error('لا يمكن اضافة المزيد');
 }
 console.log(indecater);
}
$("#PayBtn").attr('disabled',true);
function PayBtnStatus(){
  if($("#payment_type").val() == 2){
    $("#PayBtn").attr('disabled',false);
  }else{
    $("#PayBtn").attr('disabled',true);
  }
}
///--- انشاء رقم تسلسلي للطالب
function getStudentNumber1(){
  $.ajax({
    url:"script/_studentnumberBuilder.php",
    type:"POST",
    beforeSend:function(){

    },
    success:function(res){
       $("#l_reg_number1").text(res.reg_number);
       $("#reg_number1").val(res.reg_number);
       $("#serial1").val(res.serial);
      console.log(res);
    },
    error:function(e){
     console.log(e);

    }
  });

}
getStudentNumber1();
function payReset(){
  $("#Pays").html("");
  indecater = 1;
}
function transferStudent(){
  $.ajax({
    url:"script/_transferStudent.php",
    type:"POST",
    data:{branch:$("#e_student_branch").val(),student:$("#student_id").val()},
    beforeSend:function(){
     $("#transferstudentsForm").addClass('loading');
    },
    success:function(res){
      $("#transferstudentsForm").removeClass('loading');
      $("#e_student_branch_err").val(res.error.branch);
      if(res.success == 1){
           Toast.success('تم نقل الطالب');
           getStudents();
      }else{
           Toast.warning("خطأ");
      }
      console.log(res);
    },
    error:function(e){
     $("#transferstudentsForm").removeClass('loading');
     console.log(e);
     Toast.error("حدث خطأ");
    }
  });
}
function suspendStudent(){
  $.ajax({
    url:"script/_suspendStudent.php",
    type:"POST",
    data:{date:$("#suspendStudentDate").val(),student:$("#student_id").val()},
    beforeSend:function(){
     $("#suspendtudentsForm").addClass('loading');
    },
    success:function(res){
      $("#suspendtudentsForm").removeClass('loading');
      $("#suspendStudentDate_err").text(res.error.date);
      if(res.success == 1){
           Toast.success('تم تأجيل مباشرة الطالب');
           $("#suspendStudentDate_err").text("");
           getStudents();
      }else{
           Toast.warning("خطأ");
      }
      console.log(res);
    },
    error:function(e){
     $("#suspendtudentsForm").removeClass('loading');
     console.log(e);
     Toast.error("حدث خطأ");
    }
  });
}
function deleteStudent(id){
  if(confirm("هل انت متاكد من الحذف")){
      $.ajax({
        url:"script/_deleteStudent.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم الحذف');
           getStudents();
           getStudentNumber1();
         }else{
           Toast.warning(res.msg);
         }
         console.log(res)
        } ,
        error:function(e){
          console.log(e);
        }
      });
  }
}
function kickStudnet(id){
  if(confirm("هل انت متاكد من الفصل")){
      $.ajax({
        url:"script/_kickStudent.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم الفصل');
           getStudents();
           getStudentNumber1();
         }else{
           Toast.warning(res.msg);
         }
         console.log(res)
        } ,
        error:function(e){
          console.log(e);
        }
      });
  }
}
function unkickStudnet(id){
  if(confirm("هل انت متأكد من اعادة مباشرة الطالب من اليوم")){
      $.ajax({
        url:"script/_unkickStudent.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم الفصل');
           getStudents();
           getStudentNumber1();
         }else{
           Toast.warning(res.msg);
         }
         console.log(res)
        } ,
        error:function(e){
          console.log(e);
        }
      });
  }
}

function gratuatedStudent(id){
  if(confirm("هل انت متاكد من تخرج الطالب")){
      $.ajax({
        url:"script/_gratuatedStudent.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم تسجيل الطالب ك متخرج');
           getStudents();
         }else{
           Toast.warning(res.msg);
         }
         console.log(res)
        } ,
        error:function(e){
          console.log(e);
        }
      });
  }
}
function updateStudnetid(id){
 $("#student_id").val(id);
}
var newindecater = 1
function addNewPay(){
 pay =     			'<div class="form-group">'+
    						'<label>القسط '+newindecater+'</label><br />'+
                            '<input type="text" name="NewPayPrice[]" class="form-control" placeholder="مبلغ القسط">'+
                            '<input type="date" name="NewPayDate[]" class="form-control" placeholder="تاريخ الاستحقاق">'+
                    '</div>'
if(newindecater < 4){
$("#NewPays").append(pay);
 newindecater = newindecater +1;
 }else{
   Toast.error('لا يمكن اضافة المزيد');
 }
 console.log(newindecater);
}
function NewpayReset(){
  $("#NewPays").html("");
  newindecater = 1;
}

function PaysStudent(id){
      $("#paysStudent_id").val(id);
      $.ajax({
        url:"script/_getPaysStudent.php",
        type:"POST",
        data:{student_id:id},
        beforeSend:function(){
          $("#NewPaysStudentsForm").removeClass('loading');
          $("#oldPays").html("");
          $("#NewPays").html("");
          $("#Newpays_err").html("");
        },
        success:function(res){
          $("#NewPaysStudentsForm").addClass('loading');
         if(res.success == 1){
            $("#e_extra").val(res.extra);
             unrecived = 0;
             recived = 0;
             unconfirmed = 0;
             require_onced = 0;
           $.each(res.paysdetials, function(){
              if(this.confirm == 0){
                 unrecived = unrecived + Number(this.amount);
                 require_onced = require_onced + Number(this.amount);
                 confirm = 'غير مستلم';
              }else if(this.confirm == 1){
                 unconfirmed = unconfirmed + Number(this.amount);
                 require_onced = require_onced + Number(this.amount);
                 confirm = 'غير مؤكد';
              }else if(this.confirm == 2){
                 recived = recived + Number(this.amount);
                 confirm = 'مستلم';
              }
              $("#oldPays").append(
               '<label>$ '+this.amount+'</label> ||'+
               ' <label>'+this.date+'</label> || '+
               ' <label>'+confirm+'</label><br />'
              );
           });
           $("#pays_recived").text("$ "+recived);
           $("#pays_unconfirmed").text("$ "+unconfirmed);
           $("#pays_unrecived").text("$ "+unrecived);
           $("#pays_require_onced").text("$ "+require_onced);
         }else{
           Toast.warning("حصل خطأ");
         }
         console.log(res)
        } ,
        error:function(e){
          $("#NewPaysStudentsForm").removeClass('loading');
          console.log(e);
        }
      });
}
$("#NewPayBtn").attr('disabled',true);
function NewPayBtnStatus(){
  if($("#Newpayment_type").val() == 2){
    $("#NewPayBtn").attr('disabled',false);
  }else{
    $("#NewPayBtn").attr('disabled',true);
  }
}
function updateStudentPays(){
      $.ajax({
        url:"script/_updatePaysStudent.php",
        type:"POST",
        data:$("#NewPaysStudentForm").serialize(),
        beforeSend:function(){
           $("#err_Newpayment_type").text("");
           $("#Newpays_err").text("");
        },
        success:function(res){
         if(res.success == 1){
           Toast.success('تم الحذف');
           getStudents();
           PaysStudent($("#paysStudent_id").val());
           getStudentNumber1();
         }else{
           $("#err_Newpayment_type").text(res.error.payment_type);
           $("#Newpays_err").html(res.error.pays_err);
         }
         console.log(res)
        } ,
        error:function(e){
          console.log(e);
        }
      });
}
function chargeStudentid(id){
  $("#charge_student_id").val(id);
}
function StudentCharge(){
      $.ajax({
        url:"script/_studentCharge.php",
        type:"POST",
        data:$("#chargeStudentForm").serialize(),
        beforeSend:function(){
           $("#charge_reason_err").text("");
           $("#charge_amount_err").text("");
           $("#chargeStudentForm").addClass("loading");
        },
        success:function(res){
          $("#chargeStudentForm").removeClass("loading");
         if(res.success == 1){
           Toast.success('تم');
         }else{
           Toast.warning('خطأ');
           $("#charge_reason_err").text(res.error.reason);
           $("#charge_amount_err").html(res.error.amount);
           $("#charge_student_err").html(res.error.student);
         }
         console.log(res)
        } ,
        error:function(e){
          $("#chargeStudentForm").removeClass("loading");
          console.log(e);
        }
      });
}
function getstudentspage(page){
    $("#p").val(page);
    getStudents();
}
</script>