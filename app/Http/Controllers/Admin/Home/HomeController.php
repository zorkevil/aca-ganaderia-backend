<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Pantalla principal del módulo Home
     */
    public function index()
    {
        $sliders = HomeSlider::orderBy('sort_order')->get();

        $nextSortOrder = HomeSlider::max('sort_order') + 1;

        return view('admin.home.index', compact('sliders', 'nextSortOrder'));
    }
}
