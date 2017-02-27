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

        @if($listSelect)
        
        
          <form  method="POST"  enctype="multipart/form-data" action="{{route('editChange', ['id'=>$listSelect->id])}}">
                
              <div class="form-group">
           <label for="title">Title</label> <!-- Заголовок новини -->
            <input type="text" id ="title" placeholder="Р—Р°РіРѕР»РѕРІРѕРє РЅРѕРІРёРЅРё" class="form-control" value="{{$listSelect->title}}" name="title">
              </div>
                
             <div class="form-group">
          <label for="nov"> Text </label>  
            <textarea name="text" id="nov" cols="55" rows="10" class="form-control" placeholder="РўРµРєСЃС‚ РЅРѕРІРёРЅРё">{{$listSelect->text}} </textarea> 
             </div>
                
                   <div class="form-group">
       
            <label for="status">Status</label> <!-- Активність -->
            <select name="status" class="form-control">
               <option  @if($listSelect->status == '1') {{   'selected'   }}  @endif>   Active</option> <!-- Активний --> 
               <option  @if($listSelect->status == '0') {{   'selected'   }}  @endif>   Passive</option> <!-- Пасивний --> 
                 
            </select> 
         
           
            
            
                </div>
<!--           -->
            <div class="form-group">
           
            <label for="file">Download image</label> <!-- Зображення -->
            <input type="file" id ="file" name="file" class="form-control" accept="image/jpeg,image/png">
          
              </div>

             <div class="form-group">
         <button class="btn btn-default" type="submit" id ="save" name="save">Save</button>
               <button class="btn btn-default" type="reset" id ="res" >Reset</button>

                </div>
             {{ csrf_field() }}
        </form>

        @endif
        
       
          
<!--          /public/js/tinymce/js/tinymce/images.jpg"-->
          
  <script src="/public/js/tinymce/js/tinymce/tinymce.min.js"></script>
  
  <script>
  tinymce.init({  selector:'#nov' });
  </script>
 
 
    </body>
    
    
    
    
    
</html>
  