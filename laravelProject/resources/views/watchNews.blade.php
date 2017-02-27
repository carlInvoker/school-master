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
            
/*            hr
            {
            border: none;  Убираем границу для браузера Firefox 
            color: black;  Цвет линии для остальных браузеров 
            background-color: black;  Цвет линии для браузера Firefox и Opera 
            height: 2px;
            } */
            
            fieldset
            {
               margin-left: 24px;
               margin-right: 24px;
            }
            
            legend
            {
                border-bottom-color:black;      
                margin-bottom:10px;
            }
             
            #textstyles
            {
                background-color:Gainsboro;
                padding-left:8px;
                padding-right:8px;
                padding-top:3px;
                padding-bottom:3px;
                border-radius: 8px;
                border:3px solid grey;
                min-height: 260px;
            }
            
            p
            {
                margin:0px;
            }
            
        </style>
        
        
        <script>
          
                  
       </script>
              
     
              
    </head>
    
    
    <body>

        @if($listSelect)
        
        
        
                
             <fieldset>
                     <legend>
                     <h1> 
                     @if(file_exists(base_path().'/public/files/resized/'."image{$listSelect->id}.".'png'))         <td>  <img src="/public/files/resized/image{{$listSelect->id}}.png" alt="no picture" /> </td> 
            @elseif(file_exists(base_path().'/public/files/resized/'."image{$listSelect->id}.".'jpg'))     <td>  <img src="/public/files/resized/image{{$listSelect->id}}.jpg" alt="no picture" /> </td>     
            @elseif(file_exists(base_path().'/public/files/resized/'."image{$listSelect->id}.".'gif'))     <td>  <img src="/public/files/resized/image{{$listSelect->id}}.gif" alt="no picture" /> </td>      
            @else <td>  <img src="/public/files/resized/image{{$listSelect->id}}.png" alt="no picture" />
            @endif                
                     {{$listSelect->title}}  <h1/>
                     </legend>
                 
                 <div style="word-wrap: break-word;" id="textstyles" >    
                     {!!$listSelect->text!!}
                     </pre
                 </div>
                       
              </fieldset>        
        
        <ul>
        @if($listSelect->status == '1') <li>{{   'Status: Active'   }}</li>  @endif 
        @if($listSelect->status == '0') <li>{{   ' Status: Passive' }}</li>  @endif 
        
       <li> {{$listSelect->date}} </li>
        </ul>
        
        <a class="btn btn-default" style="margin-left:24px;" href="{{route ('list')}}"> Back to news list</a>
        @endif
                   <!--<div class="form-group">-->
       
<!--            <label for="status">Status</label>  Активність 
            <select name="status" class="form-control">
               <option  @if($listSelect->status == '1') {{   'selected'   }}  @endif>   Active</option>  Активний  
               <option  @if($listSelect->status == '0') {{   'selected'   }}  @endif>   Passive</option>  Пасивний  
                 
            </select> -->
         
           
            
            
<!--             {{ csrf_field() }}-->
       

        
        
    </body>
    
    
</html>
  