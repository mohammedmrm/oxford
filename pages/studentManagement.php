<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h1 class="">
			   تقيم الطلاب
			</h1>
		</div>
	</div>

	<div class="kt-portlet__body">
     <form id="studentsEvaluationForm">
		<!--begin: Datatable -->
          <fieldset><legend>فلتر</legend>
            <div class="row kt-margin-b-20">
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            <label>التاريخ:</label>
            <div class="input-daterange input-group" id="kt_datepicker">
  				<input  onchange="getLecture()" value="<?php echo date("Y-m-d");?>" type="date" class="form-control kt-input" name="date" id="date" placeholder="من" data-col-index="5">
  			</div>
            </div>
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            	<label>المحاضرة:</label>
            	<select onchange="getstudentes()" class="selectpicker form-control kt-input" id="lecture" name="lecture" data-col-index="6">
            	</select>
            </div>


          </div>
          </fieldset>
		<table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tb-students">
			       <thead>
	  						<tr>
								<th>الصورة</th>
								<th>اسم الطالب</th>
								<th>الحضور</th>
								<th>الواجب البيتي</th>
								<th>المشاركة خلال المحاضرة</th>
								<th>ملاحظات</th>
								<th>الحالة</th>
								<th>حفظ</th>
							</tr>
      	            </thead>
                            <tbody id="studentsTable">
                            </tbody>
		</table>
        <div class="kt-section__content kt-section__content--border">
         <div id="students_ids"></div>
          <fieldset><legend>فلتر</legend>
            <div class="row kt-margin-b-20">
            <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
            <div class="input-daterange input-group" id="kt_datepicker">
  				<input onclick="setEvalutionAll()" value="حفظ التغيرات" type="button" class="btn btn-lg btn-success">
  			</div>
            </div>
            </div>
          </fieldset>
     	</div>

        </form>
		<!--end: Datatable -->
	</div>
</div>
</div>



<!--begin::Page Vendors(used by this page) -->
<script src="assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->



<!--begin::Page Scripts(used by this page) -->
<script src="assets/js/demo1/pages/components/datatables/extensions/responsive.js" type="text/javascript"></script>
<script>
getLecture();
function getLecture(){
 $.ajax({
        url:"script/_getLectures.php",
        type:"POST",
        data:{date:$("#date").val()},
        success:function(res){
           $("#lecture").html("");
           $("#lecture").append(
             '<option value="0">... اختر المحاضرة ...</option>'
           );
           if(res.success == 1){
               $.each(res.data,function(){
                   $("#lecture").append(
                     '<option value="'+this.id+'">'+this.name +" ("+this.g_name+') - '+this.start+'</option>'
                   );

               });
          }
          $("#lecture").selectpicker('refresh');
          console.log(res)
        } ,
        error:function(e){
          console.log(e);
        }
      });
}
getstudentes();
function getstudentes() {
$.ajax({
  url:"script/_getStudentsEval.php",
  type:"POST",
  data:$("#studentsEvaluationForm").serialize(),
  beforeSend:function(){
    $("#pagination").html("");
    $("#students_ids").html("");
    $("#studentsTable").addClass('loading');
  },
  success:function(res){
   $("#studentsTable").removeClass('loading');
   console.log(res);
   $("#tb-students").DataTable().destroy();
   $("#studentsTable").html("");

   $.each(res.data,function(){
     $("#students_ids").append(
       '<input type="hidden" name="ids[]" value="'+this.s_id+'"/>'
     );
     attendance = "<select class='form-control' id='attendance"+this.s_id+"' name='attendance"+this.s_id+"'>"+
                     "<option value='1'>حاضر</option>"+
                     "<option value='0'>غائب</option>"+
                     "<option value='2'>متأخر</option>"+
                   "</select>";

     homework = "<select  class='form-control' id='homework"+this.s_id+"' name='homework"+this.s_id+"'>"+
                     "<option value='1'>منجز</option>"+
                     "<option value='0'>غير منجز</option>"+
                     "<option value='2'>نصف منجز</option>"+
               "</select>";


      grade = "<input class='form-control' type='number' max='10' min='0' id='grade"+this.s_id+"' name='grade"+this.s_id+"' id='grade"+this.s_id+"' placeholder='الدرجة من 10'/>";
      note = "<textarea class='form-control' type='text' id='note"+this.s_id+"' name='note"+this.s_id+"'></textarea>";
      if(this.attendance == null){
        status = "لم يقيم";
      }else{
        status = "تم";
      }
     $("#studentsTable").append(
       '<tr>'+
            '<td> <img src="img/student/'+this.img+'" class="user-img"/></td>'+
            '<td>'+this.s_name+'</td>'+
            '<td>'+attendance+'</td>'+
            '<td>'+homework+'</td>'+
            '<td>'+grade+'</td>'+
            '<td>'+note+'</td>'+
            '<td>'+status+'<br /><span class="text-info" id="msg'+this.s_id+'"></span></td>'+

            '<td><button type="button" onclick="setEvalution('+this.s_id+')" class="btn btn-primary">حفظ</button></td>'+
        '</tr>');
        if(this.attendance != null){
         $('#note'+this.s_id).val(this.e_note);
         $('#attendance'+this.s_id).val(this.attendance);
         $('#homework'+this.s_id).val(this.homework);
         $('#grade'+this.s_id).val(this.grade);
         }
     });


     $("#tb-students").DataTable().destroy();
     var myTable= $('#tb-students').DataTable({
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
        "paging":   false,
        "ordering": false,
        "info":     false

     });
    },
   error:function(e){
    $("#studentsTable").removeClass('loading');
    console.log(e);
  }
});

}
function setEvalution(id){
  $.ajax({
      url:"script/_setEvalution.php",
      type:"POST",
      data:$("#studentsEvaluationForm").serialize()+ '&s_id='+id,
      beforeSend:function(){

      },
      success:function(res){
        console.log(res);
        if(res.success == 1){
          getstudentes();
        }

      },
      error:function(e){
         console.log(e);
      }

  });
}
function setEvalutionAll() {
  $.ajax({
      url:"script/_setEvalutionAll.php",
      type:"POST",
      data:$("#studentsEvaluationForm").serialize(),
      beforeSend:function(){

      },
      success:function(res){
        console.log(res);
        getstudentes();
        setTimeout(function() {
            setMsg(res.msg);
        }, 1000);

      },
      error:function(e){
         console.log(e);
      }

  });
}
function setMsg(msgs){
        $.each(msgs,function(k,v){
          $('#msg'+k+'').html(v);
          console.log(v);
        });
}
</script>