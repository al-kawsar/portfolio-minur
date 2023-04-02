<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    public function index()
    {
        $sliders = \App\Models\Slider::where('status', 'Active')->get();
        $profiles = \App\Models\Profile::where('status', 1)->get();
        $skills = \App\Models\Skill::all();
        $projects = \App\Models\Project::all();
        $contact = \App\Models\Contact::findOrFail($profiles);
        return view('portofolio.index', compact('sliders', 'profiles', 'skills', 'projects', 'contact'));
    }
}
