<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //

    public function index(?int $id = null){

        $numberOfItem = request()->query("numberOfItem",3);
        $searchValue = request()->query("search",null);

        $editItem = null;
        if(!is_null($id)){
            $editItem = Product::with('category')->findOrFail($id);
        }

        $categories = Category::all();

        if( $searchValue != null ){
            $products = Product::with('category')->where("name","like","%".$searchValue."%")->orderBy('id','desc')->cursorPaginate($numberOfItem);
        }else{
            $products = Product::with('category')->cursorPaginate($numberOfItem);
        }; 
        return view('admin.product',compact(['categories','products','editItem']));
    }

    public function store(Request $request,?int $id=null){
        $data = $request->only(['name','description','logn_description','category_id']);

        if(!is_null($id)){
            Product::where('id',$id)->update($data);
            return redirect()->route('admin.product')->with('success','Successfully edit');
        }

        //creating product
        $product = Product::create($data);

        //creating image from product
        
        if($request->hasFile('img')){
            $allFile = $request->file('img');
            foreach($allFile as $file){
                $path = $file->store('product');
                ProductImage::create([
                    'product_id' => $product->id,
                    'img' => $path
                ]);
            }
        }

        return response()->json([
            "success" => true,
        ]);
      
        
    }


    public function destory(int $id){
        $allimage = ProductImage::where('product_id','=',$id)->get();
        foreach($allimage as $image){
            //unlink image...
            Storage::delete($image->img);
            $image->delete();
        }
        Product::find($id)->delete();
        return redirect()->route('admin.product')->with('success','successfully deleted');
        
    }





}
