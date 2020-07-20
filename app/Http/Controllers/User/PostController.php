<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //
    public function add()
    {
        return view('user.post.create');
    }

    public function create(Request $request)
  {
    $this->validate($request, Post::$rules);

    $post = new Post;
    $form = $request->all();

    // フォームから画像が送信されてきたら、保存して、$post->image_path に画像のパスを保存する
    if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $post->image_path = basename($path);
      } else {
          $post->image_path = null;
      }
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      // データベースに保存する
      $post->fill($form);
      $post->save();

        // user/post/createにリダイレクトする
      return redirect('user/post');
  }

  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = Post::where('title', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = Post::all();
      }
      return view('user.post.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

  public function edit(Request $request)
  {
      // Post Modelからデータを取得する
      $post = Post::find($request->id);
      if (empty($post)) {
        abort(404);    
      }
      return view('user.post.edit', ['post_form' => $post]);
  }

  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Post::$rules);
      // News Modelからデータを取得する
      $post = Post::find($request->id);
      // 送信されてきたフォームデータを格納する
      $post_form = $request->all();

      if (isset($post_form['image'])) {
        $path = $request->file('image')->store('public/image');
        $post->image_path = basename($path);
        unset($post_form['image']);
      } elseif (isset($request->remove)) {
        $post->image_path = null;
        unset($post_form['remove']);
      }
      unset($post_form['_token']);

      // 該当するデータを上書きして保存する
      $post->fill($post_form)->save();

      return redirect('user/post');
  }

  public function delete(Request $request)
  {
      // 該当するPost Modelを取得
      $post = Post::find($request->id);
      // 削除する
      $post->delete();
      return redirect('user/post');
  }  

}