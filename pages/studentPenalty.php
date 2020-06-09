
<!-- end:: Subheader -->
					<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h1 class="">
				غرامات الطلاب
			</h1>
		</div>
	</div>

	<div class="kt-portlet__body">
     <form id="filtterPenaltysForm">
		<!--begin: Datatable -->
          <fieldset><legend>البحث عن غرامات طالب</legend>
          <div class="row kt-margin-b-20">
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>الفرع:</label>
            	<select onchange="getPenaltys()" class="form-control kt-input" id="branch" name="branch" data-col-index="6">
            	</select>
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>المستوى:</label>
            	<select onchange="getPenaltys()" data-show-subtext="true" data-live-search="true"  class="selectpicker form-control kt-input" id="level" name="level" data-col-index="7">
            		<option value="">Select</option>
            	</select>
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>حالة الغرامة:</label>
            	<select onchange="getPenaltys()" class="selectpicker form-control kt-input" id="money_status" name="money_status" data-col-index="7">
            		<option value="">-- الكل --</option>
            		<option value="99">غير مستلمة</option>
            		<option value="1">الغير مؤكدة</option>
            		<option value="2">المؤكده</option>
            	</select>
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>رقم الطالب:</label>
            	<input id="student_number" name="student_number" onkeyup="getPenaltys()" type="text" class="form-control kt-input" placeholder="" data-col-index="0">
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>اسم الطالب:</label>
            	<input name="name" onkeyup="getPenaltys()" type="text" class="form-control kt-input" placeholder="" data-col-index="1">
            </div>
          <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
          </div>
          </fieldset>
          <div class="row kt-margin-b-20">
            <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
              	<label>عدد السجلات في الصفحة الواحدة</label>
              	<select onchange="getPenaltys()" class="form-control kt-input" name="limit" data-col-index="7">
              		<option value="10">10</option>
              		<option value="15">15</option>
              		<option value="20">20</option>
              		<option value="25">25</option>
              		<option value="30">30</option>
              		<option value="50">50</option>
              	</select>
              </div>
            </div>
		<table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tb-Penalty">
			       <thead>
	  						<tr>
								<th>الفرع</th>
                                <th>رقم الطالب</th>
								<th>الاسم</th>
								<th>الملاحظات</th>
                                <th>الحالة</th>
								<th>تاريخ تسديد القسط</th>
								<th>المبلغ</th>
								<th>تعديل</th>
							</tr>
      	            </thead>
                            <tbody id="PenaltyesTable">
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
function getPenaltys(){
$.ajax({
  url:"script/_getPenalties.php",
  type:"POST",
  data:$("#filtterPenaltysForm").serialize(),
  beforeSend:function(){
    $("#pagination").html("");
    $("#tb-Penalty").addClass('loading');
  },
  success:function(res){
    $("#tb-Penalty").removeClass('loading');
   console.log(res);
   $("#tb-Penalty").DataTable().destroy();
   $("#PenaltyesTable").html("");
   $("#PenaltyesTable").html("");
      if(res.pages >= 1){
     if(res.page > 1){
         $("#pagination").append(
          '<li class="page-item"><a href="#" onclick="getPenaltysPage('+(Number(res.page)-1)+')" class="page-link">السابق</a></li>'
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
          '<li class="page-item"><a href="#" onclick="getPenaltysPage('+(i)+')"  class="page-link">'+i+'</a></li>'
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
          '<li class="page-item"><a href="#" onclick="getPenaltysPage('+(Number(res.page)+1)+')" class="page-link">التالي</a></li>'
         );
     }else{
         $("#pagination").append(
          '<li class="page-item disabled"><a href="#" class="page-link">التالي</a></li>'
         );
     }
   }
   $.each(res.data,function(){
     if(this.conf == 1 ){
       status = "غير مؤكد";
       color = "text-warning";

     }else if(this.conf == 2){
       status = "مؤكد";
       color = "text-success";
     }else{
       status = "غير مستلم";
       color = "text-info";

     }

     if(res.role == 2){
       button = '<td class ="text-waring">'+
                 '<button type="button" class="btn btn-link btn-waring" data-toggle="tooltip"  title="تاكيد استلام الغرامة" onclick="confirmPenalty('+this.id+',\''+this.name+'\')"  ><span class="fa fa-check-square"></sapn> تأكيد</button>'+
                '</td>';
     }else if(res.role ==4){
       button = '<td>'+
                 '<button type="button" class="btn btn-link  text-info" data-toggle="tooltip"  title="الغأ الغرامة" onclick="confirmPenalty('+this.pay_id+',\''+this.name+'\')"  ><span class="fa fa-check-square"></sapn> تم الاستلام</button>'+
                '</td>';
     }else if(res.role == 3){
       button = '<td>'+
                 '<button type="button" class="btn btn-link  text-danger" data-toggle="tooltip"  title="تاكيد استلام الغرامة" onclick="deletePenalty('+this.pay_id+',\''+this.name+'\')"  ><span class="fa fa-trash"></sapn>الغأ الغرامة</button>'+
                '</td>';
     }else{
       button = '<td>'+
                ''+
                '</td>';
     }
     $("#PenaltyesTable").append(
       '<tr>'+
            '<td>'+this.branch_name+'</td>'+
            '<td width="200px">'+this.student_number+'</td>'+
            '<td>'+this.name+'</td>'+
            '<td>'+this.note+'</td>'+
            '<td class="'+color+'">'+status+'</td>'+
            '<td>'+this.date+'</td>'+
            '<td>$'+this.amount+'</td>'+
            button+

       '</tr>');
     });
     $("#tb-Penalty").DataTable().destroy();
     var myTable= $('#tb-Penalty').DataTable({
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
       "bPaginate": false,
       "bLengthChange": false,
       "bFilter": false,
       serverPaging: true
});
    },
   error:function(e){
     $("#tb-Penalty").removeClass('loading');
    console.log(e);
  }
});
}
function confirmPenalty(id,studentName){
  if(confirm("هل متاكد من تاكيد الغرامة للطالب - "+studentName+"")){
      $.ajax({
        url:"script/_confirmPenalty.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success(res.msg);
           getPenaltys();
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
function deletePenalty(id,studentName){
  if(confirm("هل متاكد من حذف  الغرامة للطالب - "+studentName+"")){
      $.ajax({
        url:"script/_deletePenalty.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success(res.msg);
           getPenaltys();
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
function getPenaltysPage(page){
    $("#p").val(page);
    getPenaltys();
}
</script>
<script type="text/javascript" src="js/getBraches.js"></script>
<script type="text/javascript" src="js/getLevels.js"></script>
<script type="text/javascript" src="js/getGroups.js"></script>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
  getBraches($("#branch"));
  getLevels($("#level"));
  getPenaltys();
})

</script>