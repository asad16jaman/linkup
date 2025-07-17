<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Team;
use App\Models\About;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index(){

        $carousels =Slider::all();
        $about = About::all()->first();
        $services = Category::all();
        $projects = Product::with('image')->get();
        $teams = Team::all();
        $clients = Client::all();

        
        
        return view("user.home",compact(['carousels','about','services','projects','teams','clients']));
    }


}
