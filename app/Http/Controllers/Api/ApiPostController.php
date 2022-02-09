<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class ApiPostsController extends Controller
{
    public function apiIndex(){
        $posts = Post::all();

        return response()->json($posts); 
    }
}
