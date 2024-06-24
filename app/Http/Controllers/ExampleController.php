<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function homepage()
    {
        return 'Welcome to the homepage';
    }

    public function aboutpage()
    {
        return 'Welcome to the aboutpage';
    }
}
