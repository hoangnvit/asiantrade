<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Reason;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class PostController extends Controller
{
    public function postsbycategory($cat_id)
    {
        try {

            $posts = Post::where('category_id', $cat_id)->where('status', 1)->simplePaginate(10);
            $cat = Category::find($cat_id);

            return view('user.postsbycat')->with('posts', $posts)->with('cat', $cat);
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }

    public function postsbyuser($user_id)
    {

        try {
            $posts = Post::where('user_id', $user_id)->orderBy('created_at', 'desc')->simplePaginate(10);
            $user = User::find($user_id);

            return view('user.postsbyuser')->with('posts', $posts)->with('user', $user);
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }

    public function detail(int $post_id)
    {
        try {

            $post = Post::Find($post_id);

            $author = User::Find($post->user_id);

            $cat = Category::find($post->category_id);


            return view('user.post')->with('post', $post)->with('author', $author)->with('cat', $cat);
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }


    public function create()
    {

        try {
            $cats = Category::where('active', 1)->get();

            return view('user.new_post')->with('cats', $cats);
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
                'price' => 'required|numeric|max:10000',


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
            } else $avatar = "https://res.cloudinary.com/dqa0rpdvp/image/upload/v1634292704/psruvyrtsmshsobug29c.jpg";

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

            return redirect()->route('home');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }

    public function search()
    {

        try {
            $cats = Category::where('active', 1)->get();
            return view('user.search_form')->with('cats', $cats);
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }

    public function search_post(Request $request)
    {
        $keyword = request('keyword');
        $cat_id = request('category_id');
        $search_field = request('search_field');

        try {

            if ($search_field == 0) {
                $items = Post::where('title', 'LIKE', '%' . $keyword . '%')->get();

                if ($cat_id == 0)

                    $items = Post::where('title', 'LIKE', '%' . $keyword . '%')->get();
                else
                    $items = Post::where('title', 'LIKE', '%' . $keyword . '%')->where('category_id', $cat_id)->get();
            } else {
                $user = User::where('username', 'LIKE', '%' . $keyword . '%')->get();


                if (count($user) > 0) {
                    if ($cat_id == 0) {

                        $items = Post::where('user_id', $user[0]->id)->get();
                    } else {

                        $items = Post::where('user_id', $user[0]->id)->where('category_id', $cat_id)->get();
                    }
                } else {

                    $items = [];
                }
            }
            // $items=Post::where('category_id', $cat_id)->get();

            return response()->json($items);
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }


    public function post_delete(Request $request)
    {
        // $post = Post::find($request['post_id']);
        $id = request('post_id');
        

        try {
            $post_delete = Post::find($id);
          
            $user = auth()->user();

            if ($user['id'] == $post_delete['user_id']) {


                // $post_delete->delete();
                
                $reason_id = request('reason_id');
               
                $r=Reason::find($reason_id);
               
                
                  $temp=$r['del_num']+1;
                
                  
                     $r['del_num']=$temp;
                    //  return $r;
                    Reason::where('id', $reason_id)->update(['del_num'=>$temp]);
                     
                    
               

                return redirect()->route('user_posts', $user['id']);
            } else return redirect()->route('home');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }


    public function post_detail(Request $request)
    {
        $post_id = request('post_id');
        try {
            $user = auth()->user();
            $post_detail = Post::find($post_id);
            $cats = Category::where('active', 1)->get();

            if ($user['id'] == $post_detail['user_id']) {

                return view('user.post_edit')->with('post_detail', $post_detail)->with('cats', $cats);
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


                // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',


            ],

        );

        try {
            $post = Post::find($request['post_id']);
            $user = auth()->user();

            if ($user['id'] == $post['user_id']) {


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

                return redirect()->route('user_posts', $user['id']);
            } else {

                return redirect()->route('home');
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }


    public function post_delete_form(Request $request){
       
        $post = Post::find($request['post_id']);
        $reasons=Reason::all();


        return view('user.post_delete')->with('post', $post)->with('reasons', $reasons);

        

    }
}
