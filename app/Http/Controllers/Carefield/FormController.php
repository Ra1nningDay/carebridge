<?php

namespace App\Http\Controllers\Carefield;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormController extends Controller
{
    Public function index ()
    {
        return view('carefield.form');
    }
}
