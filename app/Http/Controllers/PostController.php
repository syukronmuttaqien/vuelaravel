<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostCollection;
use App\Post;
use App\Imports\PostsImport;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{
    public function store(Request $request)
    {
      $post = new Post([
        'title' => $request->get('title'),
        'date_created' => $request->get('date_created'),
        'description' => $request->get('description'),
        'keywords' => $request->get('keywords'),
        'data_source' => $request->get('data_source'),
        'articles' => $request->get('articles'),
      ]);

      $post->save();

      //$file = $request->file('file')[0]['name'];

      //$data = Excel::toArray(new PostsImport, request()->file('file'), );

      //return response()->json($file);

      //$post->save();

      //$data = Excel::toArray(new PostsImport, $file);

      return response()->json('Success Insert');
    }

    public function index()
    {
      return new PostCollection(Post::all());
    }

    public function edit($id)
    {
      $post = Post::find($id);
      return response()->json($post);
    }

    public function update($id, Request $request)
    {
      $post = Post::find($id);

      $post->update($request->all());

      return response()->json('successfully updated');
    }

    public function delete($id)
    {
      $post = Post::find($id);

      $post->delete();

      return response()->json('successfully deleted');
    }
}
