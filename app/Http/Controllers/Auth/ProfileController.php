<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $user = auth()->user();
        return view('auth.profile')->with('user', $user);
    }

    public function updateprofile(Request $request)
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
                'postalcode.min' => ' Postal is more than 6',


            ]
        );
        $user = auth()->user();
        if ($image = $request->file('image')) {
            // $destinationPath = 'uploads/images/';
            // $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            // $image->move($destinationPath, $profileImage);
            // $avatar = "$profileImage";
            $avatar = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
        } else $avatar =  $user['avatar'];

        // $user = auth()->user();
        $user['address'] = $request['address'];
        $user['postalcode'] = $request['postalcode'];
        $user['fname'] = $request['fname'];
        $user['lname'] = $request['lname'];
        $user['avatar'] = $avatar;
        $user->save();
        return view('auth.profile')->with('user', $user);
    }
}
