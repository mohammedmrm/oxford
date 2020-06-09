function getGroups(elem){
$.ajax({
  url:"script/_getGroups.php",
  type:"POST",
  success:function(res){
   console.log(res);
   elem.html("");
     elem.append(
       '<option value="">... اختر مجموعة ...</option>'
     );
   $.each(res.data,function(){
     elem.append(
       '<option value="'+this.id+'">'+this.name +'</option>'
     );
    //elem.selectpicker('refresh');
   });
  },
  error:function(e){
    console.log(e);
  }
});
}