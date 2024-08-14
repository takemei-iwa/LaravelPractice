<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use宣言は外部にあるクラスをPostController内にインポートできる。
// この場合、App\Models内のPostクラスをインポートしている。
// モデルクラスの名前は単数形、それに対応するテーブル名は複数形
use App\Models\Post;

class PostController extends Controller
{
    public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用。
    {
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit(2)]);  
       // posts.index : posts/index.blade.php
       // viewにpostsという変数を渡す
       // その中身が$post->get()
    }
}
