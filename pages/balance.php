<style type="text/css">
.success {
  background-color: #E3FDE1;
}
.danger {
  background-color: #FFD5C8;
}
</style>
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				كشف حساب
			</h3>
		</div>
	</div>
    <div class="kt-portlet__body">
         <fieldset><legend>فلتر</legend>
          <div class="row kt-margin-b-20">
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>الفرع:</label>
            	<select onchange="getBalance()" class="form-control kt-input" id="branch" name="branch" data-col-index="6">
                </select>
            </div>

            <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
            <label>الفترة الزمنية :</label>
            <div class="input-daterange input-group" id="kt_datepicker">
  				<input onchange="getBalance()" value="" type="text" class="form-control kt-input" name="start" id="start" placeholder="من" data-col-index="5">
  				<div class="input-group-append">
  					<span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
  				</div>
  				<input onchange="getBalance()" value="" type="text" class="form-control kt-input" name="end" id="end" placeholder="الى" data-col-index="5">
          	</div>
            </div>
          </div>
          </fieldset>
		<!--begin: Datatable -->
		<table class="table table-striped- table-bordered table-hover table-checkable" id="tb_Balances">
    		<thead>
        		<tr>
                  <th>الفرع</th>
                  <th>المبلغ</th>
                  <th>الحسب او الاضافة</th>
                  <th>التاريخ</th>
                  <th>السبب</th>
                  <th>ملاحظات</th>
                </tr>
    		</thead>
            <tbody id="Balances">
            </tbody>
        </table>
		<!--end: Datatable -->
	</div>
</div>

<!--begin::Page Vendors(used by this page) -->
                <script src="./assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
            <!--end::Page Vendors -->



<!--begin::Page Scripts(used by this page) -->
                <script src="./assets/js/demo1/pages/components/datatables/basic/paginations.js" type="text/javascript"></script>
            <!--end::Page Scripts -->
<script type="text/javascript">
function getBalance(){
$.ajax({
  url:"script/_getBalance.php",
  type:"POST",
  beforeSend:function(){
    $("#Balances").addClass('loading');
  },
  success:function(res){
   $("#tb_Balances").DataTable().destroy();
   console.log(res);
   $("#Balances").html("");
   $("#Balances").removeClass('loading');
   $.each(res.data,function(){
     if(this.status != 1){
       status = "<i class=''></i>";
       bg = "danger";
       sign = " - ";
     }else{
       status = "<i class='fa fa-arrow-up'></i>";
       bg = "success";
       sign = " + ";
     }
     $("#Balances").append(
       '<tr class="'+bg+'">'+
            '<td>'+this.branch_name+'</td>'+
            '<td>'+this.balance+'</td>'+
            '<td>'+sign+this.money+" "+ status+' </td>'+
            '<td>'+this.date+'</td>'+
            '<td>'+this.reason+'</td>'+
            '<td>'+this.note+'</td>'+
       '</tr>');
     });
     var myTable= $('#tb_Balances').DataTable({
     columns:[
    //"dummy" configuration
        { visible: true }, //col 1
        { visible: true }, //col 2
        { visible: true }, //col 3
        { visible: true }, //col 4
        { visible: true }, //col 5
        { visible: true }, //col 6
        ],
        className: 'select-checkbox',
        "ordering": false,
        targets: 0,
          "oLanguage": {
          "sLengthMenu": "عرض_MENU_سجل",
          "sSearch": "بحث:" ,
        }
});
    },
   error:function(e){
    $("#Balances").removeClass('loading');
    console.log(e);
  }
});
}
getBalance();




</script>
