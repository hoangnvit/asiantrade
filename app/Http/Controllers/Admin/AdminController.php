<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        try {
            $user = auth()->user();

            if ($user['admin'])
                return view('admin.home');
            else return redirect()->route('home');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }
}
