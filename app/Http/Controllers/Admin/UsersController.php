<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    //


    public function index(Request $request,?int $id = null ){

        $numberOfItem = $request->query("numberOfItem");

        

        $editUser = null;
        if( $id != null ){
            $editUser = User::find($id);
        }

        $searchValue = request()->query("search",null);
        if( $searchValue != null ){
            $allUsers = User::where("username","like","%".$searchValue."%")->orderBy('id','desc')->cursorPaginate($numberOfItem);
        }else{
            $allUsers = User::orderBy('id','desc')->cursorPaginate($numberOfItem);
        };
        // return response()->json([
        //     'urlpageitem' => $numberOfItem,
        //     'data' => $allUsers
        // ]);
        return view("admin.users",compact(['allUsers','editUser']));
    }


    public function storeUser(Request $request,? int $id = null){
        
        if( $id != null ){
            //user edit section is hare
            $data = [
                'email' => $request->email,
                'type' => $request->type,
                'fullname' => $request->fullname
            ];
            //
            if(trim($request->password) != ''){
                $data['password'] = Hash::make($request->password);
            }
            $currentEditUser = User::find($id);

            

            if($request->hasFile('picture')){

            //delete if user already have profile picture...
            if( $currentEditUser->picture != null ){
                Storage::delete($currentEditUser->picture);

            }


            $path = $request->file('picture')->store('profile');
            $data['picture'] = $path;
            }

            User::where('id','=',$id)->update($data);
            return redirect()->route('admin.users')->with("success","Successfully Edit the user");
        }


        $allData = $request->except("_token",'picture');

        if($request->hasFile('picture')){
            $path = $request->file('picture')->store('profile');
            $allData['picture'] = $path;
        }


        User::create($allData);
        
        return back()->with("success","Successfully added the user");
    }

    public function deleteUser($id){

        $user = User::find($id);
        if($user){
            $user->delete();
            return back()->with("success","successfully deleted user");
        }

        return back()->with("warning","No User Detected");
       
    }

    public function editUser($id){


        $editUser = User::find($id);
        return view("admin.userprofile",compact(['editUser']));
    }



    public function editUserStore(Request $request,int $id){
             $data = [
                'email' => $request->email,
                'type' => $request->type,
                'fullname' => $request->fullname
            ];
            //
            if(trim($request->password) != ''){
                $data['password'] = Hash::make($request->password);
            }

            $currentEditUser = User::find($id);
             if($request->hasFile('picture')){

            //delete if user already have profile picture...
            if( $currentEditUser->picture != null ){
                Storage::delete($currentEditUser->picture);

            }


            $path = $request->file('picture')->store('profile');
            $data['picture'] = $path;
            }

            User::where('id','=',$id)->update($data);


            return redirect()->route('admin.user.edit',['id' => $id])->with("success","Successfully Edit the user");

    }

    






}
