<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\RedirectController;
use Ramsey\Uuid\Type\Integer;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{   
    
    public function index($sort)
    {
        try {
            $user = auth()->user();

            if ($user['admin']) {
                if($sort==0)

                $users = User::all()->orderByDesc('arrived_at')->get();
                return view('admin.users')->with('users', $users);
            } else return redirect()->route('home');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }
    public function detail(int $i)
    {
        try {
            $user = auth()->user();
            if ($user['admin']) {

                $user_detail = User::find($i);
                return view('admin.users_edit')->with('user_detail', $user_detail);
            } else return redirect()->route('home');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }

    public function user_edit(Request $request)
    {


        $request->validate(
            [

                'lname' => 'required|string|max:255|min:3',
                'fname' => 'required|string|max:255|min:3',

                'address' => 'required|string|max:255|min:10',
                'postalcode' => 'required|string|max:255|min:6',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ],

            [
                'lname.min' => ' Lastname is more than 3',

                'fname.min' => ' Firstname is more than 3',
                'address.min' => ' Address is more than 10',
                'postalcode.min' => ' Postalcode is more than 6',


            ]
        );


        try {
            $user = User::find($request['id']);
            if ($image = $request->file('image')) {
                // $destinationPath = 'uploads/images/';
                // $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                // $image->move($destinationPath, $profileImage);
                // $avatar = "$profileImage";
                $avatar = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
            } else $avatar = $user['avatar'];



            // return  $profileImage ;


            $user['address'] = $request['address'];
            $user['postalcode'] = $request['postalcode'];
            $user['fname'] = $request['fname'];
            $user['lname'] = $request['lname'];
            $user['admin'] = $request['admin'];
            $user['avatar'] = $avatar;
           
            $user->save();
            return redirect()->route('admin_users');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }

    public function user_delete(int $i)
    {

        try {
            $user = auth()->user();
            if ($user['admin']) {
                if ($user['id'] !== $i) {
                    $user_delete = User::find($i);
                    $user_delete->delete();
                    return redirect()->route('admin_users');
                } else return redirect()->route('admin_users')->withErrors(['You can not delete the current user loged in!']);
            } else return redirect()->route('home');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }

    public function user_create()
    {

        return view('admin.users_create');
    }

    public function user_store(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|string|max:255|min:3|unique:users',
                'lname' => 'required|string|max:255|min:3',
                'fname' => 'required|string|max:255|min:3',
                'email' => 'required|string|email|max:255||min:3|unique:users',
                'address' => 'required|string|max:255|min:3',
                'postalcode' => 'required|string|max:255|min:3',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],
            [
                'lname.min' => ' Lastname is more than 3',
                'username.min' => ' username is more than 3',
                'email' => 'email is not correct',
                'fname.min' => ' Firstname is more than 3',
                'address.min' => ' Address is more than 10',
                'postalcode.min' => ' Postalcode is more than 6',


            ]
        );

        try {
            $user = User::create(
                [
                    'username' => $request->username,
                    'lname' => $request->lname,
                    'fname' => $request->fname,
                    'address' => $request->address,
                    'postalcode' => $request->postalcode,
                    'admin' => $request->admin,
                    'avatar' => 'http://asiantrade.herokuapp.com/uploads/images/cat_avatar_default.png',

                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]

            );



            return redirect()->route('admin_users');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }
}
