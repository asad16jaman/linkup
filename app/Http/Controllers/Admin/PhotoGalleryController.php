<?php

namespace App\Http\Controllers\Admin;

use App\Models\PhotoGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PhotoGalleryController extends Controller
{
    //


    public function index(Request $request, ?int $id = null){

        $numberOfItem = $request->query("numberOfItem", 3);
        $editgallery = null;
        if ($id != null) {
            $editgallery = PhotoGallery::find($id);
        }

        $searchValue = $request->query("search", null);
        if ($searchValue != null) {
            $allgallery = PhotoGallery::where("title", "like", "%" . $searchValue . "%")->orderBy('id', 'desc')->cursorPaginate($numberOfItem);
        } else {
            $allgallery = PhotoGallery::orderBy('id', 'desc')->cursorPaginate($numberOfItem);
        }
        
       

        return view('admin.photogallery', compact('allgallery', 'editgallery'));
    }




    public function store(Request $request, ?int $id = null)
    {

        $data = $request->only(['title', 'description']);

        if ($id != null) {
            //user edit section is hare
            $currentEditUser = PhotoGallery::find($id);

            if ($request->hasFile('img')) {

                //delete if user already have profile picture...
                if ($currentEditUser->img != null) {
                    Storage::delete($currentEditUser->img);
                }

                $path = $request->file('img')->store('photogallery');
                $data['img'] = $path;
            }

            PhotoGallery::where('id', '=', $id)->update($data);
            return redirect()->route('admin.photogallery')->with("success", "Successfully Edit the user");
        }



        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('photogallery');
            $data['img'] = $path;
        }
        PhotoGallery::create($data);
        return back()->with("success", "Successfully added the Category");

    }

    public function destroy(int $id)
    {

        $data = PhotoGallery::find($id);
        if ($data) {

            //unlink image from directory....
            Storage::delete($data->img);
            $data->delete();
        }

        return redirect()->route('admin.photogallery')->with('success', 'Successfully Delete Category');
    }









}
