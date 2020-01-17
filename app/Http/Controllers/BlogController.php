<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Validator;
use Storage;
use App\Post;
use App\User;
use App\Comment;
use App\Image;


class BlogController extends Controller
{
    public function index()
    {
    	$posts = Post::with('user')->Paginate(3);
    	return view('blog')
    	->with("posts", $posts);
    }

    public function read_more($id)
    {
    	$post = Post::find($id);
        $comments = Comment::with('user')->where('post_id', $id)->get();


    	return view('read_more')
    	->with('posts', $post)
        ->with('comments', $comments);
    }

    public function readmore_addcomment()
   {
        $data = Request::all();
        $id = $data['post_id'];
        $post = Post::find($id);
        // $comments = DB::table('comments')->where('post_id', $id)->get();
        $comments = Comment::with('user')->where('post_id', $id)->get();
        unset($data['_token']);
        $comment =Comment::create($data);
        if ($comment) {
            return response()->json(['success'=>true,'comment'=>$comment,]);
        }
        // return view("/forum/readmore")
        // ->with('posts', $post)
        // ->with('comments', $comments);
   }

   public function search(Request $request)
   {
      // $search = $request->get('search');
        // $search = $request->input('search');

       // dd($search);
      $posts = Post::where('post_name', 'LIKE', "%".Request::input("search")."%")->Paginate(3);

      return view('blog')
      ->with('posts', $posts);
   }
}
