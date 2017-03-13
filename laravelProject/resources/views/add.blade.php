<html>
    
    <head>
         <meta charset="UTF-8">
         <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>
        LaravelNews    
        </title>
      
               <link href="{{ asset('css//bootstrap.min.css') }}" rel="stylesheet" /> 

      
        <style>
            form
            {
                margin: 3px;
                
            }
            
        </style>
        
         <script src="{{asset('js/jquery-3.1.1.js')}}">   </script>
          <script src="{{asset('js/jquery-ui-1.12.1.custom/jquery-ui.js')}}">   </script>
          <script>
      
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});


$(document).ready(function()
             {
            
            
                 
                 
                 $("#ff").submit(function(e)
    {
     
    
        url = "http://laravelproject/public/add";
           
           e.preventDefault(e);
     
        
       
      
        
        
       var list = document.getElementById('status');
        var $stat = list.options[list.selectedIndex].text;
     
          $.ajax({
               method:'POST',
               url:url,
            
               data:{title:$('#title').val(),
                     text:$('#nov').val(),
                  
                     status: $stat
            },
             beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

        if (token) {
                 return xhr.setRequestHeader('X-CSRF-TOKEN', token);           }
       },
              success:function(data){
                  
              }
               console.log(data.status);
           
              },
               error:function() { alert('error'); }
           });
        });
  
 });       

      </script>
              
     
              
    </head>
    
    
    <body> 
<!--action="{{route('add')}}"-->

       <form enctype="multipart/form-data" id="ff" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                  <label for="title">Title</label> <!-- Заголовок новини -->
            <input type="text" id ="title" placeholder="title" class="form-control" name="title">
              </div>
            
             <div class="form-group">
                 <label for="nov"> Text </label>  <!-- Текст новини -->
            <textarea name="text" id="nov" cols="15" rows="10" placeholder="text" class="form-control"></textarea> 
             </div>
            
            <div class="form-group">
                <label for="status">Status</label> <!-- Активність -->
            <select name="status" id="status" class="form-control">
                <option selected>Active</option> <!-- Активний -->
                <option>Passive</option> <!-- Пасивний -->
            </select> 
             </div>
            
             <div class="form-group">
                 <label for="file">Download image</label> <!-- Зображення -->
            <input type="file" id ="file" name="file" accept="image/jpeg,image/png" class="form-control">
            </div>
            
            <div class="form-group">
                <button class="btn btn-default" type="submit" name="add" id="add" >Add</button> 
               <button class="btn btn-default" type="reset">Reset</button>
<!--                <input type="submit" id ="sub" name="add" value="Р’С–РґРїСЂР°РІРёС‚Рё" class="btn btn-default">
                <input type="reset" id ="res" value="Р—РєРёРЅСѓС‚Рё" class="btn btn-default">-->
             </div>
             
             
             </form>
        
        
       
        
        <script src="/public/js/tinymce/js/tinymce/tinymce.min.js"></script>
  
  <script>
  tinymce.init({  selector:'#nov' });
  </script>
        
        
    </body>
    
    
</html>
  