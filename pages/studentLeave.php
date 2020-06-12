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
          <fieldset><legend>البحث عن طالب</legend>
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
            <?php if($a == 4){?>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>اضافة طالب جديد:</label>
            	<button type="button" data-toggle="modal" data-target="#addStudentsModal" class="btn btn-primary"> <i class="flaticon2-add-1"></i> اضافة طالب</button>
            </div>
           <?php } ?>
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
								<th>تاريخ المباشرة</th>
								<th>تعديل</th>

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
  },
  success:function(res){
  if(res.role != 1 && res.role != 3){
    $("#branch").attr("disabled",true);
  }else{
    $("#branch").attr("disabled",false);
  }
    $("#branch").selectpicker("refresh");
   console.log(res);
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
     $("#studentesTable").append(
       '<tr>'+
            '<td>'+
              '<img class="user-img" src="img/student/'+this.img+'"/>'+
            '</td>'+
            '<td width="200px"><a href="?page=pages/showStudentLeave.php&reg='+this.student_number+'" target="_blank" title="استمارة التسجيل">'+this.student_number+'</a></td>'+
            '<td><a target="_blank" href="contract.php?id='+this.id+'" target="_blank">'+this.name+'</a></td>'+
            '<td>'+this.phone+'</td>'+
            '<td>'+this.start_date+'</td>'+
            '<td>'+
                '<button type="button" class="btn btn-link  text-success" onclick="updateStudnetid('+this.id+')"  title="اجازة" data-toggle="modal" data-target="#leaveStudentsModal"><span class="flaticon-clock-2"></sapn></button>'+
                '<button type="button" class="btn btn-link  text-warning" onclick="updateStudnetid('+this.id+')" data-toggle="modal" data-target="#suspendStudentsModal"><span data-toggle="tooltip" title="تأجيل" class="flaticon2-time"></sapn></button>'+
           '</td>'+

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
        ],
       "bPaginate": false,
       "bLengthChange": false,
       "bFilter": false,
       serverPaging: true
});
    },
   error:function(e){
    console.log(e);
  }
});
}
getStudents();

</script>

<input type="hidden" name="student_id" id="student_id"/>

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
						<label>ستكون هناك غرامة بمقدار:</label>
                        <span class="form-text" id="suspendStudentPenalty"></span>
					</div>
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

<div class="modal fade" id="leaveStudentsModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">اجازة</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="leaveStudentsForm">
				<div class="kt-portlet__body">

                    <div class="text-danger" id="Leave_err"></div>
					<div class="form-group">
  				      <label>الفترة الزمنية :</label>
                      <div class="input-daterange input-group" id="kt_datepicker">
            				<input type="date" class="form-control kt-input" name="start" id="start" placeholder="من" data-col-index="5">
            				<div class="input-group-append">
            					<span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
            				</div>
            				<input type="date" class="form-control kt-input" name="end" id="end" placeholder="الى" data-col-index="5">
                      </div>
                      <span id="date_err" class="form-text  text-danger"></span>
                    </div>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="addStudentLeave()" class="btn btn-brand">اضافة</button>
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

<script type="text/javascript" src="js/getBraches.js"></script>
<script type="text/javascript" src="js/getLevels.js"></script>
<script type="text/javascript" src="js/getGroups.js"></script>
<script>
getBraches($("#branch"));
getLevels($("#f_level"));

function suspendStudent(){
  $.ajax({
    url:"script/_suspendStudent.php",
    type:"POST",
    data:{date:$("#suspendStudentDate").val(),student:$("#student_id").val()},
    beforeSend:function(){
     $("#suspendtudentsForm").addClass('loading');
     $("#suspendStudentDate_err").text("");
    },
    success:function(res){
      $("#suspendtudentsForm").removeClass('loading');
      $("#suspendStudentDate_err").text(res.error.date);
      if(res.success == 1){
           Toast.success('تم تأجيل مباشرة الطالب');
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
function updateStudnetid(id){
 $("#student_id").val(id);
}
function addStudentLeave(){
$.ajax({
  url:"script/_addStudentLeave.php",
  type:"POST",
  data:$("#leaveStudentsForm").serialize()+'&id='+ $("#student_id").val(),
  beforeSend:function(){
   $("#Leave_err").html("");
   $("#date_err").html("");
  },
  success:function(res){
   console.log(res);
   if(res.success == 1){
      Toast.success('تم الاضافة');
      $("#date_err").html("");
      $("#start").val("yyyy/mm/dd");
      $("#end").val("yyyy/mm/dd");

      getLeave();
   }else{
     Toast.warning(res.msg);
      $("#date_err").html(res.error.start +" <b>...</b> "+res.error.end)
   }
  },
   error:function(e){
    console.log(e);
    Toast.error('خطأ');
  }
});
}

</script>