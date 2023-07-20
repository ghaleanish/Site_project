<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;

class CategoryController extends Controller
{
    public function getAddCategory(){
        return view('Admin.add');
    }
    public function postAddCategory(Request $request){
        $title=$request->title;
        $photo=$request->photo;
        if ($photo){
            $time=md5(time()).'.'.$photo->getClientOriginalExtension();
            $photo->move('sites/uploads/files/',$time);
        }
        else{
            $time=null; 
        }
        $detail=$request->detail;
        
        $Site=new Site;
        $Site->title=$title;
        $Site->photo=$photo;
        $Site->detail=$detail;
        $Site->Save();
        return redirect()->route('getManageCategory');
    }
    public function getManageCategory(){
        $import=[
            'categories'=>Site::all()
        ];
        return view('Admin.category.manage',$import);
    }

}
