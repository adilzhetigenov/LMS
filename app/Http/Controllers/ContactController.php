<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact', ["name" => "John Doe", "neptun" => "ABCDEF", "email" => "john.doe@example.com"]);
    }
}
