<html>
    
    <head>
         <meta charset="UTF-8">
        <title>
        LaravelNews    
        </title>
      
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" /> 
      
        <style>
            form
            {
                margin: 3px;
                
            }
            
        </style>
        
        
        <script>
          
                  
       </script>
              
     
              
    </head>
    
    
    <body>

       <form  method="POST"  enctype="multipart/form-data" action="{{route('add')}}">
            
              <div class="form-group">
                  <label for="title">Title</label> <!-- Заголовок новини -->
            <input type="text" id ="title" placeholder="title" class="form-control" name="title">
              </div>
            
             <div class="form-group">
                 <label for="nov"> Text </label>  <!-- Текст новини -->
            <textarea name="text" id="nov" cols="55" rows="20" placeholder="text" class="form-control"></textarea> 
             </div>
            
            <div class="form-group">
                <label for="status">Status</label> <!-- Активність -->
            <select name="status" id="status" class="form-control">
                <option>Active</option> <!-- Активний -->
                <option>Passive</option> <!-- Пасивний -->
            </select> 
             </div>
            
             <div class="form-group">
                 <label for="file">Download image</label> <!-- Зображення -->
            <input type="file" id ="file" name="file" accept="image/jpeg,image/png" class="form-control">
            </div>
            
            <div class="form-group">
               <button class="btn btn-default" type="submit" name="add">Add</button> 
               <button class="btn btn-default" type="reset">Reset</button>
<!--                <input type="submit" id ="sub" name="add" value="Р’С–РґРїСЂР°РІРёС‚Рё" class="btn btn-default">
                <input type="reset" id ="res" value="Р—РєРёРЅСѓС‚Рё" class="btn btn-default">-->
             </div>
             {{ csrf_field() }}
             </form>
        
        
        <script src="/public/js/tinymce/js/tinymce/tinymce.min.js"></script>
  
  <script>
  tinymce.init({  selector:'#nov' });
  </script>
        
        
    </body>
    
    
</html>
  