<style type="text/css">
 .incomeCell {
   display: block;
   width: 100px;
 }
 #balanceDIV {
   height: 250px;
 }

</style>
<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<!--begin::Dashboard 1-->
<!--begin::Row-->
<div class="row">
	<div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
		<!--begin::Portlet-->
<div class="kt-portlet kt-portlet--height-fluid" id="StudentsNodiv">
	<div class="kt-portlet__head kt-portlet__head--noborder">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">عدد الطلاب الكلي</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-toolbar-wrapper">

			</div>
		</div>
	</div>
	<div class="kt-portlet__body kt-portlet__body--fluid">
		<div class="kt-widget-19">
			<div class="kt-widget-19__title">
				<div class="kt-widget-19__label"><span id="StudentNo"></span><small>طالب </small></div>
				<img class="kt-widget-19__bg" src="./assets/media/misc/iconbox_bg.png" alt="bg">
			</div>
			<div class="kt-widget-19__data">
				<!--Doc: For the chart bars you can use state helper classes: kt-bg-success, kt-bg-info, kt-bg-danger. Refer: components/custom/colors.html -->
				<div class="kt-widget-19__chart">
					<div class="kt-widget-19__bar"><div class="kt-widget-19__bar-45" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="500"></div></div>
					<div class="kt-widget-19__bar"><div class="kt-widget-19__bar-95" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="95"></div></div>
					<div class="kt-widget-19__bar"><div class="kt-widget-19__bar-63" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="63"></div></div>
					<div class="kt-widget-19__bar"><div class="kt-widget-19__bar-11" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="11"></div></div>
					<div class="kt-widget-19__bar"><div class="kt-widget-19__bar-46" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="46"></div></div>
					<div class="kt-widget-19__bar"><div class="kt-widget-19__bar-88" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="120"></div></div>
					<div class="kt-widget-19__bar"><div class="kt-widget-19__bar-44" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="88"></div></div>
					<div class="kt-widget-19__bar"><div class="kt-widget-19__bar-12" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="200"></div></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--end::Portlet-->	</div>
	<div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
		<!--begin::Portlet-->
<div class="kt-portlet kt-portlet--height-fluid">
	<div class="kt-portlet__head  kt-portlet__head--noborder">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">المبالغ الواردة</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-toolbar-wrapper">
			</div>
		</div>
	</div>
	<div class="kt-portlet__body kt-portlet__body--fluid">
		<div class="kt-widget-21">
			<div class="kt-widget-21__title">
				<div class="kt-widget-21__label"><span id="balance"></span></div>
				<img src="./assets/media/misc/iconbox_bg.png" class="kt-widget-21__bg" alt="bg">
			</div>
			<div class="kt-widget-21__data">
				<!--Doc: For the chart legend bullet colors can be changed with state helper classes: kt-bg-success, kt-bg-info, kt-bg-danger. Refer: components/custom/colors.html -->
				<div class="kt-widget-21__legends">
					<div class="kt-widget-21__legend">
						<i class="kt-bg-brand"></i>
						<span class="incomeCell">مستلمة</span>
						<span id="recived"></span>
					</div>
					<div class="kt-widget-21__legend">
						<i class="kt-shape-bg-color-4"></i>
						<span class="incomeCell">غير مؤكدة</span>
						<span id="notconfirmed"></span>
					</div>
					<div class="kt-widget-21__legend">
						<i class="kt-shape-bg-color-3"></i>
						<span class="incomeCell">غير مستلمة</span>
						<span id="notrecived"></span>
					</div>
				</div>
				<div class="kt-widget-21__chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
					<div class="kt-widget-21__stat">$</div>
					<!--Doc: For the chart initialization refer to "widgetTechnologiesChart" function in "src\theme\app\scripts\custom\dashboard.js" -->
					<canvas id="incomeChart" style="height: 100px; width: 100px; display: block;" width="125" height="125" class="chartjs-render-monitor"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>
<!--end::Portlet-->	</div>
	<div class="col-lg-6 col-xl-12 order-lg-1 order-xl-1">
		<!--begin::Portlet-->
<div class="kt-portlet kt-portlet--height-fluid">
	<div class="kt-portlet__head  kt-portlet__head--noborder">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">الفرق بين المبالغ الواردة والخارجة بشكل يومي</h3>
		</div>
		<div class="kt-portlet__head-toolbar">

		</div>
	</div>
	<div class="kt-portlet__body" id="balanceDIV">
       <canvas id="balance_chart"></canvas>
	</div>
</div>
<!--end::Portlet-->	</div>
</div>
<!--end::Row-->

<!--begin::Row-->
<div class="row">
	<div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
		<!--begin::Portlet-->
<div class="kt-portlet kt-portlet--height-fluid">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">الطلبة الجدد</h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-toolbar-wrapper">

</div>        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="kt-widget-1">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="newstudentsdiv" role="tabpanel">

                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Portlet-->
</div>
	<div class="col-lg-12 col-xl-8 order-lg-2 order-xl-1">

		<!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--height-fluid"> <br /><br />
           <div class="col-lg-12">
           <canvas id="branches_chart"></canvas>
           </div>
        </div>
        <!--end::Portlet-->
	 </div>
</div>
<!--end::Row-->
<!--end::Dashboard 1-->	</div>
<!-- end:: Content -->
<script src="js/charts.js"></script>
<script>
function getNewStudent(){

  $.ajax({
    url:"charts/_getNewStudents.php",
    type:"POST",
    beforeSend:function(){
      $("#newstudentsdiv").addClass("loading");
    },
    success:function(res){
      console.log(res);
      $("#newstudentsdiv").removeClass("loading");
      $.each(res.data,function(){
         $("#newstudentsdiv").append(
         '<div class="row" >'+
           '<div class="col-sm-2" ><img class="user-img" src="img/student/'+this.img+'" /></div>'+
           '<div class="col-sm-10">'+
                            '<label>'+
                               this.student_number+
                            '</label>'+
                            '<div class="kt-widget-1__item-desc">'+this.name+'&amp;'+this.phone+'</div>'+
          '</div>'+
          '</div>'+
          '<div class="row" ><hr></div>'
         )
      });
    },
    error:function(e){
      $("#newstudentsdiv").removeClass("loading");
      console.log(e);
    }
  });
}

getNewStudent();

function getStudentsCount(){

  $.ajax({
    url:"charts/_getStudentsCount.php",
    type:"POST",
    beforeSend:function(){
      $("#StudentsNodiv").addClass("loading");
    },
    success:function(res){
      console.log(res);
      $("#StudentsNodiv").removeClass("loading");
      $("#StudentNo").text(res.count);
    },
    error:function(e){
      $("#StudentsNodiv").removeClass("loading");
      console.log(e);
    }
  });
}

getStudentsCount();

function getIncomeCount(){

  $.ajax({
    url:"charts/_getIncomeCount.php",
    type:"POST",
    beforeSend:function(){
      $("#StudentsNodiv").addClass("loading");
    },
    success:function(res){
      console.log(res);
      $("#StudentsNodiv").removeClass("loading");
      $.each(res.data,function(){
          $("#notconfirmed").text("  $"+this.notconfirmed);
          $("#notrecived").text("  $"+this.notrecived);
          $("#recived").text("  $"+this.confirmed);
      });
    },
    error:function(e){
      $("#StudentsNodiv").removeClass("loading");
      console.log(e);
    }
  });
}
getIncomeCount();
function getBalance(){

  $.ajax({
    url:"charts/_getBalance.php",
    type:"POST",
    beforeSend:function(){
      $("#balanceDIV").addClass("loading");
    },
    success:function(res){
      console.log(res);
      $("#balanceDIV").removeClass("loading");
      $.each(res.data,function(){
          $("#totalbalance").text("  $"+this.balance);
          $("#balance").text("  $"+this.balance);
      });
    },
    error:function(e){
      $("#balanceDIV").removeClass("loading");
      console.log(e);
    }
  });
}
getBalance();

function branchesChart(){
  i = 0
  var students =[],date=[],days=[];
  $.ajax({
    url:"charts/_branchesChart.php",
    type:'POST',
    beforeSend:function(){
      $("#branches_chart").addClass("loading");
    },
    success:function(res){
      $("#branches_chart").removeClass("loading");
      console.log(res);
      $.each(res.data,function(){
        students[i] = this.stu;
        date[i] = this.date;
        days[i] = i;
        i++;
      });
      var ctx = document.getElementById('branches_chart').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              datasets: [{
                  label: 'عدد الطلاب',
                  data: students,
                  backgroundColor: 'rgb(115, 222, 10,0.0)',
                  type: 'line',
                  borderColor:  'rgb(105, 202, 10,0.9)',
                  borderWidth:5,hitRadius:5,hoverRadius:5,
                  borderWidth:5,
              }],
              labels: date,
          },
          options: {
              scales: {
                  yAxes: [{
                    scaleLabel: {
                      display: true,
                      labelString: 'عدد الطلاب',
                    },
                    ticks: {
                        beginAtZero: true
                    }
                  }],
                  xAxes: [{
                    scaleLabel: {
                      display: true,
                      labelString: 'التاريخ'
                    }
                  }],
              }
          }
      });
    },
    error:function(e){
     $("#branches_chart").removeClass("loading");
     console.log(e);
    }
  });

}
branchesChart();
function balanceChart(){
  i = 0
  var balance =[],date=[],days=[];
  $.ajax({
    url:"charts/_balanceChart.php",
    type:'POST',
    beforeSend:function(){
      $("#balance_chart").addClass("loading");
    },
    success:function(res){
      $("#balance_chart").removeClass("loading");
      console.log(res);
      $.each(res.data,function(){
        balance[i] = this.balance;
        date[i] = this.date;
        days[i] = i;
        i++;
      });
      var ctx = document.getElementById('balance_chart').getContext('2d');

      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              datasets: [{
                  label: '$',
                  data: balance,
                  backgroundColor: 'rgb(115, 02, 10,0.3)',
                  type: 'line',
                  borderColor:  'rgb(105, 02, 10,0.9)',
                  borderWidth:3,hitRadius:5,hoverRadius:5,
                  borderWidth:3,
              }],
              labels: date,
          },
          options: {
             responsive: true,
              maintainAspectRatio: false,
              scales: {
                        xAxes: [{
                            gridLines: {
                                color: "rgba(22, 22, 22, 0.1)",
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                color: "rgba(22,22, 22, 0.3)",
                            }
                        }]
              }
          }
      });
    },
    error:function(e){
     $("#balance_chart").removeClass("loading");
     console.log(e);
    }
  });

}
balanceChart();
</script>