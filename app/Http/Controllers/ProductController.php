<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getAddProduct(){
        return view('product.niche');
    }

    public function postAddProduct(Request $request){
        $category=$request->category;
        $title=$request->title;
        $price=$request->price;
        $photo=$request->photo;
        if($photo){
            $time=md5(time()).'.'.$photo->getClientOriginalExtension();
            $photo->move('site/uploads/niche/',$time);//photo save path to public auto save
        }
        else{
            $time=null;
        }
        $status=$request->status;
        $detail=$request->detail;
        $Product=new Product;
        $Product->category=$category;
        $Product->title=$title;
        $Product->price=$price;
        $Product->photo=$photo;
        $Product->status=$status;
        $Product->detail=$detail;
        $Product->save();
    }
  
}
