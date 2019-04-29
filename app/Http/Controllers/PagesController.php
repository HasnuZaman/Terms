<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('pending');
    }
    public function index()
    {
        $title = "Welcome to Our World!!!";
        //return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title);
    }

    public function about()
    {
        $title = "About Us";
        return view('pages.about')->with('title', $title);
    }

}
