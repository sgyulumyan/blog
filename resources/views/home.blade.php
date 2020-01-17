@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">  {{ Auth::user()->name }} {{Auth::user()->surname}}`s Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card my-4 col-md-4">
  <h5 class="card-header">Choose New Image For You Avatar</h5>
  <div class="card-body">
<form action="/avatar" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{Auth::user()->id}}">
            <input type="file" name="image">

            <input type="submit" class="btn btn-success" value="Save">
        </form>
        </div>
</div>
<!-- posts Table -->
<table class="table">
            <tr>
                <th>Post id</th>
                <th>User login</th>
                <th>User image</th>
                <th>Post title</th>
                <th>Post</th>
                <th>Operations</th>

            </tr>
           @foreach($posts as $post)

            <tr>

                <td>{{$post->id}}</td>
                <td>{{$post->user->login}}</td>
                <!-- <td><img src="/images/{{Auth::user()->image}}" alt=""></td>    -->
                <td><img src="/images/{{$post->user->image}}" alt=""></td>
                <td id="post_name_{{$post->id}}">{{$post->post_name}}</td>
                <td id="post_{{$post->id}}">{{$post->post_body}}</td>
                <td>
                    <button type="button" data-id="{{$post->id}}"  class="btn btn-primary post_edit" data-toggle="modal" >Edit
                    </button>
                    <button type="button" data-id="{{$post->id}}"  class="btn btn-danger post_delete" data-toggle="modal" >Delete
                    </button>
                </td>

             </tr>

            @endforeach

</table>
<!-- posts table end -->
<!-- post edit modal beginning -->
<div class="modal" id="Post_Edit_Modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <input type="text" name="" id="edit_name" value="">
        <textarea id="edit_post"></textarea>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-id=""  data-dismiss="modal" id="edit_post_Changes">Edit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- post edit modal  end -->

<!-- posts delete modal begining -->
<div class="modal" id="Post_Delete_Modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Post Deleting</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <textarea id="delete_post"></textarea>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-id=""  data-dismiss="modal"
        id="delete_post_Changes">Delete</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- posts delete modal ending-->
<hr >
<div class="row justify-content-center col-md-4 card">
  <div class="card-header">Add post</div>
  <div class="card-body">
<form action="/home/post/add" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"><br><br>
            <input type="text" name="post_name" placeholder="Name"><br><br>

            <textarea  class="form-control" rows="3" name="post_body"  placeholder="Write yout post here"></textarea>
            <input type="submit" class="btn btn-success" value="Add new post">

            @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
@endif

</form>
</div>

</div>

<!-- comments table -->
<hr >
<table class="table">
    <tr>
        <th>User login</th>
        <th>User image</th>
        <th>Post name</th>
        <th>Comment</th>
        <th>Operations</th>
    </tr>

    @foreach($comments as $comment)
         @if($comment -> user_id ==  Auth::user()->id)
         <tr>
            <td>{{$comment->user->login}}</td>
            <td><img  height="40" width="40" src="/images/{{Auth::user()->image}}"></td>
            <td>{{$comment->post->post_name}}</td>
            <td id="comment_{{$comment->id}}">{{$comment->comment_body}}</td>
            <td>
                <button type="button" data-id="{{$comment->id}}"  class="btn btn-primary comment_edit" data-toggle="modal" >Edit
                </button>
                 <button type="button" data-id="{{$comment->id}}"
                  class="btn btn-danger comment_delete" data-toggle="modal" >Delete
                </button>
            </td>

         </tr>
         @endif
     @endforeach

</table>
<!-- comments table end -->

<!-- Comment adding form beginning -->
<div class="row  col-md-4 card">
  <div class="card-header"> Add comments</div>
  <div class="card-body">
<form action="/home/comment/add" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"><br><br>
            <select name="post_id">
                <option>Select Post</option>
            @foreach($posts as $post)
                <option value="{{$post->id}}">{{$post->post_name}}</option>
            @endforeach
             </select>

            <textarea class="form-control" rows="5"  name="comment_body"  placeholder="Write yout comment here"></textarea>
            <input type="submit" class="btn btn-success" value="Add new comment">

</form>
</div>
<!-- Comment adding form ending -->

<!-- comment edit modal beginning -->
<div class="modal" id="Comment_Edit_Modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Comment Editing</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <!-- <input type="text" name="" id="edit_title" value=""> -->
        <textarea id="edit_comment"></textarea>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-id=""  data-dismiss="modal" id="edit_comment_Changes">Edit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- comment edit modal  end -->


</div>
 <!-- comments delete modal begining -->
<div class="modal" id="Comment_Delete_Modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Comment Deleting</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <!-- <input type="text" name="" id="edit_title" value=""> -->
        <textarea id="delete_comment"></textarea>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-id=""  data-dismiss="modal"
        id="delete_comment_Changes">Delete</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- comments delete modal ending-->


@endsection
