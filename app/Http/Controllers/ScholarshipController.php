<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    public function index()
    {
        return view('scholarships.index');
    }

    public function show($slug)
    {
        $scholarship = Scholarship::where('slug', $slug)->where('status', 'published')->firstOrFail();
        return view('scholarships.show', compact('scholarship'));
    }
}
