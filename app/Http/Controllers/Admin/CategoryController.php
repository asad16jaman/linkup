<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    //

    public function index(Request $request,?int $id=null){


        $numberOfItem = $request->query("numberOfItem",3);

        $editCategory = null;
        if( $id != null ){
            $editCategory = Category::find($id);
        }

        $searchValue = $request->query("search",null);
        if( $searchValue != null ){
            $allCategories = Category::where("username","like","%".$searchValue."%")->orderBy('id','desc')->cursorPaginate($numberOfItem);
        }else{
            $allCategories = Category::orderBy('id','desc')->cursorPaginate($numberOfItem);
        };

        return view('admin.category', compact('allCategories','editCategory'));
    }


    public function store(Request $request,?int $id=null){

         if( $id != null ){
            //user edit section is hare
            $data = $request->except(['_token','img']);
            //
            
            $currentEditUser = Category::find($id);

            if($request->hasFile('img')){

            //delete if user already have profile picture...
            if( $currentEditUser->img != null ){
                Storage::delete($currentEditUser->img);
            }


            $path = $request->file('img')->store('category');
            $data['img'] = $path;
            }

            Category::where('id','=',$id)->update($data);
            return redirect()->route('admin.category')->with("success","Successfully Edit the user");
        }


        $allData = $request->except("_token",'img');

        if($request->hasFile('img')){
            $path = $request->file('img')->store('category');
            $allData['img'] = $path;
        }


        Category::create($allData);
        
        return back()->with("success","Successfully added the Category");


    }

    public function destroy(int $id){

         $data = Category::find($id);
        if($data){

            //unlink image from directory....
            Storage::delete($data->img);
            $data->delete();
        }

        return redirect()->route('admin.category')->with('success','Successfully Delete Category');


    }














    
}
