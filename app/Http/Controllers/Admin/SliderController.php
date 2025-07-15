<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    //

    public function index(? int $id = null ){

        $editSlider = null;
        if( $id != null ){
            $editSlider = Slider::find($id);
        }

        $allSlider = Slider::all();

        return view("admin.slider",compact("editSlider","allSlider"));
    }

    public function store(Request $request,? int $id = null ){

      if( $id != null ){
            //user edit section is hare
            $data = [
                'title' => $request->title,
                'description' => $request->description,
            ];
            //
           
            $currentEditUser = Slider::find($id);

            

            if($request->hasFile('img')){

            //delete if user already have profile picture...
            if( $currentEditUser->img != null ){
                Storage::delete($currentEditUser->img);

            }


            $path = $request->file('img')->store('slider');
            $data['img'] = $path;
            }

            Slider::where('id','=',$id)->update($data);
            return redirect()->route('admin.slider')->with("success","Successfully Edit the Slide");
        }


        $allData = $request->except("_token",'img');

        if($request->hasFile('img')){
            $path = $request->file('img')->store('slider');
            $allData['img'] = $path;
        }


        Slider::create($allData);
        
        return back()->with("success","Successfully added the Slider");
    }

    public function destroy(int $id){

        $slider = Slider::find($id);
        if($slider){
            //unlink image from directory....
            Storage::delete($slider->img);
            $slider->delete();
        }

        return redirect()->route('admin.slider')->with('success','Successfully Delete Slider Item');

    }




}
