<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Reason;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        try {
            $user = auth()->user();

            if ($user['admin']) {

                $posts = Post::all();
                return view('admin.posts')->with('posts', $posts);
            } else return redirect()->route('home');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }

    public function post_create()
    {
        try {
            $cats = Category::where('active', 1)->get();

            return view('admin.post_create')->with('cats', $cats);
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }




    public function post_store(Request $request)
    {



        $request->validate(
            [
                'title' => 'required|string|min:5',
                'description' => 'required|string|min:5',
                'content' => 'required|string|min:5',
                'price' => 'required|numeric',


                 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',


            ],

        );

        try {
            $user = auth()->user();

            if ($image = $request->file('image')) {
                // $destinationPath = 'uploads/images/';
                // $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                // $image->move($destinationPath, $profileImage);
                // $avatar = "$profileImage";
                $avatar = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
            } else $avatar = 'https://res.cloudinary.com/dqa0rpdvp/image/upload/v1634292704/psruvyrtsmshsobug29c.jpg';

            $post = Post::create(
                [
                    'title' => $request->title,
                    'description' => $request->description,
                    'content' => $request->content,
                    'price' => $request->price,
                    'status' => $request->active,
                    'category_id' => $request->category_id,
                    'user_id' => $user['id'],


                    'avatar' => $avatar,


                ]

            );

            return redirect()->route('admin_posts');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }


    // public function post_delete(int $i)
    // {
    //     try {
    //         $user = auth()->user();
    //         if ($user['admin']) {

    //             $post_delete = Post::find($i);
    //             $post_delete->delete();
    //             return redirect()->route('admin_posts');
    //         } else return redirect()->route('home');
    //     } catch (\Illuminate\Database\QueryException $ex) {
    //         return view('errors');
    //     }
    // }

    
    public function post_delete(Request $request)
    {
        try {
            $user = auth()->user();
            if ($user['admin']) {

                // $post = Post::find($request['post_id']);
        $id = request('post_id');
        
        // try {
            $post_delete = Post::find($id);
          
      
                $post_delete->delete();
                
                $reason_id = request('reason_id');
               
                $r=Reason::find($reason_id);
               
                
                  $temp=$r['del_num']+1;
                
                  
                     $r['del_num']=$temp;
                
                     $r->save();
                     
                    // return $r;

                return redirect()->route('admin_posts');
            
            } else return redirect()->route('home');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }
       
               

   


    public function post_detail(int $i)
    {
        try {
            $user = auth()->user();
            $cats = Category::where('active', 1)->get();
            if ($user['admin']) {

                $post_detail = Post::find($i);

                return view('admin.post_edit')->with('post_detail', $post_detail)->with('cats', $cats);
            } else return redirect()->route('home');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }

    public function post_edit(Request $request)
    {



        $request->validate(
            [
                'title' => 'required|string|min:5',
                'description' => 'required|string|min:5',
                'content' => 'required|string|min:5',
                'price' => 'required|numeric',


                 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',


            ],

        );

        try {
            $post = Post::find($request['id']);


            if ($image = $request->file('image')) {
                // $destinationPath = 'uploads/images/';
                // $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                // $image->move($destinationPath, $profileImage);
                // $avatar = "$profileImage";
                $avatar = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
               
            } else $avatar = $post['avatar'];






            $post['title'] = $request['title'];
            $post['description'] = $request['description'];
            $post['content'] = $request['content'];
            $post['status'] = $request['status'];
            $post['price'] = $request['price'];
            $post['category_id'] = $request['category_id'];


            $post['avatar'] = $avatar;


            $a = $post->save();

            return redirect()->route('admin_posts');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }

    public function post_delete_form(Request $request){
       
        $post = Post::find($request['post_id']);
        $reasons=Reason::all();


        return view('admin.post_delete')->with('post', $post)->with('reasons', $reasons);

        

    }
}
