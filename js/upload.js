$(function() {
   $('#upload_file').submit(function(e) {
      e.preventDefault();
      $.ajaxFileUpload({
         url         :'./upload/upload_file/',
         secureuri      :false,
         fileElementId  :'userfile',
         dataType    : 'json',
         data        : {
            'id'           : $('#user_id').val()
         },
         success  : function (data, status)
         {
            if(data.status != 'error')
            {
               
            }
            alert(data.msg);
         }
      });
      return false;
   });
});