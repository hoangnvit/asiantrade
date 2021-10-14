<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class HomeController extends Controller
{
    public function index()
    {

        try {
            $cats = Category::where('active', 1)->get();

            return view('user.home')->with('cats', $cats);
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }
}
