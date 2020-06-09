<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="top">
                    <span>اضافة مجموعة</span>
                    <a data-toggle="modal" data-target="#addGroupModal" class="btn btn-icon btn btn-label btn-label-brand btn-bold" data-toggle="dropdown" data-offset="0px,0px" aria-haspopup="true" aria-expanded="false">
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
		<table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tb-Group">
			       <thead>
	  						<tr>
								<th>اسم المجموعة</th>
								<th>ملاحظات</th>
								<th>التاريخ</th>
								<th>تعديل</th>
							</tr>
      	            </thead>
                            <tbody id="GroupsTable">
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
function getGroups(){
$.ajax({
  url:"script/_getGroups.php",
  type:"POST",
  success:function(res){
   console.log(res);
   $("#tb-Group").DataTable().destroy();
   $("#GroupsTable").html("");
   $.each(res.data,function(){
     $("#GroupsTable").append(
       '<tr>'+
            '<td>'+this.name+'</td>'+
            '<td>'+this.note+'</td>'+
            '<td>'+this.date+'</td>'+
            '<td><button class="btn btn-link btn-clean" onclick="editGroup('+this.id+')" data-toggle="modal" data-target="#editGroupModal"><span class="flaticon-edit"></sapn></button>'+
            '<button class="btn btn-link btn-clean text-danger" onclick="deleteGroup('+this.id+')" data-toggle="modal" data-target="#deleteGroupModal"><span class="flaticon-delete"></sapn></button></td>'+

       '</tr>');
     });
     $("#tb-Group").DataTable().destroy();
     var myTable= $('#tb-Group').DataTable({
     columns:[
    //"dummy" configuration
        { visible: true }, //col 1
        { visible: true }, //col 2
        { visible: true }, //col 3
        { visible: true }, //col 4
        ]
});
    },
   error:function(e){
    console.log(e);
  }
});
}
getGroups();

</script>
<div class="modal fade" id="addGroupModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">اضافة مجموعة</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="addGroupForm">
				<div class="kt-portlet__body">
					<div class="form-group">
						<label>الاسم:</label>
						<input type="name" name="Group_name" class="form-control"  placeholder="ادخل الاسم الكامل">
						<span class="form-text  text-danger" id="Group_name_err"></span>
					</div>
                    <div class="form-group">
						<label>ملاحظات:</label>
						<textarea  class="form-control"  name="Group_note"></textarea>
						<span id="Group_note_err" class="form-text  text-danger"></span>
					</div>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="addGroup()" class="btn btn-brand">اضافة</button>
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

<div class="modal fade" id="editGroupModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">تعديل معلومات المجموعة</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="editGroupForm">
				<div class="kt-portlet__body">
					<div class="form-group">
						<label>اسم المجموعة:</label>
						<input type="name" id="e_Group_name" name="e_Group_name" class="form-control"  placeholder="ادخل الاسم الكامل">
						<span class="form-text  text-danger" id="e_Group_name_err"></span>
					</div>
					<div class="form-group">
						<label>ملاحظات:</label>
						<textarea  class="form-control" id="e_Group_note"  name="e_Group_note"></textarea>
						<span id="e_Group_note_err" class="form-text  text-danger"></span>
					</div>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="updateGroup()" class="btn btn-brand">حفظ التغيرات</button>
						<button type="reset" data-dismiss="modal" class="btn btn-secondary">الغاء</button>
					</div>
				</div>
                <input type="hidden" name="e_Group_id" id="editGroupid"/>
			</form>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->
        </div>
      </div>

    </div>
  </div>

<script>
function addGroup(){
  $.ajax({
    url:"script/_addGroup.php",
    type:"POST",
    data:$("#addGroupForm").serialize(),
    beforeSend:function(){

    },
    success:function(res){
       if(res.success == 1){
         $("#kt_form input").val("");
         Toast.success('تم الاضافة');
         getGroups();
       }else{
           $("#Group_name_err").text(res.error["name"]);
           $("#Group_note_err").text(res.error["note"]);
           $("#Group_branch_err").text(res.error["branch"]);
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
function editGroup(id){
  $("#editGroupid").val(id);
  $.ajax({
    url:"script/_getGroup.php",
    data:{id: id},
    success:function(res){
      if(res.success == 1){
        $.each(res.data,function(){
          $('#e_Group_name').val(this.name);
          $('#e_Group_note').val(this.note);
        });
      }
      console.log(res);
    },
    error:function(e){
      console.log(e);
    }
  });
}
function updateGroup(){
    $.ajax({
       url:"script/_updateGroup.php",
       type:"POST",
       data:$("#editGroupForm").serialize(),
       beforeSend:function(){

       },
       success:function(res){
       if(res.success == 1){
         $("#kt_form input").val("");
          Toast.success('تم التحديث');
          getGroups();
       }else{
           $("#e_Group_name_err").text(res.error["name"]);
           $("#e_Group_email_err").text(res.error["email"]);
           $("#e_Group_phone_err").text(res.error["phone"]);
           $("#e_Group_note_err").text(res.error["note"]);
           $("#e_Group_price_err").text(res.error["price"]);
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
function deleteGroup(id){
  if(confirm("هل انت متاكد من الحذف")){
      $.ajax({
        url:"script/_deleteGroup.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم الحذف');
           getGroups($("#GroupsTable"));
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