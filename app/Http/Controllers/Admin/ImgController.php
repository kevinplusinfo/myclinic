<?php

namespace App\Http\Controllers\Admin;
use App\img;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImgController extends Controller
{
    public function img(){
        $images = Img::all();
         return view('admin.img.index' , ['images' => $images]);
    }
    public function imageuplodeform(){
                 return view('admin.img.imguplodetest' ,);
    }
    public function imageuplode(Request $request){
       $request->validate([
        'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle the uploaded file
    if ($request->hasFile('img')) {
        $image = $request->file('img');
        
        // Store the image
        $path = $image->store('images', 'public');

        // Save the image path to the database
        img::create(['img' => $path]);

        $msg = "Image Uplode Successfully...";

        return redirect()->route('img')->with('alert_success', $msg);
    } else {
        return redirect()->back()->with('error', 'Image upload failed.');
    }
}
}


/*Laravel
mysql
ajax
css
html
jquery
javascript
*/