<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ColorFilters;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.home')
            ->with('colors', ColorFilters::all())
            ->with('category', 0)
            ->with('subcategory', 0);
    }

    public function catIndex(Request $request)
    {
        return view('pages.home')
            ->with('colors', ColorFilters::all())
            ->with('category', $request->category)
            ->with('subcategory', $request->subcategory);
    }
}
