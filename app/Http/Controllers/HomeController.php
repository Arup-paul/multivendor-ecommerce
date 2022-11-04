<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Section;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
      $sliders = Option::whereType('slider')->whereStatus(1)->get();
      return view('frontend.index',compact('sliders'));
    }
}
