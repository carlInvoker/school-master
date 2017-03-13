<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\SelectList;
use Image; 
use File;

 

class Controller1 extends Controller
{ 
    public function someName()
    {            
       $listSelect = SelectList::select(['id','title','status','date'])
               ->groupBy('id')
               ->paginate(7); 
      
//        $listSelect = Controller1::table('select_lists')
//                ->select(['id','title','status','date'])
//                ->groupBy('id')
//                ->get();
//        
        
        return view('list')->with(['listSelect' =>$listSelect]); 
    }
    
    
//    public function  ajaxList(Request $request)  for  second ajax
//    {
//        $listSelect = SelectList::find($request->idL2);
//        
//        return response()->json(array('title2'=>$listSelect->title, 'text2'=>$listSelect->text, 'status2'=>$listSelect->status,
//        'date2'=>$listSelect->date), 200);
//        
//    }


    
    
    
    
    public function edit($id)
    {      
        $listSelect = SelectList::find($id);
         return response()->json(array('title'=>$listSelect->title, 'text'=>$listSelect->text, 'status'=>$listSelect->status,
        'date'=>$listSelect->date, 'idL'=>$listSelect->id), 200);
        //return view('edit')->with(['listSelect' => $listSelect]);
    }
   
    public function watchNews($id) {
        $listSelect = SelectList::find($id);
        return view('watchNews')->with(['listSelect' => $listSelect]);
    }
  
    public function showAdd()
    {
        return view('add');
    }
   
    
   public function store( Request $request)
    {
        //dump($request->all());
        $listSelect = new SelectList;
        
        
//        $listSelect->title = $request->input('title');
//        $listSelect->text = $request->input('text');
         $listSelect->title = $request->title;
         $listSelect->text = $request->text;
        
         
//         
//        if($request->input('status') == 'Active')
//        {
//        $listSelect->status = '1';  
//        }
//        else {
//        $listSelect->status = '0'; 
//        }
        
         if($request->status == 'Active')
        {
        $listSelect->status = '1';  
        }
        else {
        $listSelect->status = '0'; 
        }
        
        
      
      $date =  date("Y-m-d H:i:s");
       $listSelect->date = $date;       
       //   $fileik =  $request->file;   , 'file'=>$fileik

    $listSelect->save();
       return response()->json(array('title'=>$listSelect->title, 'text'=>$listSelect->text, 'status'=>$listSelect->status,
        'date'=>$listSelect->date, 'idL'=>$listSelect->id), 200);
        
     
        
       
   //  return redirect()->route('list');
      //  return view('edit');
   }
   
   
   public function storePicture(Request $request, $idd)
   {
       $fileik =  $request->file('file');
       
        
        if ($fileik!=null)
        {
        
           $imageName = "image{$idd}".'.'.$fileik->getClientOriginalExtension();
          // $imageName = "image300.png";
           $path = public_path('/files/resized/'.$imageName);
           
          $imageFile =  Image::make($fileik->getRealPath())->resize(50, 50);
         $imageFile->save($path);
          return response()->json(array('ext'=>$fileik->getClientOriginalExtension()),200);
//        $request->file('file')->move(
//       base_path() . '/public/files/resized', $imageName
//       );
        
        }
   }
   
   
   
    public function editPicture(Request $request, $idd)
   {
//    
       $fileik =  $request->file('file');
       
        
        if ($fileik!=null)
        {
               if(file_exists(base_path().'/public/files/resized/'."image{$idd}.".'png'))
            {
                File::delete(base_path().'/public/files/resized/'."image{$idd}.".'png');
            }
            
            if(file_exists(base_path().'/public/files/resized/'."image{$idd}.".'jpg'))
            {
                File::delete(base_path().'/public/files/resized/'."image{$idd}.".'jpg');
            }
            
            if(file_exists(base_path().'/public/files/resized/'."image{$idd}.".'gif'))
            {
                File::delete(base_path().'/public/files/resized/'."image{$idd}.".'gif');
            }   
            $addid = $idd.'_'.uniqid(rand(),1);
           $imageName = "image{$addid}".'.'.$fileik->getClientOriginalExtension();
          // $imageName = "image300.png";
           $path = public_path('/files/resized/'.$imageName);
           
          $imageFile =  Image::make($fileik->getRealPath())->resize(50, 50);
         $imageFile->save($path);
          return response()->json(array('ext'=>$fileik->getClientOriginalExtension(), 'addid'=>$addid),200); 
        
        }
   }
   
     public function changeName($name)
   {
         $changedName = stristr($name, '_', true);
            if(file_exists(base_path().'/public/files/resized/'."image{$name}.".'png'))
            {
               rename(base_path().'/public/files/resized/'."image{$name}.".'png', base_path().'/public/files/resized/'."image{$changedName}.".'png');
            }       
            
            if(file_exists(base_path().'/public/files/resized/'."image{$name}.".'jpg'))
            {
               rename(base_path().'/public/files/resized/'."image{$name}.".'jpg', base_path().'/public/files/resized/'."image{$changedName}.".'jpg');
            }      
            
            if(file_exists(base_path().'/public/files/resized/'."image{$name}.".'gif'))
            {
               rename(base_path().'/public/files/resized/'."image{$name}.".'gif', base_path().'/public/files/resized/'."image{$changedName}.".'gif');
            }      
            return response()->json(array('chg'=>$changedName),200); 
   }
   
   
   
   
   
   public function editChange(Request $request)
   {
      // dump($request->all());
      //$listEdit = (new SelectList)->find($request->input($id));
        $listEdit = SelectList::find($request->idd);
      
       
       $listEdit->title = $request->title;
       $listEdit->text = $request->text;
        
        
        if($request->status == 'Active')
        {
        $listEdit->status = '1';  
        }
        else {
        $listEdit->status = '0'; 
        }
        
        $date =  date("Y-m-d H:i:s");
        $listEdit->date = $date;
        
             
        
        $listEdit->save();
        
          return response()->json(array('title'=>$listEdit->title, 'text'=>$listEdit->text, 'status'=>$listEdit->status,
        'date'=>$listEdit->date, 'idL'=>$listEdit->id), 200);
        

   }
   
   
   
   
   public function delete($id)
   {
   
        if(file_exists(base_path().'/public/files/resized/'."image{$id}.".'png'))
            {
                File::delete(base_path().'/public/files/resized/'."image{$id}.".'png');
            }
            
            if(file_exists(base_path().'/public/files/resized/'."image{$id}.".'jpg'))
            {
                File::delete(base_path().'/public/files/resized/'."image{$id}.".'jpg');
            }
            
            if(file_exists(base_path().'/public/files/resized/'."image{$id}.".'gif'))
            {
                File::delete(base_path().'/public/files/resized/'."image{$id}.".'gif');
            }   
       
        $listDelete = SelectList::find($id);
        if($listDelete != null)
        {
        $listDelete->delete();
       
      // return redirect()->route('list');
        }
   }
   
  
   public function viewajax(){
      return view('ajaxtest');
   }
    public function index(Request $request){
        
        
      $msg = "This is a simple message.";
    $text = $request->data1;
      return response()->json(array('msg'=> $msg, 'text'=>$text), 200);
        
   }
   
   
   
   
}
