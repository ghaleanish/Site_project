<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class ProductController extends Controller
{
    public function getAddProduct(){
        return view('Admin.product.niche');
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

        $product=new Product;
        $product->category=$category;
        $product->title=$title;
        $product->price=$price;
        $product->photo=$time;
        $product->status=$status;
        $product->detail=$detail;
        $product->save();
        return redirect()->route('getManageProduct');
        
    }
    public function getManageProduct(){
       
        $data=[
            'products'=>product::paginate(2)
        ];
        return view('Admin.product.manageproduct',$data);
    }
    public function getDeleteProduct(Product $product){
        $product->delete();
        return redirect()->route('getManageProduct');

    }
    public function getEditProduct(Product $product){
        $data=[
            'product'=>$product
        ];
        return view('Admin.product.editproduct',$data);
    }
  
}
