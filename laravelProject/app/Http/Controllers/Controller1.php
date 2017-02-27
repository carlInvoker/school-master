<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\SelectList;
use Image; 
use File;
class Controller1 extends Controller
{
    //
    
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
    
    public function edit($id)
    {      
        $listSelect = SelectList::find($id);
        return view('edit')->with(['listSelect' => $listSelect]);
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
       // dump($request->all());
        $listSelect = new SelectList;
        $listSelect->title = $request->input('title');
        $listSelect->text = $request->input('text');
        
        
        if($request->input('status') == 'Active')
        {
        $listSelect->status = '1';  
        }
        else {
        $listSelect->status = '0'; 
        }
        
        $date =  date("Y-m-d H:i:s");
        $listSelect->date = $date;
        
        
        
        
        $listSelect->save();
        
        
       $id = $listSelect->id;
        
        if ($request->file('file')!=null)
        {
        
           $imageName = "image{$id}".'.'.$request->file('file')->getClientOriginalExtension();
           
           $path = public_path('/files/resized/'.$imageName);
           
          $imageFile =  Image::make($request->file('file')->getRealPath())->resize(50, 50);
        
        // $imageFile->resize(50,50);
         $imageFile->save($path);
          
//        $request->file('file')->move(
//       base_path() . '/public/files/resized', $imageName
//       );
        
        }
        
        
       return redirect()->route('list');
      //  return view('edit');
   }
   
   public function editChange(Request $request, $id)
   {
      // dump($request->all());
      //$listEdit = (new SelectList)->find($request->input($id));
        $listEdit = SelectList::find($id);
      
       
       $listEdit->title = $request->input('title');
       $listEdit->text = $request->input('text');
        
        
        if($request->input('status') == 'Active')
        {
        $listEdit->status = '1';  
        }
        else {
        $listEdit->status = '0'; 
        }
        
        $date =  date("Y-m-d H:i:s");
        $listEdit->date = $date;
        
             
        
        $listEdit->save();
        
        if ($request->file('file')!=null)
        {
            
//        $imageName = "image{$id}".'.'.$request->file('file')->getClientOriginalExtension();
//
//        $request->file('file')->move(
//        base_path() . '/public/files', $imageName
//        );
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
            
             $imageName = "image{$id}".'.'.$request->file('file')->getClientOriginalExtension();
           
           $path = public_path('/files/resized/'.$imageName);
           
          $imageFile =  Image::make($request->file('file')->getRealPath())->resize(50, 50);
        
        // $imageFile->resize(50,50);
         $imageFile->save($path);
        
        
        }
        
        return redirect()->route('list');

   }
   
   
   
   
   public function delete($id)
   {
   
        $listDelete = SelectList::find($id);
        if($listDelete != null)
        {
        $listDelete->delete();
       
       return redirect()->route('list');
        }
   }
   
   
   
}
