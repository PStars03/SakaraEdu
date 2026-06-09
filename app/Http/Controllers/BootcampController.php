<?php

namespace App\Http\Controllers;

use App\Models\Bootcamp;
use Illuminate\Http\Request;

class BootcampController extends Controller
{
    public function index()
    {
        return view('bootcamps.index');
    }

    public function show($slug)
    {
        $bootcamp = Bootcamp::where('slug', $slug)->where('status', 'published')->firstOrFail();
        return view('bootcamps.show', compact('bootcamp'));
    }
}
