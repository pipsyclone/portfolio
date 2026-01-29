<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $profile = \App\Models\Profile::first();
        $projects = \App\Models\Projects::with(['techStacks', 'skills'])->orderBy('created_at', 'desc')->get();
        $skills = \App\Models\Skills::all();
        $techStacks = \App\Models\TechStacks::all();
        return view('welcome', compact('profile', 'projects', 'skills', 'techStacks'));
    }
}
