<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h1 class="">
				الاجازات
			</h1>
		</div>
	</div>

	<div class="kt-portlet__body">
     <form id="filtterLeaveForm">
		<!--begin: Datatable -->
          <?php if($a == 4 || $a == 3){?>
          <div class="row kt-margin-b-20">
            <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
            	<button type="button"data-toggle="modal" data-target="#LeaveModal" class="btn btn-lg btn-success" >اضافة اجازة لموظف</button>
            </div>
            <div class="col-lg-4 kt-margin-b-10-tablet-and-mobile">
             <div class="text-danger" id="Leave_pay_err">

             </div>
            </div>
          </div>
          <?php } ?>
          <fieldset><legend>فلتر</legend>
          <div class="row kt-margin-b-20">
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>الفرع:</label>
            	<select onchange="getLeave()" class="form-control kt-input" id="branch" name="branch" data-col-index="6">
            	</select>
            </div>

            <div class="col-lg-4 kt-margin-b-10-tablet-and-mobile">
            <label>الفترة الزمنية :</label>
            <div class="input-daterange input-group" id="kt_datepicker">
  				<input  onchange="getLeave()" value="<?php echo date("Y-m-d",strtotime(' - 30 day'));?>" type="date" class="form-control kt-input" name="f_start" id="f_start" placeholder="من" data-col-index="5">
  				<div class="input-group-append">
  					<span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
  				</div>
  				<input onchange="getLeave()" value="<?php echo date("Y-m-d",strtotime(' + 90 day'));?>"  type="date" class="form-control kt-input" name="f_end" id="f_end" placeholder="الى" data-col-index="5">
          	</div>
            </div>
          </div>
          </fieldset>
		<table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tb-Leave">
			       <thead>
	  						<tr>
								<th>الفرع</th>
								<th>اسم الموظف</th>
								<th>التاريخ البداية</th>
								<th>تاريخ النهاية</th>
								<th>عدد الايام</th>
								<th>حالة الراتب</th>
								<th>الحالة</th>
								<th>تعديل</th>
							</tr>
      	            </thead>
                            <tbody id="LeaveTable">
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
<?php if($a == 4 || $a == 3){?>
<div class="modal fade" id="LeaveModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header text-right">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">اضافة اجازة لموظف</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="LeaveForm">
				<div class="kt-portlet__body">

                    <div class="text-danger" id="Leave_err"></div>
                    <div class="form-group">
						<label>الموظف:</label>
						<select class="form-control" id="staff" name="staff" data-live-search="true"></select>
						<span class="form-text  text-danger" id="staff_err"></span>
					</div>
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
					<div class="form-group">
						<label>الحالة:</label>
                        <select class="form-control selectpicker" name="salary_status" id="salary_status">
                            <option value="2">بدون راتب</option>
                            <option value="1">براتب</option>
                        </select>
                        <span id="salary_status_err" class="form-text  text-danger"></span>
					</div>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="addLeave()" class="btn btn-brand">اضافة</button>
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

<?php }?>
<!--begin::Page Vendors(used by this page) -->
<script src="assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->



<!--begin::Page Scripts(used by this page) -->
<script src="assets/js/demo1/pages/components/datatables/extensions/responsive.js" type="text/javascript"></script>
<script type="text/javascript">

function getLeave(){
$.ajax({
  url:"script/_getLeave.php",
  type:"POST",
  data:$("#filtterLeaveForm").serialize(),
  beforeSend:function(){
    $("#pagination").html("");
  },
  success:function(res){
   console.log(res);
   $("#tb-Leave").DataTable().destroy();
   $("#LeaveTable").html("");

   $.each(res.data,function(){
     btns="<td></td>";
     if(res.role == 4){
        btns =   '<td>'+
                  '<button type="button" class="btn btn-link btn-clean text-danger" onclick="deleteLeave('+this.id+')" data-toggle="modal" data-target="#deleteLeaveModal"><span class="flaticon-delete"></sapn></button>'+
                 '</td>';
     }else if(res.role == 3 && this.confirm != 1){
        btns =   '<td>'+
                  '<button type="button" class="btn btn-link btn-clean text-info" onclick="confirmLeave('+this.id+')"><span class="fa fa-check"></sapn></button>'+
                 '</td>';
        $("#branch").val(res.branch);
        $("#branch").attr('disabled',true);
     }
     if(res.role != 1 && res.role != 3 && res.role != 2){
        $("#branch").val(res.branch);
        $("#branch").attr('disabled',true);
     }
     if(this.confirm != 1){
       status = "تم تسجيل الاجازة";
     }else{
       status = '<span class="fa fa-check"></sapn>';
     }
     if(this.with_salary != 1){
       salay = "بدون راتب";
     }else{
       salay = "براتب"
     }

     $("#LeaveTable").append(
       '<tr>'+
            '<td>'+this.branch_name+'</td>'+
            '<td>'+this.staff_name+'</td>'+
            '<td>'+this.start_date+'</td>'+
            '<td>'+this.end_date+'</td>'+
            '<td>'+this.days+'</td>'+
            '<td>'+salay+'</td>'+
            '<td>'+status+'</td>'+
            btns+
        '</tr>');
     });
     $("#tb-Leave").DataTable().destroy();
     var myTable= $('#tb-Leave').DataTable({
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
        ],

});
    },
   error:function(e){
    console.log(e);
  }
});
}
getLeave();

</script>
<script type="text/javascript" src="js/getBraches.js"></script>
<script type="text/javascript" src="js/getStaff.js"></script>
<script>
getBraches($("#branch"));
getStaff($("#staff"));
function addLeave(){
$.ajax({
  url:"script/_addLeave.php",
  type:"POST",
  data:$("#LeaveForm").serialize(),
  beforeSend:function(){
   $("#Leave_err").html("");
  },
  success:function(res){
   console.log(res);
   if(res.success == 1){
      Toast.success('تم الاضافة');
      getLeave();
   }else{
     Toast.warning(res.msg);
      $("#staff_err").text(res.error.id)
      $("#date_err").html(res.error.start +" <b>...</b> "+res.error.end)
      $("#salary_status_err").text(res.error.salary_status)
   }
  },
   error:function(e){
    console.log(e);
    Toast.error('خطأ');
  }
});
}

function deleteLeave(id){
  if(confirm("هل انت متاكد من الحذف")){
      $.ajax({
        url:"script/_deleteLeave.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم الحذف');
           getLeave();
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

function confirmLeave(id){
  if(confirm("هل انت متاكد من تاكيد الاجازة")){
      $.ajax({
        url:"script/_confirmLeave.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success(res.msg);
           getLeave();
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