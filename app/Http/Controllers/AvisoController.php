<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Aviso;

class AvisoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    
}
