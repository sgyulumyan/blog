<?php

namespace App\Http\Controllers;

use Auth;
use Request;
use Validator;
use Storage;
use App\Post;
use App\Comment;

class CommentController extends Controller
{
    public function add()
    {
        $input = Request::all()
        // dd($input);
        $validator=Validator::make($input,[
        	'user_id'=>'required',
        	'post_id'=>'required',
            'comment_body'=>'required',

        ],[]);

        $errors = $validator->errors();
        if($validator->fails()){
           return redirect()->back()->withErrors($errors)->with('input',$input);

        }

        // if(Request::file('image')){
        //    $filename = time() . '.' . Request::file('image')->getClientOriginalExtension();
        //     Request::file('image')->move(public_path('images/'), $filename);
        //     $input["image"] = $filename;
        // }


        Comment::create($input);
        return redirect("/home");
        }


        public function edit()
        {
        	// dd($id);
        	$data = Request::all();
        	// dd($data);
        	unset($data['_token']);
        	Comment::where('id',$data['id'])->update($data);

        }

        public function delete()
        {
        	$data = Request::all();
        	unset($data['_token']);
        	Comment::where('id',$data['id'])->delete($data);
        }
}
