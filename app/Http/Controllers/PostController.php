<?php

namespace App\Http\Controllers;

use Auth;
use Request;
use Validator;
use Storage;
use App\Post;
use App\Comment;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(PostRequest $request)
    {
        $validatedData = $request->validated();
            

        // $validator=Validator::make($input,[
        //     'post_name'=>'required',
        //     'post_body'=>'required',
            
        // ],[]);
        
        // $errors = $validator->errors();
        // if($validator->fails()){
        //    return redirect()->back()->withErrors($errors)->with('input',$input);  
        
        // }

        // if(Request::file('image')){
        //    $filename = time() . '.' . Request::file('image')->getClientOriginalExtension();
        //     Request::file('image')->move(public_path('images/'), $filename);
        //     $input["image"] = $filename;
        // }
        
        
        Post::create($validatedData);
        return redirect("/home");
        }

        // public function store(PostRequest $request)
        // {
        //     $validatedData = $request->validated();
        //     \App\Post::create($validatedData);

        //     return response()->json('Form is successfully validated and data has been saved');
        // }
 
         public function edit()
        {
            // dd($id);
            $data = Request::all();
            // dd($data);
            unset($data['_token']);
            Post::where('id',$data['id'])->update($data);

        }

        public function delete()
        {
           $data = Request::all(); 
           unset($data['_token']);
           Post::where('id',$data['id'])->delete();
        }

}
