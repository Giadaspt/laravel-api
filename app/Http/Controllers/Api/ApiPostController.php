<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class ApiPostController extends Controller
{
    public function apiIndex(){
        $posts = Post::paginate(4);

        return response()->json($posts); 
    }
}
