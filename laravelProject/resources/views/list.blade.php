<?php
$ts = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: $ts");
header("Last-Modified: $ts");
header("Pragma: no-cache");
header("Cache-Control: no-cache, must-revalidate");
?>

<html>
    
    <head>
         <meta charset="UTF-8">
         <meta name="csrf-token" content="{{ csrf_token() }}" />
<!--         <meta http-equiv="Cache-Control" content="no-cache" />-->

        <title>
        LaravelNews    
        </title>
      
        <link href="{{ asset('css//bootstrap.min.css') }}" rel="stylesheet" /> 
       <link href="{{ asset('js/jquery-ui-1.12.1.custom/jquery-ui.css') }}" rel="stylesheet" /> 
         <link href="{{ asset('js/jquery-ui-1.12.1.custom/jquery-ui.min.css') }}" rel="stylesheet" /> 
    <link href="{{ asset('js/jquery-ui-1.12.1.custom/jquery-ui.structure.css') }}" rel="stylesheet" /> 
     <link href="{{ asset('js/jquery-ui-1.12.1.custom/jquery-ui.structure.min.css') }}" rel="stylesheet" /> 
      <link href="{{ asset('js/jquery-ui-1.12.1.custom/jquery-ui.theme.css') }}" rel="stylesheet" /> 
      <link href="{{ asset('js/jquery-ui-1.12.1.custom/jquery-ui.theme.min.css') }}" rel="stylesheet" /> 
    
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

             p.hover
             {
                 background-color:blue;
             }

        </style>
        
        <script src="/public/js/tinymce/js/tinymce/tinymce.min.js"></script>
        <script src="{{asset('js/jquery-3.1.1.js')}}">   </script>
        <script src="{{asset('js/jquery-ui-1.12.1.custom/jquery-ui.js')}}">   </script>
                

<!--         <script src="{{asset('js/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}">   </script>-->
          <script>
               var $ = $.noConflict();
              $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
              
              
              
          jQuery(document).ready(function($) { 
             $.noConflict(true);
             globalEdit=0;
             dlg = undefined;
          
   
               
// ====================================== edit link ============================
       
        $(".dialog_trigger").click( function(e) {
            e.preventDefault();    
            var somevar = '';
           
            var idd = $(this).attr('href');
            globalEdit = idd;
            $("#dialog2").dialog({
           autoOpen: false,
    title: 'EDIT',
    draggable: true,
    width : 700,
    height : 600, 
    resizable : true,
    modal : true,
     open: function(){
        
        tinymce.init({  
            selector:'#novEdit',
            setup: function (editor) {
            editor.on('change', function () {
            editor.save();
        });
    }
    
        });
           var url2 = "http://laravelproject/public/edit/"+idd;
               $.ajax({
               method:'GET',
               url:url2,            
               success:function(data)
               {
        $('#titleEdit').val(data.title);
         somevar = data.text;
        
         
         if (dlg === undefined)
         {
         if(tinyMCE.editors.length === 1)
         {
             dlg = tinyMCE.editors[0];
         //tinyMCE.editors[0].setContent('<p>'+somevar+'</p>');
         }
         else
         {
             dlg = tinyMCE.editors[1];
         //tinyMCE.editors[1].setContent('<p>'+somevar+'</p>');    
         }
         }
         
         dlg.setContent('<p>'+somevar+'</p>');
         $("#fileEdit").val('');
        if(data.status == 1)
        {
        $('#statusEdit').val('Active');
        }
        else
        {
        $('#statusEdit').val('Passive');
        }                  
               },
               error:function() { alert('error'); }                          
               });
        
                   
        }
          
            }); 
    // here it is

        $("#dialog2").dialog("open");
      //  alert(somevar);
         
});

// ================================= END edit link =============================


// ================================= add new value button ======================

$("#button_trigger").click( function(e) {
            e.preventDefault();   
            $("#dialog").dialog({
                 autoOpen: false,
    title: 'ADD',
    draggable: true,
    width : 700,
    height : 600, 
    resizable : true,
    modal : true,
   
     open: function(){
        
        tinymce.init({  
            selector:'#nov',
            setup: function (editor) {
            editor.on('change', function () {
            editor.save();
        });
    }
        });
        tinyMCE.activeEditor.setContent('');
       
        },
       
        
        close : function() {
       //   document.getElementById('title').innerHTML = '';
        //  document.getElementById('text').innerHTML = '';
       
        $('#title').val('');
        //tinyMCE.activeEditor.setContent(' html');
        tinyMCE.activeEditor.setContent('');
        $("#status").val('Active');
        $("#file").val('');
       
        }
        
});       
//    $("#dialog").load($(this).attr('href') , function() {
    

        $("#dialog").dialog("open");
        
  //  });
  
});

// ==============================END add new value button ======================

 // ================================== delete ===============================
    
    //   <td> <a href="" class="deleteThisShit" >delete value</a></td>  
    $(".deleteThisShit").click( function(e) {
      e.preventDefault(e);
      
    var id = $(this).attr('href');
    //  $(this).attr('href')='';
     
        var url2 = "http://laravelproject/public/"+id;
               $.ajax({
               method:'GET',
               url:url2,            
               success:function()
               {
                   
                   $('#rowId'+id).remove();
                   
               },
               error:function() { alert('error'); }
                          
               });
      
      
      
    });
    
    
    
    // ============================== end delete ===============================
   

// ============================== edit =========================================

$("#ffedit").submit(function(e)
    {
  
            
       var  url3 = "http://laravelproject/public/editList";
     
           e.preventDefault(e);    
       var fileform = new FormData();
       fileform.append('file', document.getElementById('fileEdit').files[0]); 
       var list = document.getElementById('statusEdit');
       var $stat = list.options[list.selectedIndex].text;
    //   alert($('#novEdit').val());
      // alert(dlg.getContent());
   
         $.ajax({
               method:'POST',
               url:url3,
               cache:false,
               data:{title:$('#titleEdit').val(),
                     text:dlg.getContent(),
                     idd:globalEdit,
                     status: $stat
            },
             beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

        if (token) {
                 return xhr.setRequestHeader('X-CSRF-TOKEN', token);           }
       },
              success:function(data){
                  console.log(data.idL); 
                  console.log(data.title); 
                  console.log(data.text); 
                  console.log(data.status); 
                  console.log(data.date); 
  
    // 
       var  url2 = "http://laravelproject/public/ajaxListEdit/"+data.idL;
                      $.ajax({
               method:'POST',
               contentType: false,
               processData: false,
               url:url2,      
               cache: false,
               data:fileform,
               success:function(data2)
               {
                   
                  console.log('success'+data2.ext);
                  ext = data2.ext;
                  
                  document.getElementById('id'+data.idL).innerHTML = data.idL;
              
             var  tit =  '<a href="http://laravelproject/public/watchNews/'+data.idL+'">'+data.title+'</a>';
                    document.getElementById('title'+data.idL).innerHTML = tit;
                  
                  
                  if (data.status == 1)
                    {
                    document.getElementById('status'+data.idL).innerHTML = 'Active';
                    }
                    else
                    {
                     document.getElementById('status'+data.idL).innerHTML ='Passive';
                    }
                if(ext !== undefined)
                {
                 
//                   var pic1 = new Image();
//                    pic1.src = '/public/files/resized/image'+data.idL+'.'+ext+'#'+new Date().valueOf();
//                    alert(pic1.src);
                    document.getElementById('img'+data.idL).innerHTML = '';
                 
                   // $('#img'+data.idL).append(pic1);
                  
              //   var im = '<img src="/public/files/resized/image'+data.idL+'.'+ext+"#"+new Date().valueOf()+'" alt="no picture" />';
             //  alert(im+'   '+'img'+data.idL);
                 
              //   document.getElementById('img'+data.idL).innerHTML = '';
                 //  document.getElementById('img'+data.idL).innerHTML = im;
               //  alert('<img src="/public/files/resized/image'+data2.addid+'.'+ext+'" alt="no picture" />');
                $('#img'+data.idL).html('<img src="/public/files/resized/image'+data2.addid+'.'+ext+'" alt="no picture" />');
               }
               
// ===================================== third ajax ============================
var  url3 = "http://laravelproject/public/changeName/"+data2.addid;
$.ajax({
               method:'GET',
               url:url3,      
               cache: false,
               success:function(data3)
               {
                 //  alert(data3.chg);
               },
               error:function() { alert('error'); } 
});
// ===================================== end third ajax ========================
               
               
                    $("#dialog2").dialog("close");                     
               },
               error:function() { alert('error'); }          
                });
                 
    //      ========================= end second ajax =================     
    
                       
              },
              
               error:function() { alert('error'); }
           });
     
        });


// ============================== end edit =====================================




//============================ insert ==========================================
$("#ff").submit(function(e)
    {    
    var    url = "http://laravelproject/public/add";
     
           e.preventDefault(e);    
        var ext;
       var list = document.getElementById('status');
        var $stat = list.options[list.selectedIndex].text;
       var fileform = new FormData();
       fileform.append('file', document.getElementById('file').files[0]);
 
          $.ajax({
               method:'POST',
               url:url,
           //    contentType: false,
           //    processData: false,
               data:{title:$('#title').val(),
                    text:$('#nov').val(),
                   // file: fileform.get('file'),
                    status: $stat
                    
                },
             beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

        if (token) {
                 return xhr.setRequestHeader('X-CSRF-TOKEN', token);           }
       },
              success:function(data){
              //  console.log(data.fileik); 
   
   
   
   //    ================ second ajax ===========================
                     var  url2 = "http://laravelproject/public/ajaxList/"+data.idL;
                      $.ajax({
               method:'POST',
               contentType: false,
               processData: false,
               url:url2,            
               data:fileform,
               success:function(data2)
               {
                  
                  console.log('success'+data2.ext);
                  ext = data2.ext;
                                 
                    var localString = '<tr id="rowId'+data.idL+'"><td id="id'+data.idL+'">'+data.idL+'</td>';
                    localString+= '<td><a id="title'+data.idL+'"  href="http://laravelproject/public/watchNews/'+data.idL+'">'+data.title+'</a> </td>"';
                    
                    
                    localString+= '<td id="img'+data.idL+'"><img src="/public/files/resized/image'+data.idL+'.'+ext+'" alt="no picture" /></td>';
                   // alert(localString);
                    if (data.status == 1)
                    {
                    localString+= '<td id="status'+data.idL+'">Active</td>';
                    }
                    else
                    {
                    localString+= '<td id="status'+data.idL+'">Passive</td>';
                    }
                    
                    localString+= '<td>'+data.date+'</td>';
                    localString+= '<td><a href="'+data.idL+'" class="dialog_trigger" id="E'+data.idL+'">edit value</a></td>';
                    localString+= '<td><a href="'+data.idL+'" class="deleteThisShit" id="D'+data.idL+'">delete value</a></td></tr>';
                  //  localString+= '<td>'+data.title+'</td>';
                  // http://laravelproject/public/'+data.idL+'" onclick="return confirm("Delete?");
                   $('#simpleList').append(localString);
                   
                   
// ============================= for delete event ==============================
                    $("#D"+data.idL).click( function(e) {
      e.preventDefault(e);     
    var id = $(this).attr('href');
        var url2 = "http://laravelproject/public/"+id;
               $.ajax({
               method:'GET',
               url:url2,            
               success:function()
               {               
                   $('#rowId'+id).remove();                  
               },
               error:function() { alert('error'); }                         
               });
    });
// ============================= for delete event end===========================               
                   
// ============================= for update event ==============================
  $("#E"+data.idL).click( function(e) {
            e.preventDefault();    
            var idd = $(this).attr('href');
            globalEdit = idd;
            $("#dialog2").dialog({
           autoOpen: false,
    title: 'EDIT',
    draggable: true,
    width : 700,
    height : 600, 
    resizable : true,
    modal : true,
     open: function(){
        
        tinymce.init({  
            selector:'#novEdit',
            setup: function (editor) {
            editor.on('change', function () {
            editor.save();
        });
    }
        });
        
        
             
       var url2 = "http://laravelproject/public/edit/"+idd;
               $.ajax({
               method:'GET',
               url:url2,            
               success:function(data)
               {
        $('#titleEdit').val(data.title);
       
        
         if (dlg === undefined)
         {
         if(tinyMCE.editors.length === 1)
         {
             dlg = tinyMCE.editors[0];
         //tinyMCE.editors[0].setContent('<p>'+somevar+'</p>');
         }
         else
         {
             dlg = tinyMCE.editors[1];
         //tinyMCE.editors[1].setContent('<p>'+somevar+'</p>');    
         }
         }
         
         dlg.setContent('<p>'+data.text+'</p>');
        
        if(data.status == 1)
        {
        $('#statusEdit').val('Active');
        }
        else
        {
        $('#statusEdit').val('Passive');
        }
        //tinyMCE.activeEditor.setContent(' html');
      
                     
               },
               error:function() { alert('error'); }                          
               });      
        }
          
            });     
  //  $("#dialog").load($(this).attr('href') , function() {
        $("#dialog2").dialog("open");
       
  //  });
});


$("#ffedit").submit(function(e)
    {
  
            
       var  url3 = "http://laravelproject/public/editList";
     
           e.preventDefault(e);    
       var fileform = new FormData();
       fileform.append('file', document.getElementById('fileEdit').files[0]); 
       var list = document.getElementById('statusEdit');
       var $stat = list.options[list.selectedIndex].text;
    // alert($('#nov').val());
          $.ajax({
               method:'POST',
               url:url3,
            
               data:{title:$('#titleEdit').val(),
                     text:dlg.getContent(),
                     idd:globalEdit,
                     status: $stat
            },
             beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

        if (token) {
                 return xhr.setRequestHeader('X-CSRF-TOKEN', token);           }
       },
              success:function(data){
                  console.log(data.idL); 
                  console.log(data.title); 
                  console.log(data.text); 
                  console.log(data.status); 
                  console.log(data.date); 
                  console.log('update on insert');
     
       var  url2 = "http://laravelproject/public/ajaxListEdit/"+data.idL;
                      $.ajax({
               method:'POST',
               contentType: false,
               processData: false,
               url:url2,            
               data:fileform,
               success:function(data2)
               {
                
                  console.log('success'+data2.ext);
                  ext = data2.ext;
                  
                  document.getElementById('id'+data.idL).innerHTML = data.idL;
              
             var  tit =  '<a href="http://laravelproject/public/watchNews/'+data.idL+'">'+data.title+'</a>';
                    document.getElementById('title'+data.idL).innerHTML = tit;
                  
                  
                  if (data.status == 1)
                    {
                    document.getElementById('status'+data.idL).innerHTML = 'Active';
                    }
                    else
                    {
                     document.getElementById('status'+data.idL).innerHTML ='Passive';
                    }
                      if(ext !== undefined)
                {
                 

                    document.getElementById('img'+data.idL).innerHTML = '';

                $('#img'+data.idL).html('<img src="/public/files/resized/image'+data2.addid+'.'+ext+'" alt="no picture" />');
               }
               
// ===================================== third ajax ============================
var  url3 = "http://laravelproject/public/changeName/"+data2.addid;
$.ajax({
               method:'GET',
               url:url3,      
               cache: false,
               success:function(data3)
               {
                 //  alert(data3.chg);
               },
               error:function() { alert('error'); } 
});
// ===================================== end third ajax ========================
                    $("#dialog2").dialog("close");   
                    
                                       
                  
               },
               error:function() { alert('error'); }
                          
                });
    //      ========================= end second ajax =================         
   
                       
              },
              
               error:function() { alert('error'); }
           });
     
        });

// ============================= for update event end ==========================
                  
                   $("#dialog").dialog("close");
               },
               error:function() { alert('error'); }
                          
                });
    //      ========================= end second ajax =================         
   
                    
                    
               
              },
              
               error:function() { alert('error'); }
           });
        });
    //=============================== end insert ===============================
    
    
    
    
    
    
    
    
      
    
  
 });       
      
      </script>
       
  
    </head>
    
    
    <body>

        <table class="table table-hover"   style="border-top: 2px solid black; border-bottom: 2px solid black;">
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
            <tbody id="simpleList">
            @foreach ($listSelect as $list)
            <tr id="rowId{{$list->id}}">
                <td id="id{{$list->id}}">{{$list->id}}</td>
                <td> <a href="{{ route('watchIt', ['id'=>$list->id]) }}" id="title{{$list->id}}"> {{$list->title}}  </a> </td>
                
                
            @if(file_exists(base_path().'/public/files/resized/'."image{$list->id}.".'png'))     <td id="img{{$list->id}}">  <img src="/public/files/resized/image{{$list->id}}.png" alt="no picture" /> </td> 
            @elseif(file_exists(base_path().'/public/files/resized/'."image{$list->id}.".'jpg'))     <td id="img{{$list->id}}">  <img src="/public/files/resized/image{{$list->id}}.jpg" alt="no picture" /> </td>     
            @elseif(file_exists(base_path().'/public/files/resized/'."image{$list->id}.".'gif'))     <td id="img{{$list->id}}">  <img  src="/public/files/resized/image{{$list->id}}.gif" alt="no picture" /> </td>      
            @else <td id="img{{$list->id}}">  <img src="/public/files/resized/image{{$list->id}}.png" alt="no picture" />
            @endif     
            
                 @if($list->status == '1')      <td id="status{{$list->id}}">Active</td> @endif
                 @if($list->status == '0')      <td id="status{{$list->id}}">Passive</td> @endif
                <td>{{$list->date}}</td> 
                <td> <a  href="{{$list->id}}" class="dialog_trigger">edit value</a></td> 
<!--                {{ route('editList', ['id'=>$list->id])}}-->
                
                <td> <a href="{{$list->id}}" class="deleteThisShit" >delete value</a></td>  
                    
            </tr>
            @endforeach
            
            </tbody>
           
<!--       id="simpleList"     id="dialog_trigger"   {{ route('deleteList', ['id'=>$list->id])}}   onclick="return confirm('Delete?');"    {{ route('editList', ['id'=>$list->id])}}-->
        </table>
        
        {{ $listSelect->links() }}  
       
        <div style="margin-left: 8px; margin-bottom:8px; ">
        <a class="btn btn-default" id='button_trigger' href="" role="button">Add new value</a>
        </div>
        
<!--        {{ route ('showAddList')}}-->
         <div style="margin-left: 8px; margin-bottom:8px; ">
        <a class="btn btn-default" id='tt' href="{{ route ('ajaxview')}}" role="button">ajax text</a>
        </div>
        
        
<!--        ============================================ add ==================================================-->
<div id="dialog" hidden="true">

  
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
    
        </div>
        <!-- =============================================end add ============================================-->
       

<div id="dialog2" hidden="true">
    
    
       <form enctype="multipart/form-data" id="ffedit" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                  <label for="titleEdit">Title</label> <!-- Заголовок новини -->
            <input type="text" id ="titleEdit" placeholder="title" class="form-control" name="title">
              </div>
            
             <div class="form-group">
                 <label for="novEdit"> Text </label>  <!-- Текст новини -->
            <textarea name="text" id="novEdit" cols="15" rows="10" placeholder="text" class="form-control"></textarea> 
             </div>
            
            <div class="form-group">
                <label for="statusEdit">Status</label> <!-- Активність -->
            <select name="status" id="statusEdit" class="form-control">
                <option selected>Active</option> <!-- Активний -->
                <option>Passive</option> <!-- Пасивний -->
            </select> 
             </div>
            
             <div class="form-group">
                 <label for="fileEdit">Download image</label> <!-- Зображення -->
            <input type="file" id ="fileEdit" name="file" accept="image/jpeg,image/png" class="form-control">
            </div>
            
            <div class="form-group">
                <button class="btn btn-default" type="submit" name="add" id="addEdit" >Edit</button> 
               <button class="btn btn-default" type="reset">Reset</button>
<!--                <input type="submit" id ="sub" name="add" value="Р’С–РґРїСЂР°РІРёС‚Рё" class="btn btn-default">
                <input type="reset" id ="res" value="Р—РєРёРЅСѓС‚Рё" class="btn btn-default">-->
             </div>
             
             </form>
    
    
</div>
       
<!--       // route('addList')-->


    </body>
    
    
</html>
  