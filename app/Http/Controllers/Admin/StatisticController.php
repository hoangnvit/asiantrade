<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class StatisticController extends Controller
{
    public function category()
    {
        try {
            $categories = Category::all();
            $posts = Post::all()->count();

            $dataPoints = [];

            foreach ($categories as  $cat) {

                $posts_count = Post::Where('category_id', $cat->id)->get()->count();

                $dataPoints[] = [
                    "name" => $cat['name'],
                    // "y" => floatval($posts_count)
                    "y" => round((100 * $posts_count / $posts), 3)
                ];
            }

            return json_encode($dataPoints);
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }

    public function new_users()
    {

        $users_By_month = [];
        $current_month_num = date('m');
        try {

            for ($i = 1; $i <= $current_month_num; $i++) {
                $count = User::whereYear('created_at', date("Y"))
                    ->whereMonth('created_at', $i)
                    ->get()->count();
                array_push($users_By_month, [date("F", mktime(0, 0, 0, $i, 10)), $count]);
            }


            return json_encode($users_By_month);
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }

    public function new_posts()
    {

        $posts_By_month = [];
        $current_month_num = date('m');
        try {

            for ($i = 1; $i <= $current_month_num; $i++) {
                $count = Post::whereYear('created_at', date("Y"))
                    ->whereMonth('created_at', $i)
                    ->get()->count();
                array_push($posts_By_month, [date("F", mktime(0, 0, 0, $i, 10)), $count]);
            }


            return json_encode($posts_By_month);
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('errors');
        }
    }
    public function index()
    {

        return view('admin.usage');
    }
}
