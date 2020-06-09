<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="top">
                    <span>اضافة مستوى</span>
                    <a data-toggle="modal" data-target="#addLevelModal" class="btn btn-icon btn btn-label btn-label-brand btn-bold" data-toggle="dropdown" data-offset="0px,0px" aria-haspopup="true" aria-expanded="false">
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
		<table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tb-level">
			       <thead>
	  						<tr>
								<th>ID</th>
								<th>اسم المستوى</th>
								<th>السعر</th>
								<th>ملاحظات</th>
								<th>التاريخ</th>
								<th>تعديل</th>
							</tr>
      	            </thead>
                            <tbody id="levelesTable">
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
function getlevels(){
$.ajax({
  url:"script/_getLeveles.php",
  type:"POST",
  success:function(res){
   console.log(res);
   $("#tb-level").DataTable().destroy();
   $("#levelesTable").html("");
   $.each(res.data,function(){
     $("#levelesTable").append(
       '<tr>'+
            '<td>'+this.id+'</td>'+
            '<td>'+this.name+'</td>'+
            '<td>$'+this.price+'</td>'+
            '<td>'+this.note+'</td>'+
            '<td>'+this.date+'</td>'+
            '<td><button class="btn btn-link btn-clean" onclick="editLevel('+this.id+')" data-toggle="modal" data-target="#editLevelModal"><span class="flaticon-edit"></sapn></button>'+
            '<button class="btn btn-link btn-clean text-danger" onclick="deleteLevel('+this.id+')" data-toggle="modal" data-target="#deleteLevelModal"><span class="flaticon-delete"></sapn></button></td>'+

       '</tr>');
     });
     $("#tb-level").DataTable().destroy();
     var myTable= $('#tb-level').DataTable({
     columns:[
    //"dummy" configuration
        { visible: true }, //col 1
        { visible: true }, //col 2
        { visible: true }, //col 3
        { visible: true }, //col 4
        { visible: true }, //col 5
        { visible: true }, //col 6
        ]
});
    },
   error:function(e){
    console.log(e);
  }
});
}
getlevels();

</script>
<div class="modal fade" id="addLevelModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">اضافة فرع</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="addLevelForm">
				<div class="kt-portlet__body">
					<div class="form-group">
						<label>الاسم:</label>
						<input type="name" name="level_name" class="form-control"  placeholder="ادخل الاسم الكامل">
						<span class="form-text  text-danger" id="level_name_err"></span>
					</div>
					<div class="form-group">
						<label>السعر:</label>
						<input type="text" name="level_price" class="form-control" placeholder="">
						<span class="form-text text-danger" id="level_price_err"></span>
					</div>
					<div class="form-group">
						<label>ملاحظات:</label>
						<textarea  class="form-control"  name="level_note"></textarea>
						<span id="level_note_err" class="form-text  text-danger"></span>
					</div>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="addLevel()" class="btn btn-brand">اضافة</button>
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

<div class="modal fade" id="editLevelModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">تعديل معلومات الفرع</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="editLevelForm">
				<div class="kt-portlet__body">
					<div class="form-group">
						<label>اسم المستوى:</label>
						<input type="name" id="e_level_name" name="e_level_name" class="form-control"  placeholder="ادخل الاسم الكامل">
						<span class="form-text  text-danger" id="e_level_name_err"></span>
					</div>
					<div class="form-group">
						<label>السعر:</label>
						<input type="text"  id="e_level_price" name="e_level_price" class="form-control" placeholder="">
						<span class="form-text text-danger" id="level_price_err"></span>
					</div>
					<div class="form-group">
						<label>ملاحظات:</label>
						<textarea  class="form-control" id="e_level_note"  name="e_level_note"></textarea>
						<span id="e_level_note_err" class="form-text  text-danger"></span>
					</div>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="updateLevel()" class="btn btn-brand">حفظ التغيرات</button>
						<button type="reset" data-dismiss="modal" class="btn btn-secondary">الغاء</button>
					</div>
				</div>
                <input type="hidden" name="e_level_id" id="editlevelid"/>
			</form>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->
        </div>
      </div>

    </div>
  </div>

<script>
function addLevel(){
  $.ajax({
    url:"script/_addLevel.php",
    type:"POST",
    data:$("#addLevelForm").serialize(),
    beforeSend:function(){

    },
    success:function(res){
       if(res.success == 1){
         $("#kt_form input").val("");
         Toast.success('تم الاضافة');
         getlevels();
       }else{
           $("#level_name_err").text(res.error["name"]);
           $("#level_note_err").text(res.error["note"]);
           $("#level_price_err").text(res.error["price"]);
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
function editLevel(id){
  $("#editlevelid").val(id);
  $.ajax({
    url:"script/_getLevel.php",
    data:{id: id},
    success:function(res){
      if(res.success == 1){
        $.each(res.data,function(){
          $('#e_level_name').val(this.name);
          $('#e_level_email').val(this.email);
          $('#e_level_phone').val(this.phone);
          $('#e_level_price').val(this.price);
          $('#e_level_note').val(this.note);
        });
      }
      console.log(res);
    },
    error:function(e){
      console.log(e);
    }
  });
}
function updateLevel(){
    $.ajax({
       url:"script/_updateLevel.php",
       type:"POST",
       data:$("#editLevelForm").serialize(),
       beforeSend:function(){

       },
       success:function(res){
       if(res.success == 1){
         $("#kt_form input").val("");
          Toast.success('تم التحديث');
          getlevels();
       }else{
           $("#e_level_name_err").text(res.error["name"]);
           $("#e_level_email_err").text(res.error["email"]);
           $("#e_level_phone_err").text(res.error["phone"]);
           $("#e_level_note_err").text(res.error["note"]);
           $("#e_level_price_err").text(res.error["price"]);
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
function deleteLevel(id){
  if(confirm("هل انت متاكد من الحذف")){
      $.ajax({
        url:"script/_deleteLevel.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم الحذف');
           getlevels($("#levelesTable"));
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