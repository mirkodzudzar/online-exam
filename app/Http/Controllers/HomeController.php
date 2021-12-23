<?php

namespace App\Http\Controllers;

use App\Models\Profession;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('home.index', [
            'professions' => Profession::all(),
        ]);
    }
}
