<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use Illuminate\Pagination\Paginator;

class CategoryController extends Controller
{
    public function getAddCategory(){
        return view('Admin.category.add');
    }
    public function postAddCategory(Request $request){
        $title=$request->title;
        $photo=$request->photo;
        if ($photo){
            $time=md5(time()).'.'.$photo->getClientOriginalExtension();
            $photo->move('site/uploads/category/',$time);
        }
        else{
            $time=null; 
        }
        $detail=$request->detail;
        
        $site=new Site;
        $site->title=$title;
        $site->photo=$time;
        $site->detail=$detail;
        $site->Save();
        return redirect()->route('getManageCategory');
    }
    public function getManageCategory(){
        $data=[
            'categories'=>Site::paginate(1)//all()->all collection
        ];
        return view('Admin.category.manage',$data);//fetch
    }
    public function getDeleteCategory(Site $Category){
        // dd('hello world');
        $Category->delete();
        return redirect()->route('getManageCategory');//delect
    }
    public function getEditCategory(Site $Category){
        $data=[
            'category'=>$Category
        ];
        return view('Admin.category.Edit',$data);//edit
    }
    
  
}