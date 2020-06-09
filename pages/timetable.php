<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="top">
                    <span>اضافة محاضرة</span>
                    <a data-toggle="modal" data-target="#addTimetableModal" class="btn btn-icon btn btn-label btn-label-brand btn-bold" data-toggle="dropdown" data-offset="0px,0px" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon2-add-1"></i>

                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: Subheader -->
					<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				فروع الشركة
			</h3>
		</div>
	</div>

	<div class="kt-portlet__body">
		<!--begin: Datatable -->
		<table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tb-Timetable">
			       <thead>
	  						<tr>
								<th>ID</th>
								<th>اسم المجموعة</th>
								<th>اسم الدرس</th>
								<th>الاستاذ</th>
								<th>اليوم</th>
								<th>وقت البداية</th>
								<th>وقت النهاية</th>
								<th>تعديل</th>
							</tr>
      	            </thead>
                            <tbody id="TimetableTable">
                            </tbody>
		</table>
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
function gettimetable(){
$.ajax({
  url:"script/_getTimetable.php",
  type:"POST",
  success:function(res){
   console.log(res);
   $("#tb-Timetable").DataTable().destroy();
   $("#TimetableTable").html("");
   days = ['الاحد','الاثنين','الثلاثاء','الاربعاء','الخميس','الجمعة','السبت'];
   $.each(res.data,function(){
     $("#TimetableTable").append(
       '<tr>'+
            '<td>'+this.id+'</td>'+
            '<td>'+this.group_name+'</td>'+
            '<td>'+this.name+'</td>'+
            '<td>'+this.teacher_name+'</td>'+
            '<td>'+days[Number(this.day) - 1]+'</td>'+
            '<td>'+this.start+'</td>'+
            '<td>'+this.end+'</td>'+
            '<td><button class="btn btn-link btn-clean" onclick="editTimetable('+this.id+')" data-toggle="modal" data-target="#editTimetableModal"><span class="flaticon-edit"></sapn></button>'+
            '<button class="btn btn-link btn-clean text-danger" onclick="deleteTimetable('+this.id+')" data-toggle="modal" data-target="#deleteTimetableModal"><span class="flaticon-delete"></sapn></button></td>'+

       '</tr>');
     });
     $("#tb-Timetable").DataTable().destroy();
     var myTable= $('#tb-Timetable').DataTable({
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
        ]
});
    },
   error:function(e){
    console.log(e);
  }
});
}
gettimetable();

</script>
<div class="modal fade" id="addTimetableModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">اضافة محاضرة</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="addTimetableForm">
				<div class="kt-portlet__body">
					<div class="form-group">
						<label>اسم المحاضرة:</label>
						<input type="name" name="lecture" class="form-control"  placeholder="ادخل اسم المحاضرة">
						<span class="form-text  text-danger" id="lecture_err"></span>
					</div>
					<div class="form-group">
						<label>المجموعة:</label>
						<select id="group" name="group" class="selectpicker form-control"></select>
                        <span class="form-text text-danger" id="group_err"></span>
					</div>
					<div class="form-group">
						<label>الاستاذ:</label>
						<select id="teacher" name="teacher" class="form-control"></select>
                        <span class="form-text text-danger" id="teacher_err"></span>
					</div>
					<div class="form-group">
						<label>اليوم:</label>
						<select id="day" name="day" class="selectpicker form-control">
                            <option value="">-- اختر اليوم --</option>
                            <option value="1">الاحد</option>
                            <option value="2">الاثنين</option>
                            <option value="3">الثلاثاء</option>
                            <option value="4">الاربعاء</option>
                            <option value="5">الخميس</option>
                            <option value="6">الجمعة</option>
                            <option value="7">السبت</option>
                        </select>
                        <span class="form-text text-danger" id="day_err"></span>
					</div>
					<div class="form-group">
						<label>وقت البداية:</label>
						<input type="time"  name="start_time" class="form-control" placeholder="ادخل رقم الهاتف">
						<span id="start_time_err" class="form-text  text-danger"></span>
					</div>
					<div class="form-group">
						<label>وقت النهاية:</label>
						<input type="time" name="end_time" class="form-control" placeholder="ادخل رقم الهاتف">
						<span id="end_time_err" class="form-text  text-danger"></span>
					</div>
                    <span id="time_err" class="form-text  text-danger"></span>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="addTimetable()" class="btn btn-brand">اضافة</button>
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

<div class="modal fade" id="editTimetableModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">تعديل معلومات الجدول الاسبوعي</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="editTimetableForm">
								<div class="kt-portlet__body">
					<div class="form-group">
						<label>اسم المحاضرة:</label>
						<input type="name" id="e_lecture" name="e_lecture" class="form-control"  placeholder="ادخل اسم المحاضرة">
						<span class="form-text  text-danger" id="lecture_err"></span>
					</div>
					<div class="form-group">
						<label>المجموعة:</label>
						<select id="e_group" name="e_group" class=" form-control"></select>
                        <span class="form-text text-danger" id="group_err"></span>
					</div>
					<div class="form-group">
						<label>الاستاذ:</label>
						<select id="e_teacher" name="e_teacher" class="selectpicker form-control"></select>
                        <span class="form-text text-danger" id="teacher_err"></span>
					</div>
					<div class="form-group">
						<label>اليوم:</label>
						<select id="e_day" name="e_day" class="form-control">
                            <option value="">-- اختر اليوم --</option>
                            <option value="1">الاحد</option>
                            <option value="2">الاثنين</option>
                            <option value="3">الثلاثاء</option>
                            <option value="4">الاربعاء</option>
                            <option value="5">الخميس</option>
                            <option value="6">الجمعة</option>
                            <option value="7">السبت</option>
                        </select>
                        <span class="form-text text-danger" id="day_err"></span>
					</div>
					<div class="form-group">
						<label>وقت البداية:</label>
						<input type="time"  id="e_start_time" name="e_start_time" class="form-control" placeholder="13:00">
						<span id="e_start_time_err" class="form-text  text-danger"></span>
					</div>
					<div class="form-group">
						<label>وقت النهاية:</label>
						<input type="time" id="e_end_time" name="e_end_time" class="form-control" placeholder="14:00">
						<span id="e_end_time_err" class="form-text  text-danger"></span>
					</div>
                    <span id="e_time_err" class="form-text  text-danger"></span>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="updateTimetable()" class="btn btn-brand">حفظ التغيرات</button>
						<button type="reset" data-dismiss="modal" class="btn btn-secondary">الغاء</button>
					</div>
				</div>
                <input type="hidden" name="e_Timetable_id" id="editTimetableid"/>
			</form>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->
        </div>
      </div>

    </div>
  </div>
<script src="js/getGroups.js" type="text/javascript"></script>
<script src="js/getTeachers.js" type="text/javascript"></script>
<script>
getGroups($("#group"));
getGroups($("#e_group"));
getTeachers($("#teacher"));
getTeachers($("#e_teacher"));
function addTimetable(){
  $.ajax({
    url:"script/_addTimetable.php",
    type:"POST",
    data:$("#addTimetableForm").serialize(),
    beforeSend:function(){
      $(".text-danger").text("");
    },
    success:function(res){
       if(res.success == 1){
         $("#kt_form input").val("");
         Toast.success('تم الاضافة');
         gettimetable();
       }else{
           $("#lecture_err").text(res.error["lecture"]);
           $("#group_err").text(res.error["group"]);
           $("#teacher_err").text(res.error["teacher"]);
           $("#day_err").text(res.error["day"]);
           $("#start_time_err").text(res.error["start"]);
           $("#end_time_err").text(res.error["end"]);
           $("#time_err").text(res.error["time"]);
           Toast.warning("هناك بعض المدخلات غير صالحة",'خطأ');
       }
      console.log(res);
    },
    error:function(e){
     console.log(e);
     Toast.error('خطأ');
    }
  });
}
function editTimetable(id){
  $("#editTimetableid").val(id);
  $.ajax({
    url:"script/_getTimetable1.php",
    data:{id: id},
    success:function(res){
      if(res.success == 1){
        $.each(res.data,function(){
          $('#e_lecture').val(this.name);
          $('#e_teacher').val(this.teacher_id);
          $('#e_group').val(this.group_id);
          $('#e_day').val(this.day);
          $('#e_start_time').val(this.start);
          $('#e_end_time').val(this.end);
        });
      }
      console.log(res);
    },
    error:function(e){
      console.log(e);
    }
  });
}
function updateTimetable(){
    $.ajax({
       url:"script/_updateTimetable.php",
       type:"POST",
       data:$("#editTimetableForm").serialize(),
       beforeSend:function(){

       },
       success:function(res){
       if(res.success == 1){
         $("#kt_form input").val("");
          Toast.success('تم التحديث');
          gettimetable();
       }else{
           $("#e_lecture_err").text(res.error["lecture"]);
           $("#e_group_err").text(res.error["group"]);
           $("#e_teacher_err").text(res.error["teacher"]);
           $("#e_day_err").text(res.error["day"]);
           $("#e_start_time_err").text(res.error["start"]);
           $("#e_end_time_err").text(res.error["end"]);
           $("#e_time_err").text(res.error["time"]);
           Toast.warning("هناك بعض المدخلات غير صالحة",'خطأ');
       }
        console.log(res);
       },
       error:function(e){
        Toast.error('خطأ');
        console.log(e);
       }
    })
}
function deleteTimetable(id){
  if(confirm("هل انت متاكد من الحذف")){
      $.ajax({
        url:"script/_deleteTimetable.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم الحذف');
           gettimetable($("#TimetableTable"));
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
</script>