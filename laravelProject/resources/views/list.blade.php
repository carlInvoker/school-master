<html>
    
    <head>
         <meta charset="UTF-8">
        <title>
        LaravelNews    
        </title>
      
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" /> 
      
        <style>
            .table
            {
                margin-bottom: 0px;
            }
            
             .pagination
             {
                 margin-top: 3px;
                 margin-bottom: 20px;
                 
             }


        </style>
        
        
        <script>
          
       
          
                  
       </script>
              
     
              
    </head>
    
    
    <body>

        <table class="table table-hover" style="border-top: 2px solid black; border-bottom: 2px solid black;">
            <tr>
       <th>id</th>
<!--         <th>picture</th>-->
        <th>title</th>
        <th>image</th>
        <th>status</th>
        <th>date</th>
        <th>edit link</th>
        <th>delete value</th>
            </tr>
            @foreach ($listSelect as $list)
            <tr>
                <td>{{$list->id}}</td>
                <td> <a href="{{ route('watchIt', ['id'=>$list->id]) }}"> {{$list->title}}  </a> </td>
                
                
            @if(file_exists(base_path().'/public/files/resized/'."image{$list->id}.".'png'))     <td>  <img src="/public/files/resized/image{{$list->id}}.png" alt="no picture" /> </td> 
            @elseif(file_exists(base_path().'/public/files/resized/'."image{$list->id}.".'jpg'))     <td>  <img src="/public/files/resized/image{{$list->id}}.jpg" alt="no picture" /> </td>     
            @elseif(file_exists(base_path().'/public/files/resized/'."image{$list->id}.".'gif'))     <td>  <img src="/public/files/resized/image{{$list->id}}.gif" alt="no picture" /> </td>      
            @else <td>  <img src="/public/files/resized/image{{$list->id}}.png" alt="no picture" />
            @endif     
            
                 @if($list->status == '1')      <td>Active</td> @endif
                 @if($list->status == '0')      <td>Passive</td> @endif
                <td>{{$list->date}}</td>
                <td> <a href="{{ route('editList', ['id'=>$list->id])}}">edit link</a></td>
                <td> <a href="{{ route('deleteList', ['id'=>$list->id])}}" onclick="return confirm('Delete?');">delete value</a></td>     
            </tr>
            @endforeach
           
            
        </table>
        
        {{ $listSelect->links() }}  
       
        <div style="margin-left: 8px; margin-bottom:8px; ">
        <a class="btn btn-default" href="{{ route ('showAddList')}}" role="button">Add new value</a>
        </div>
        
<!--       // route('addList')-->
    </body>
    
    
</html>
  