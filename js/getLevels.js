function getLevels(elem){
$.ajax({
  url:"script/_getLeveles.php",
  type:"POST",
  success:function(res){
   console.log(res);
   elem.html("");
     elem.append(
       '<option value="">... اختر مستوى ...</option>'
     );
   $.each(res.data,function(){
     elem.append(
       '<option value="'+this.id+'">($'+this.price+') '+this.name+'</option>'
     );
     elem.selectpicker('refresh');
   });
  },
  error:function(e){
    console.log(e);
  }
});
}