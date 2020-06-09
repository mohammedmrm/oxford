<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__body">
        <button type="button" data-toggle="modal" data-target="#addAccounter"class="btn btn-success text-center btn-lg"  >اضافة محاسب</button>
	</div>
</div>
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				المحاسبين
			</h3>
		</div>
	</div>
    <div class="kt-portlet__body">
		<!--begin: Datatable -->
		<table class="table table-striped- table-bordered table-hover table-checkable" id="tb_accounters">
    		<thead>
        		<tr>
                  <th>ID</th>
                  <th>الاسم</th>
                  <th>الهاتف</th>
                  <th>البريد الالكتروني</th>
                  <th>الراتب $</th>
                  <th>العنوان</th>
                  <th>المستمسكات</th>
                  <th>الملاحضات</th>
                  <th>تعديل</th>
                </tr>
    		</thead>
            <tbody id="accounters">
            </tbody>
        </table>
		<!--end: Datatable -->
	</div>
</div>
<div class="modal fade" id="addAccounter" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" dir="ltr">
          <button type="button" class="close" data-dismiss="modal"></button>
          <h4 class="modal-title">اضافة مدير حسابات</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
			<!--begin::Form-->
			<form class="kt-form" id="addAccounterForm">
				<div class="kt-portlet__body">
					<div class="kt-section kt-section--first">
						<div class="form-group">
							<label>الاسم الكامل:</label>
							<input type="email" class="form-control" placeholder="" name="name">
							<span class="form-text text-danger" id="name_err"></span>
						</div>
						<div class="form-group">
							<label>البريد الالكتروني:</label>
							<input type="email" class="form-control" placeholder="" name="email">
							<span class="form-text text-danger" id="email_err"></span>
						</div>
						<div class="form-group">
							<label>رقم الهاتف:</label>
							<input type="email" class="form-control" placeholder="" name="phone">
							<span class="form-text text-danger" id="phone_err"></span>
						</div>
						<div class="form-group">
							<label>عنوان السكن:</label>
							<input type="email" class="form-control" placeholder="" name="address">
							<span class="form-text text-danger" id="address_err"></span>
						</div>
						<div class="form-group">
							<label>كلمة السر:</label>
							<input type="email" class="form-control" placeholder="" name="password">
							<span class="form-text text-danger"  id="password_err"></span>
						</div>
						<div class="form-group">
							<label>مقدار الراتب:</label>
							<input type="number" class="form-control" placeholder="$" name="salary">
							<span class="form-text text-danger"  id="salary_err"></span>
						</div>
						<div class="form-group">
							<label>تاريخ انتهاء العقد:</label>
							<input type="date" class="form-control" placeholder="" name="end">
							<span class="form-text text-danger"  id="end_err"></span>
						</div>
                        <div class="form-group">
						   <label>صورة شخصية:</label>
						   <input class="form-control" type="file" name="img">
						   <span class="form-text text-danger" id="img_err"></span>
						</div>
                        <div class="form-group">
						   <label>المستمسكات:</label>
						   <input class="form-control" type="file" name="documents">
						   <span class="form-text text-danger" id="documents_err"></span>
						</div>
		            </div>
	            </div>
	            <div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="button" onclick="addAccounter()" class="btn btn-primary">اضافة</button>
						<button type="reset" class="btn btn-secondary">الغأ</button>
					</div>
				</div>
			</form>
			<!--end::Form-->
		<!--end::Portlet-->
        </div>
      </div>

    </div>
  </div>
<div class="modal fade" id="editAccounter" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" dir="ltr">
          <button type="button" class="close" data-dismiss="modal"></button>
          <h4 class="modal-title">اضافة مدير حسابات</h4>
        </div>
        <div class="modal-body">
		<!--begin::Portlet-->
			<!--begin::Form-->
			<form class="kt-form" id="updateAccounterForm">
				<div class="kt-portlet__body">
					<div class="kt-section kt-section--first">
						<div class="form-group">
							<label>الاسم الكامل:</label>
							<input type="email" class="form-control" placeholder="" id="e_name" name="e_name">
							<span class="form-text text-danger" id="e_name_err"></span>
						</div>
						<div class="form-group">
							<label>البريد الالكتروني:</label>
							<input type="email" class="form-control" placeholder="" id="e_email" name="e_email">
							<span class="form-text text-danger" id="e_email_err"></span>
						</div>
						<div class="form-group">
							<label>رقم الهاتف:</label>
							<input type="email" class="form-control" placeholder="" id="e_phone" name="e_phone">
							<span class="form-text text-danger" id="e_phone_err"></span>
						</div>
						<div class="form-group">
							<label>عنوان السكن:</label>
							<input type="email" class="form-control" placeholder="" id="e_address" name="e_address">
							<span class="form-text text-danger" id="e_address_err"></span>
						</div>
						<div class="form-group">
							<label>كلمة السر:</label>
							<input type="email" class="form-control" placeholder="" id="e_password" name="e_password">
							<span class="form-text text-danger"  id="e_password_err"></span>
						</div>
						<div class="form-group">
							<label>مقدار الراتب:</label>
							<input type="number" class="form-control" placeholder="$" id="e_salary" name="e_salary">
							<span class="form-text text-danger"  id="e_salary_err"></span>
						</div>
						<div class="form-group">
							<label>تاريخ انتهاء العقد:</label>
							<input type="date" class="form-control" placeholder="" id="e_end" name="e_end">
							<span class="form-text text-danger"  id="e_end_err"></span>
						</div>
                        <div class="form-group">
						   <label>صورة شخصية:</label>
						   <input class="form-control" type="file" name="e_img">
						   <span class="form-text text-danger" id="e_img_err"></span>
						</div>
                        <div class="form-group">
						   <label>المستمسكات:</label>
						   <input class="form-control" type="file" name="e_documents">
						   <span class="form-text text-danger" id="e_documents_err"></span>
						</div>
		            </div>
	            </div>
	            <div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="button" onclick="updateAccounter()" class="btn btn-primary">اضافة</button>
						<button type="reset" class="btn btn-secondary">الغأ</button>
					</div>
				</div>
                <input type="hidden" name="editAccounterid" id="editAccounterid"/>
			</form>
			<!--end::Form-->
		<!--end::Portlet-->
        </div>
      </div>

    </div>
  </div>

<!--begin::Page Vendors(used by this page) -->
                <script src="./assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
            <!--end::Page Vendors -->



<!--begin::Page Scripts(used by this page) -->
                <script src="./assets/js/demo1/pages/components/datatables/basic/paginations.js" type="text/javascript"></script>
            <!--end::Page Scripts -->
<script type="text/javascript">
function getAccounters(){
$.ajax({
  url:"script/_getAccounters.php",
  type:"POST",
  beforeSend:function(){
    $("#accounters").addClass('loading');
  },
  success:function(res){
   $("#tb_accounters").DataTable().destroy();
   console.log(res);
   $("#accounters").html("");
   $("#accounters").removeClass('loading');
   $.each(res.data,function(){
     $("#accounters").append(
       '<tr>'+
            '<td><img width="50px" height="50px" src="img/staff/'+this.img+'"/></td>'+
            '<td width="150px">'+this.name+'</td>'+
            '<td>'+this.phone+'</td>'+
            '<td>'+this.email+'</td>'+
            '<td>'+this.salary+'</td>'+
            '<td>'+this.address+'</td>'+
            '<td><a href="img/staff/'+this.documents+'"><img width="60px" src="img/staff/'+this.documents+'"/></a></td>'+
            '<td>'+this.note+'</td>'+
            '<td width="150px">'+
              '<button class="btn btn-clean btn-icon-lg" onclick="editAccounter('+this.id+')" data-toggle="modal" data-target="#editAccounter"><span class="flaticon-edit"></sapn>'+
              '<button class="btn btn-clean btn-icon-lg" onclick="deleteAccounter('+this.id+')" data-toggle="modal" data-target="#deleteAccounter"><span class="flaticon-delete"></sapn>'+
            '</button></td>'+

       '</tr>');
     });
     var myTable= $('#tb_accounters').DataTable({
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
        { visible: true }, //col 9
        ],
        className: 'select-checkbox',
        targets: 0,
        "oLanguage": {
        "sLengthMenu": "عرض_MENU_سجل",
        "sSearch": "بحث:" ,
        select: {
        style: 'os',
        selector: 'td:first-child'
    }
      }
});
    },
   error:function(e){
    $("#accounters").removeClass('loading');
    console.log(e);
  }
});
}
getAccounters();


function addAccounter(){
    var myform = document.getElementById('addAccounterForm');
    var fd = new FormData(myform);
  $.ajax({
    url:"script/_addAccounter.php",
    type:"POST",
    data:fd,
    processData: false,  // tell jQuery not to process the data
    contentType: false,
   	cache: false,
    beforeSend:function(){
     $("#name_err").text("");
     $("#phone_err").text('');
     $("#salary_err").text('');
     $("#address_err").text('');
     $("#email_err").text('');
     $("#password_err").text('');
     $("#documents_err").text('');
     $("#end_err").text('');
     $("#img_err").text('');
     $("#addAccounterForm").addClass("loading");
    },
    success:function(res){
        $("#addAccounterForm").removeClass("loading");
       console.log(res);
       if(res.success == 1){
         $("#name").val("");
         $("#phone").val("");
         $("#birthday").val("");
         Toast.success('تم الاضافة');
        }else{
         $("#name_err").text(res.error.name);
         $("#phone_err").text(res.error.phone);
         $("#salary_err").text(res.error.salary);
         $("#address_err").text(res.error.address);
         $("#email_err").text(res.error.email);
         $("#password_err").text(res.error.password);
         $("#documents_err").text(res.error.documents);
         $("#end_err").text(res.error.end);
         $("#img_err").text(res.error.img);
         Toast.warning("هناك بعض المدخلات غير صالحة",'خطأ');
       }

    },
    error:function(e){
       $("#addAccounterForm").removeClass("loading");
       console.log(e);
       Toast.error('خطأ');
    }
  });
}
function editAccounter(id){
  $("#editAccounterid").val(id);

  $.ajax({
    url:"script/_getAccounter.php",
    data:{id: id},
    success:function(res){
      if(res.success == 1){
        $.each(res.data,function(){
          $('#e_name').val(this.name);
          $('#e_email').val(this.email);
          $('#e_phone').val(this.phone);
          $('#e_salary').val(this.salary);
          $('#e_address').val(this.address);
          $('#e_end').val(this.end_date);
        });
      }
      console.log(res);
    },
    error:function(e){
      console.log(e);
    }
  });
}

function updateAccounter(){
    var myform = document.getElementById('updateAccounterForm');
    var fd = new FormData(myform);
  $.ajax({
    url:"script/_updateAccounter.php",
    type:"POST",
    data:fd,
    processData: false,  // tell jQuery not to process the data
    contentType: false,
   	cache: false,
    beforeSend:function(){
     $("#e_name_err").text("");
     $("#e_phone_err").text('');
     $("#e_salary_err").text('');
     $("#e_address_err").text('');
     $("#e_email_err").text('');
     $("#e_password_err").text('');
     $("#e_documents_err").text('');
     $("#e_end_err").text('');
     $("#e_img_err").text('');
     $("#updateAccounterForm").addClass("loading");
    },
    success:function(res){
       $("#updateAccounterForm").removeClass("loading");
       console.log(res);
       if(res.success == 1){
         $("#e_name").val("");
         $("#e_phone").val("");
         $("#e_birthday").val("");
         Toast.success('تم الاضافة');
         getAccounters();
       }else{
         $("#e_name_err").text(res.error.name);
         $("#e_phone_err").text(res.error.phone);
         $("#e_salary_err").text(res.error.salary);
         $("#e_address_err").text(res.error.address);
         $("#e_email_err").text(res.error.email);
         $("#e_password_err").text(res.error.password);
         $("#e_documents_err").text(res.error.documents);
         $("#e_img_err").text(res.error.img);
         $("#e_end_err").text(res.error.img);
         Toast.warning("هناك بعض المدخلات غير صالحة",'خطأ');
       }

    },
    error:function(e){
       $("#updateAccounterForm").removeClass("loading");
       console.log(e);
       Toast.error('خطأ');
    }
  });
}
function deleteAccounter(id){
  if(confirm("هل انت متاكد من الحذف")){
      $.ajax({
        url:"script/_deleteAccounter.php",
        type:"POST",
        data:{id:id},
        success:function(res){
         if(res.success == 1){
           Toast.success('تم الحذف');
           getAccounters();
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
