<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				اعداد الطلاب التفصيلية
			</h3>
		</div>
	</div>

	<div class="kt-portlet__body">
        <fieldset>
        <legend>فلتر</legend>
          <div class="row kt-margin-b-20">
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
		<table class="table table-striped table-bordered table-hover table-checkable responsive no-wrap" id="tb-branch">
			       <thead>
	  						<tr>
								<th>اسم الفرع</th>
								<th>عدد الطلاب الكلي</th>
								<th>المبلغ المستلمة</th>
								<th>المبلغ الغير مؤكدة</th>
								<th>المبالغ الغير مستلمة</th>
							</tr>
      	            </thead>
                            <tbody id="branchesTable">
                            </tbody>
		</table>
		<!--end: Datatable -->
	</div>
</div>
	<div class="col-lg-12 col-xl-12 order-lg-12 order-xl-1">
		<!--begin::Portlet-->
        <div class="col-lg-12  kt-portlet kt-portlet--height-fluid"> <br /><br />
         <canvas id="branches_chart"></canvas>
        </div>
        <!--end::Portlet-->
	 </div>
</div>
<!-- end:: Content -->


<!--begin::Page Vendors(used by this page) -->
<script src="assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->



<!--begin::Page Scripts(used by this page) -->
<script src="assets/js/demo1/pages/components/datatables/extensions/responsive.js" type="text/javascript"></script>
<script type="text/javascript">
function getbraches(){
$.ajax({
  url:"charts/_getBranchesCount.php",
  type:"POST",
  success:function(res){
   console.log(res);
   $("#tb-branch").DataTable().destroy();
   $("#branchesTable").html("");
   branches_chart(res);
   $.each(res.data,function(){
     $("#branchesTable").append(
       '<tr>'+
            '<td>'+this.branch_name+'</td>'+
            '<td>'+this.count+'</td>'+
            '<td>'+this.confirmed+'</td>'+
            '<td>'+this.notconfirmed+'</td>'+
            '<td>'+this.notrecived+'</td>'+

       '</tr>');
     });
     $("#tb-branch").DataTable().destroy();
     var myTable= $('#tb-branch').DataTable({
     columns:[
    //"dummy" configuration
        { visible: true }, //col 1
        { visible: true }, //col 2
        { visible: true }, //col 3
        { visible: true }, //col 4
        { visible: true }, //col 5
        ]
});
    },
   error:function(e){
    console.log(e);
  }
});
}
getbraches();
function branches_chart(res){
      $("#branches_chart").removeClass("loading");
      console.log(res);
      content =[];
      color =[
       'rgb(255, 109, 142,0.5)',
       'rgb(44, 209, 100,0.5)',
       'rgb(20, 119, 212,0.5)',
       'rgb(5, 129, 255,0.5)',
       'rgb(100, 12, 155,0.5)',
       'rgb(255, 109, 142,0.5)',
       'rgb(205, 139, 112,0.5)',
       'rgb(55, 129, 122,0.5)',
       'rgb(255, 119, 132,0.5)',
      ];
      i =0;
      $.each(res.data, function(){
        console.log();
        content[i] = {
          label:this.branch_name+' ( '+this.count+' ) ',
          data: [this.confirmed,this.notconfirmed,this.notrecived],
          backgroundColor: 'rgb(115, 222, 10,0.0)',
          borderColor:  color[i],
          pointLabels: {
                    fontSize: 25
          },
          steppedline:true,

          };
        i++;
      });
      mydata = {
        labels: [ "المبالغ المؤكدة", "المبالغ غير المؤكدة", "المبالغ غير المستلمة"],
        datasets:content,
        options: {
          scale: {
            pointLabels: {
              fontSize: 20
            }
          },
          scales: {
                  yAxes: [{
                    scaleLabel: {
                      display: true,
                      labelString: 'المبلغ',
                    },
                    ticks: {
                        beginAtZero: true
                    }
                  }],
          }
        }
      }
      console.log(content);
      var ctx = document.getElementById('branches_chart').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'line',
          data: mydata,

      });

}

</script>