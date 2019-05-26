<?php

namespace App\Http\Controllers;


use Request;
use Auth;
use Validator;
use Storage;
use App\Post;
use App\User;
use App\Comment;
use App\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // $posts = Post::all();
        // $comments = Comment::all();
        // $users = User::all();

        if (Auth::user()->permission == 1) {
            $posts = Post::all(); 
            $comments = Comment::all();
            $users = User::all();
              // dd($posts);
            return view('home')
        ->with("posts", $posts)
        ->with("users", $users)
        ->with("comments", $comments);
            
        }

        
        
            $id = Auth::user()->id;
            /*dd($id);*/
            $posts = Post::where('user_id', $id)->get();
            // dd($posts);
            // $posts =  DB::table('posts')->where('user_id', $id);
            // dd($posts);
            $comments = Comment::where('user_id', $id)->get();
            $users = User::all();

             return view('home')
        ->with("posts", $posts)
        ->with("users", $users)
        ->with("comments", $comments);

            
        

       
    }


    public function avatar_add()
    {
        $input = Request::all();
        // dd($input);
        $user = User::find($input["id"]);


        if(Request::file("image")){
       
     $result = Storage::disk('public')->exists('images/' . $user->image);
      if($result){
                $result = Storage::disk('public')->delete('images/' . $user->image);
            }
       $filename = time() . '.' . Request::file('image')->getClientOriginalExtension();
            Request::file('image')->move(public_path('images/'), $filename);
            $input["image"] = $filename;
    }

        // $user->update($input);

            $user->image =$filename;
            $user->save();
            // dd($user);
            return redirect("/home");
    }
}
