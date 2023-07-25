<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\str;
class MediaController extends Controller
{
    public function getAddMedia(){
        return view('Admin.Social.media');
    }
    public function postAddMedia(Request $request){
        $validator=Validator::make ($request->all(),[

        ]);
        if ($validator->fails()){
            return redirect()->back()->withError($validator)-withInput();
        }
        $title=$request->title;
        $link=$request->link;

        $icon=$request->icon;
        if($icon){
            $time=md5(time()).'.'.$icon->getClientOriginalExtension();
            $icon->move('site/uploads/media',$time);
        }
        else{
            $time=null;
        }
      
        
        

        $media= new Media;
        $media->title=$title;
        $media->link=$link;
        $media->icon=$icon;
        $media->save();
    }

}
