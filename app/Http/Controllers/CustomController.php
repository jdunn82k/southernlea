<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CustomWomens;
use App\CustomMens;
use App\CustomKids;
use App\CustomToddlers;
use App\CustomInfants;
use App\CustomColors;

class CustomController extends Controller
{
    public function index()
    {
        return view('pages.custom')
            ->with('custom_colors', CustomColors::all());
    }

    public function getDropdown($type)
    {
        switch($type)
        {
            case "womens_dropdown":
                $items = CustomWomens::all();
            break;

            case "mens_dropdown":
                $items = CustomMens::all();
            break;

            case "youth_dropdown":
                $items = CustomKids::all();
            break;

            case "toddler_dropdown":
                $items = CustomToddlers::all();
            break;

            case "infant_dropdown":
                $items = CustomInfants::all();
            break;

            default:
                $items = CustomWomens::all();
            break;
        }
        return $items;
    }
}
