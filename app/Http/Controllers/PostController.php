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
        return $post->get();//$postの中身を戻り値にする。
    }
}
