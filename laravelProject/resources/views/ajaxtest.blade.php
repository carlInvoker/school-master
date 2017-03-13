<html>
    <meta name="csrf-token" content="{{ csrf_token() }}">
   <head>
      <title>Ajax Example</title>
      
      <script src="{{asset('js/jquery-3.1.1.js')}}">   </script>
      
      <script>
          
          $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


$(document).ready(function()
             {
                 $("#forma").submit(function(e)
    {
       
             url = "http://laravelproject/public/getmsg";
            // data1 = $('#simpleText').val();
       
             e.preventDefault(e);
          
            $.ajax({
               method:'POST',
               url:url,
               data:{data1:$('#simpleText').val()},
               success:function(data){
                 $("#msg").html(data.msg+' '+data.text);
               //  console.log( (data.msg));
               },
               error:function() { alert('error'); }
            });
         });
    
 });
      </script>
   </head>
   
   <body>
       <form id="forma" enctype="multipart/form-data" action="#">
      <div id = 'msg'>This message will be replaced using Ajax. 
         Click the button to replace the message.</div>
   
           <input type="text" id="simpleText" />
           <input type="submit" value="replace message" />
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
       </form>
   </body>

   
</html>