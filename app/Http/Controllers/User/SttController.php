<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SttController extends Controller
{
    public function get_stt(){

         if(Auth::check()) return 1;
        else return 0;;
    }
}
