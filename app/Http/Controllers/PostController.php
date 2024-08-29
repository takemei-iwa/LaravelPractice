<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
// use宣言は外部にあるクラスをPostController内にインポートできる。
// この場合、App\Models内のPostクラスをインポートしている。
// モデルクラスの名前は単数形、それに対応するテーブル名は複数形
use App\Models\Post;
use App\Models\Category;

use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用。
    {
        // return view('posts.index')->with(['posts' => $post->getPaginateByLimit(2)]);  
       // posts.index : posts/index.blade.php
       // viewにpostsという変数を渡す
       // その中身が$post->get()

       // クライアントインスタンス生成
       $client = new \GuzzleHttp\Client();

       // GET通信するURL
       $url = 'http://teratail.com/api/v1/questions';

       // リクエスト送信と返却データの取得
       // Bearerトークンにアクセストークンを指定して認証を行う
       // クライアントインスタンス生成

$response = $client->request(
           'GET',
           $url,
           ['Bearer' => config('services.teratail.token')]
       );
        // $token = config('services.teratail.token');
        // $response = Http::withToken($token)->get($url);
        // echo "レスポンス : " . $response;
       
       // API通信で取得したデータはjson形式なので
       // PHPファイルに対応した連想配列にデコードする
       $questions = json_decode($response->getBody(), true);
       
       // index bladeに取得したデータを渡す
       return view('posts.index')->with([
           'posts' => $post->getPaginateByLimit(),
           'questions' => $questions['questions'],
       ]);
    }
    /**
     * 特定IDのpostを表示する
     *
     * @params Object Post // 引数の$postはid=1のPostインスタンス
     * @return Reposnse post view
     */
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
    }

    public function create(Category $category)
    {
        return view('posts.create')->with(['categories' => $category->get()]);
    }
    public function store(PostRequest $request, Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }    

    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
    
        return redirect('/posts/' . $post->id);
    }        

    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }    
}
