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

          <fieldset><legend>فلتر</legend>
          <div class="row kt-margin-b-20">
            <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
            	<label>الرقم التسلسلي للطالب:</label>
            	<input type="text" class="form-control" id="student_number" name="students_number" />
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>بحث:</label><br />
            	<input type="button" onclick="getStudentLeave()" value="بحث" class="btn btn-success"  />
            </div>
            <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
            	<label id="">اسم الطالب</label><br />
            	<label id="s_name"></label>
            </div>
          </div>
          </fieldset>
		<table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tb-Leave">
			       <thead>
	  						<tr>
								<th>تاريخ البداية</th>
								<th>تاريخ النهاية</th>
								<th>الملاحظات</th>
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

<!--begin::Page Vendors(used by this page) -->
<script src="assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->



<!--begin::Page Scripts(used by this page) -->
<script src="assets/js/demo1/pages/components/datatables/extensions/responsive.js" type="text/javascript"></script>
<script type="text/javascript">

function getStudentLeave(){
$.ajax({
  url:"script/_getStudentLeave.php",
  type:"POST",
  data:{id:$('#student_number').val()},
  beforeSend:function(){
    $("#pagination").html("");
  },
  success:function(res){
   console.log(res);
   $("#tb-Leave").DataTable().destroy();
   $("#LeaveTable").html("");
   if(res.data['0'].name != ""){
    $("#s_name").text(res.data['0'].name);
   }else{
    $("#s_name").text('لايوجد اجازات');
   }
   $.each(res.data,function(){
     btns="<td></td>";
     if(res.role == 4){
        btns =   '<td>'+
                   '<button type="button" class="btn btn-link btn-clean text-danger" onclick="deleteStudentLeave('+this.l_id+')" data-toggle="modal" data-target="#deleteLeaveModal"><span class="flaticon-delete"></sapn></button>'+
                 '</td>';
     }
     $("#LeaveTable").append(
       '<tr>'+
            '<td>'+this.start_date+'</td>'+
            '<td>'+this.end_date+'</td>'+
            '<td>'+this.note+'</td>'+
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
        ],

});
    },
   error:function(e){
    console.log(e);
  }
});
}


</script>
<script>


function deleteStudentLeave(id){
  if(confirm("هل انت متاكد من الحذف, لن يتم حذف الغرامة")){
      $.ajax({
        url:"script/_deleteStudntsLeave.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success(res.msg);
           getStudentLeave();
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