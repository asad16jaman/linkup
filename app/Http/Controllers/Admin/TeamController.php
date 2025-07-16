<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    //

     public function index(Request $request, ?int $id = null)
    {

        $editTeam = null;
        if ($id != null) {
            $editTeam = Team::find($id);
        }

        $searchValue = $request->query("search", null);
        if ($searchValue != null) {
            $allteam = Team::where("name", "like", "%" . $searchValue . "%")->orderBy('id', 'desc')->get();
        } else {
            $allteam = Team::orderBy('id', 'desc')->get();
        }
        ;

        return view('admin.team', compact('allteam', 'editTeam'));
    }


    public function store(Request $request, ?int $id = null)
    {

        $data = $request->only(['name', 'designation','bio']);
        if ($id != null) {
            //user edit section is hare

            $currentEditUser = Team::find($id);

            if ($request->hasFile('photo')) {

                //delete if user already have profile picture...
                if ($currentEditUser->photo != null) {
                    Storage::delete($currentEditUser->photo);
                }

                $path = $request->file('photo')->store('team');
                $data['photo'] = $path;
            }

            Team::where('id', '=', $id)->update($data);
            return redirect()->route('admin.team')->with("success", "Successfully Edit the Team");
        }


      

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('team');
            $data['photo'] = $path;
        }


        Team::create($data);

        return back()->with("success", "Successfully added the team");


    }

    public function destroy(int $id)
    {

        $data = Team::find($id);
        if ($data) {

            //unlink image from directory....
            Storage::delete($data->photo);
            $data->delete();
        }



        return redirect()->route('admin.team')->with('success', 'Successfully Delete team');


    }






}
