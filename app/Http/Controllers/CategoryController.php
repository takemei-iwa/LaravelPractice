<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use宣言は外部にあるクラスをPostController内にインポートできる。
// この場合、App\Models内のPostクラスをインポートしている。
// モデルクラスの名前は単数形、それに対応するテーブル名は複数形
use App\Models\Post;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        return view('categories.index')->with(['posts' => $category->getByCategory(2)]);
    }    
}


