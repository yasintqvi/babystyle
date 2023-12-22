<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Market\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::where('is_active' , 1)->get()->take(5);

        return view('app.index' , compact('sliders'));
    }
}
