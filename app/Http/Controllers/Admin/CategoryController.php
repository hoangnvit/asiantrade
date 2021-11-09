<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index($sort)
    {

        try {
            $user = auth()->user();

            if ($user['admin']) {

                if($sort==0)$categories = Category::all()->sortBy('id');
                else $categories = Category::all()->sortByDesc('id');


                return view('admin.categories')->with('categories', $categories);
            } else return redirect()->route('home');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }


    public function category_create()
    {

        return view('admin.category_create');
    }


    public function category_store(Request $request)
    {



        $request->validate(
            [
                'name' => 'required|string|max:255|min:3|unique:categories',

                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',


            ],

        );

        try {

            if ($image = $request->file('image')) {
                // $destinationPath = 'uploads/images/';
                // $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                // $image->move($destinationPath, $profileImage);
                // $avatar = "$profileImage";
                $avatar = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
               
            } else $avatar = asset('uploads/images/cat_avatar_default.png');

            $category = Category::create(
                [
                    'name' => $request->name,
                    'active' => $request->active,

                    'avatar' => $avatar,


                ]

            );

            return redirect()->route('admin_categories',0);
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }


    public function category_delete(int $i)
    {
        try {
            $user = auth()->user();
            if ($user['admin']) {

                $cat_delete = Category::find($i);
                $cat_delete->delete();
                return redirect()->route('admin_categories',0);
            } else return redirect()->route('home');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }

    public function category_detail(int $i)
    {
        try {
            $user = auth()->user();
            if ($user['admin']) {

                $cat_detail = Category::find($i);

                return view('admin.category_edit')->with('cat_detail', $cat_detail);
            } else return redirect()->route('home');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }


    public function category_edit(Request $request)
    {


        $request->validate(
            [

                'name' => 'required|string|max:255|min:3',

                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ]


        );

        try {
            $cat = Category::find($request['id']);

            if ($image = $request->file('image')) {
                $avatar = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
            } else $avatar = $cat['avatar'];






            $cat['name'] = $request['name'];
            $cat['active'] = $request['active'];
            $cat['avatar'] = $avatar;

            $a = $cat->save();

            return redirect()->route('admin_categories',0);
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }
}
