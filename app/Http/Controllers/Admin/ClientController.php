<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    //

    public function index(?int $id=null){

        $editclient= null;
        if($id!==null){
            $editclient = Client::find($id);
        }

        $allclient= Client::paginate(10);


        return view("admin.client",compact(['editclient','allclient']));
    }

    public function store(Request $request,?int $id=null){

        $data = $request->only(['name', 'note','phone_number']);
        if ($id != null) {
            //user edit section is hare

            $currentEditUser = Client::find($id);

            if ($request->hasFile('photo')) {

                //delete if user already have profile picture...
                if ($currentEditUser->photo != null) {
                    Storage::delete($currentEditUser->photo);
                }

                $path = $request->file('photo')->store('client');
                $data['photo'] = $path;
            }

            Client::where('id', '=', $id)->update($data);
            return redirect()->route('admin.client')->with("success", "Successfully Edit the Client");
        }


      

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('client');
            $data['photo'] = $path;
        }


        Client::create($data);

        return back()->with("success", "Successfully added the Client");



    }

    public function destroy(int $id){

         $data = Client::find($id);
        if ($data) {

            //unlink image from directory....
            Storage::delete($data->photo);
            $data->delete();
        }



        return redirect()->route('admin.client')->with('success', 'Successfully Delete team');


    }






}
