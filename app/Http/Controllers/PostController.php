<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostCollection;
use App\Post;
use App\Imports\PostsImport;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;

class PostController extends Controller
{
    public function store(Request $request)
    {
      if ($request->hasFile('uploadedFile')) {
        $file = $request->file('uploadedFile');
        $collection = (new FastExcel)->import($file);
        $data = [];

        $objectHeader = array(
          "x" => "Dates",
          "y1" => "RON95",
          "y2" => "RON97",
          "y3" => "Diesel",
        );
        $data[] = $objectHeader;

        foreach($collection as $row) {         
          if ($row["Dates"] != "" && $row["RON95"] != "" && $row["RON97"] != "" && $row["Diesel"] !== "") {
            $object = array(
              "x" => $row["Dates"]->format('Y-m-d'),
              "y1" => $row["RON95"],
              "y2" => $row["RON97"],
              "y3" => $row["Diesel"]
            );
            $data[] = $object;
          }
        }
        $data_saved = json_encode($data);
        // return response()->json(array("status" => 1, "messages" => "Success Insert Data", "Data" => $data_saved));

        $post = new Post([
          'title' => $request->get('title'),
          'date_created' => $request->get('date_created'),
          'description' => $request->get('description'),
          'keywords' => $request->get('keywords'),
          'data_source' => $file->getClientOriginalName(),
          'articles' => $request->get('articles'),
          'data_saved' => $data_saved,
        ]);
  
        $post->save();
      }else{
        return response()->json(array("status" => 0, "messages" => "File Not Found"));
      }
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

    public function import(Request $request) {

     
    }
}
