<html>
    
    <head>
         <meta charset="UTF-8">
        <title>
        LaravelNews    
        </title>
      
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" /> 
      
        <style>
            #er 
            {
                width:40%;
                height:200px;
                margin-top:5px;
                margin-bottom:0px;
                border:2px solid black;
                padding-left:3px;
                padding-right:3px;
                margin-left: 30%;
                margin-right: 30%;
                border-radius: 15px;
                background-color: paleturquoise;
                min-width: 200px;
                min-height:200px;
                max-height:220px;
                overflow: hidden;
                position:relative
            }
          
            hr
            {
              display: block;
              height: 1px;
              border: 0;
              border-top: 1px solid black;
              margin-top: 3px;
              padding: 0; 
             }
             
             #btn
             {
                margin-left: 36%;
                position:absolute; 
                bottom:10px;
                margin-right: 30%;
             }
            
            
        </style>
        
        
        <script>
          
                  
       </script>
              
     
              
    </head>
    
    
    <body>

        <div id='er'>
            <h1>Sorry, but this news doesn't exist!  
            <hr/>
            <a id='btn' class="btn btn-primary btn-md" href="{{route ('list')}}"> Back to news list</a>
           </h1>
        </div>
            
       

    </body>
    
    
</html>
  