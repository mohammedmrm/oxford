<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				النثريات
			</h3>
		</div>
	</div>

	<div class="kt-portlet__body">
     <form id="filtterCashesForm">
		<!--begin: Datatable -->
<?php
if($_SESSION['user_details']['role_id'] == 1){
?>
          <div class="row kt-margin-b-20">
            <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
            	<button type="button"data-toggle="modal" data-target="#payCashModal" class="btn btn-lg btn-success" >صرف نثرية</button>
            </div>
            <div class="col-lg-4 kt-margin-b-10-tablet-and-mobile">
             <div class="text-danger" id="cash_pay_err">

             </div>
            </div>
          </div>
<?php
}
?>
          <fieldset><legend>فلتر</legend>
          <div class="row kt-margin-b-20">
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>الفرع:</label>
            	<select onchange="getCashes()" class="form-control kt-input" id="branch" name="branch" data-col-index="6">
            	</select>
            </div>

            <div class="col-lg-4 kt-margin-b-10-tablet-and-mobile">
            <label>الفترة الزمنية :</label>
            <div class="input-daterange input-group" id="kt_datepicker">
  				<input  onchange="getCashes()" value="<?php echo date("Y-m-d",strtotime(' - 30 day'));?>" type="date" class="datepicker form-control kt-input" name="start" id="start" placeholder="من" data-col-index="5">
  				<div class="input-group-append">
  					<span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
  				</div>
  				<input onchange="getCashes()" value="<?php echo date("Y-m-d",strtotime(' + 1 day'));?>"  type="date" class="datepicker form-control kt-input" name="end" id="end" placeholder="الى" data-col-index="5">
          	</div>
            </div>
          </div>
          </fieldset>
		<table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tb-cash">
			       <thead>
	  						<tr>
								<th>الفرع</th>
								<th>المبلغ</th>
								<th>التاريخ</th>
								<th>الحالة</th>
								<th>تعديل</th>
							</tr>
      	            </thead>
                            <tbody id="CashesTable">
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
<?php
if($_SESSION['user_details']['role_id'] == 1){
?>
<div class="modal fade" id="payCashModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">صرف نثرية</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="payCashForm">
				<div class="kt-portlet__body">

                    <div class="text-danger" id="a_cash_pay_err"></div>
                    <div class="form-group">
						<label>الفرع:</label>
						<select class="form-control" id="a_branch" name="a_branch"></select>
						<span class="form-text  text-danger" id="a_branch_err"></span>
					</div>
					<div class="form-group">
						<label>المبلغ:</label>
						<input type="number" name="a_price" class="form-control" placeholder="">
						<span class="form-text text-danger" id="a_price_err"></span>
					</div>
					<div class="form-group">
						<label>ملاحظات:</label>
						<textarea  class="form-control"  name="a_note"></textarea>
						<span id="a_note_err" class="form-text  text-danger"></span>
					</div>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="payCash()" class="btn btn-brand">اضافة</button>
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
<div class="modal fade" id="editpayCashModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">صرف نثرية</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
		<div class="kt-portlet">

			<!--begin::Form-->
			<form class="kt-form" id="editpayCashForm">
				<div class="kt-portlet__body">

                    <div class="text-danger" id="a_cash_pay_err"></div>
                    <div class="form-group">
						<label>الفرع:</label>
						<select class="form-control" id="e_branch" name="e_branch"></select>
						<span class="form-text  text-danger" id="e_branch_err"></span>
					</div>
					<div class="form-group">
						<label>المبلغ:</label>
						<input type="number" id="e_price" name="e_price" class="form-control" placeholder="">
						<span class="form-text text-danger" id="e_price_err"></span>
					</div>
					<div class="form-group">
						<label>ملاحظات:</label>
						<textarea  class="form-control"  id="e_note" name="e_note"></textarea>
						<span id="e_note_err" class="form-text  text-danger"></span>
					</div>
                    <input type="hidden" value="0" id="editcashid" name="editcashid"/>
	            </div>
	            <div class="kt-portlet__foot kt-portlet__foot--solid">
					<div class="kt-form__actions kt-form__actions--right">
						<button type="button" onclick="updateCash()" class="btn btn-brand">حفظ التعديلات</button>
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
<?php } ?>

<!--begin::Page Vendors(used by this page) -->
<script src="assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->



<!--begin::Page Scripts(used by this page) -->
<script src="assets/js/demo1/pages/components/datatables/extensions/responsive.js" type="text/javascript"></script>
<script type="text/javascript">

function getCashes(){
$.ajax({
  url:"script/_getCashes.php",
  type:"POST",
  data:$("#filtterCashesForm").serialize(),
  beforeSend:function(){
    $("#pagination").html("");
  },
  success:function(res){
   console.log(res);
   $("#tb-cash").DataTable().destroy();
   $("#CashesTable").html("");
     if(res.pages >= 1){
     if(res.page > 1){
         $("#pagination").append(
          '<li class="page-item"><a href="#" onclick="getorderspage('+(Number(res.page)-1)+')" class="page-link">السابق</a></li>'
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
          '<li class="page-item"><a href="#" onclick="getorderspage('+(i)+')"  class="page-link">'+i+'</a></li>'
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
          '<li class="page-item"><a href="#" onclick="getorderspage('+(Number(res.page)+1)+')" class="page-link">التالي</a></li>'
         );
     }else{
         $("#pagination").append(
          '<li class="page-item disabled"><a href="#" class="page-link">التالي</a></li>'
         );
     }
   }

   $.each(res.data,function(){
     if(res.role == 1){
        btns =   '<td>'+
                 '<button type="button" class="btn btn-link btn-clean" onclick="editCash('+this.id+')" data-toggle="modal" data-target="#editpayCashModal"><span class="flaticon-edit"></sapn></button>'+
                 '<button type="button" class="btn btn-link btn-clean text-danger" onclick="deleteCash('+this.id+')" data-toggle="modal" data-target="#deleteCashModal"><span class="flaticon-delete"></sapn></button>'+
                 '</td>';
     }else if(res.role == 2){
        btns =   '<td>'+
                 '<button type="button" class="btn btn-link btn-clean text-info" onclick="confirmCash('+this.id+')"><span class="fa fa-check"></sapn></button>'+
                 '</td>';
        $("#branch").val(res.branch);
        $("#branch").attr('disabled',true);
     }else if(res.role == 4){
        btns =   '<td>'+
                  '<button type="button" class="btn btn-link btn-clean text-waring" onclick="recivedCash('+this.id+')"><span class="fa fa-check"></sapn></button>'+
                 '</td>';
        $("#branch").val(res.branch);
        $("#branch").attr('disabled',true);
     }
     $("#Cashes").text("$"+this.Cashes);
     if(this.confirm == 1){
       status = "تم الموافقة على الصرف";
       color= "text-warning";
     }else if(this.confirm == 2){
       status = "تم سحب المبلغ";
       color= "text-info";
     }else if(this.confirm == 3){
       status = "تم استلام المبلغ";
       color= "text-success";
     }else{
       status = "معلق";
        color= "";
     }
     $("#CashesTable").append(
       '<tr>'+
            '<td>'+this.branch_name+'</td>'+
            '<td>$'+this.money+'</td>'+
            '<td>'+this.date+'</td>'+
            '<td class="'+color+'">'+status+'</td>'+
            btns+
        '</tr>');
     });
     $("#tb-cash").DataTable().destroy();
     var myTable= $('#tb-cash').DataTable({
     columns:[
    //"dummy" configuration
        { visible: true }, //col 1
        { visible: true }, //col 2
        { visible: true }, //col 3
        { visible: true }, //col 4
        { visible: true }, //col 5
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
getCashes();

</script>
<script type="text/javascript" src="js/getBraches.js"></script>
<script type="text/javascript" src="js/getLevels.js"></script>
<script type="text/javascript" src="js/getGroups.js"></script>
<script>
getBraches($("#branch"));
getBraches($("#a_branch"));
getBraches($("#e_branch"));
function payCash(){
$.ajax({
  url:"script/_payCash.php",
  type:"POST",
  data:$("#payCashForm").serialize(),
  beforeSend:function(){
   $("#a_cash_pay_err").html("");
  },
  success:function(res){
   console.log(res);
   if(res.success == 1){
      Toast.success('تم الاضافة');
      getCashes();
   }else{
      $("#a_branch_err").text(res.error.branch)
      $("#a_price_err").text(res.error.price)
      $("#a_note_err").text(res.error.note)
   }
  },
   error:function(e){
    console.log(e);
    Toast.error('خطأ');
  }
});
}

function editCash(id){
  $("#editcashid").val(id);
  $.ajax({
    url:"script/_getCash.php",
    data:{id: id},
    beforeSend:function(){

    },
    success:function(res){
      if(res.success == 1){
        $.each(res.data,function(){
          $('#e_branch').val(this.branch);
          $('#e_price').val(this.money);
          $('#e_note').val(this.note);
         });
      }
      console.log(res);
    },
    error:function(e){
      console.log(e);
    }
  });
}

function updateCash(){
    $.ajax({
       url:"script/_updateCash.php",
       type:"POST",
       data:$("#editpayCashForm").serialize(),
       beforeSend:function(){
          $('#e_branch_err').val('');
          $('#e_price_err').val('');
          $('#e_note_err').val('');
       },
       success:function(res){
         console.log(res);
       if(res.success == 1){
         $("#kt_form input").val("");
          Toast.success('تم التحديث');
          getCashes();
       }else{
           $("#e_branch_err").text(res.error["branch"]);
           $("#e_price_err").text(res.error["price"]);
           $("#e_note_err").text(res.error["note"]);
           Toast.warning(res.msg);
       }

       },
       error:function(e){
        Toast.error('خطأ');
        console.log(e);
       }
    });
}
function deleteCash(id){
  if(confirm("هل انت متاكد من الحذف")){
      $.ajax({
        url:"script/_deleteCash.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم الحذف');
           getCashes();
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
function recivedCash(id){
  if(confirm("هل انت متاكد من تاكيد استلام المبلغ")){
      $.ajax({
        url:"script/_recivedCash.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success(res.msg);
           getCashes();
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

function confirmCash(id){
  if(confirm("هل انت متاكد من تاكيد سحب  المبلغ")){
      $.ajax({
        url:"script/_confirmCash.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success(res.msg);
           getCashes();
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