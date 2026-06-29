<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use App\Models\Bootcamp;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        $scholarships = Scholarship::where('status', 'published')->latest()->take(6)->get();
        $bootcamps    = Bootcamp::where('status', 'published')->latest()->take(6)->get();
        $news         = News::where('status', 'published')->latest()->take(5)->get();

        return view('home', compact('scholarships', 'bootcamps', 'news'));
    }
}

