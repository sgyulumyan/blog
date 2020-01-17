<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Blog Post</title>

  <!-- Bootstrap core CSS -->
  <link href="/css/read_more/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  
  <link href="{{ asset('css/read_more/blog-post.css') }}" rel="stylesheet"> 
   <!-- For Slideshow -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark  fixed-top" >
    <div class="container">
      <a class="navbar-brand" href="#">MyBlog</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/home">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-md-8">
       
        <!-- Title -->
        <h3 class="mt-4">{{$posts->post_name}}</h3>

        <!-- Author -->
        <!-- <p class="lead">
          by
          <a href="#">Start Bootstrap</a>
        </p> -->

        <hr>

        <!-- Date/Time -->
        <p>Posted on {{$posts->created_at}}</p>
        <hr>

        <!-- Preview Image -->
        
        
        <hr>        
        <!-- Post Content -->
        {{$posts->post_body}}        
        <hr>
      <div>


        <!-- Comments Form -->
        
        <div class="card my-4" id="commentbox">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            @if(Auth::user())
            {
              <div class="form-group" >
                <input type="hidden" name="user_id" data-name="{{Auth::user()->login}}" value="{{Auth::user()->id}}" id="user_id">
                <input type="hidden" name="post_id" value="{{$posts->id}}" id="post_id">
                <input type="hidden" name="image" value="{{Auth::user()->image}}">
                <textarea class="form-control" rows="3" name="comment_body" placeholder="Write your comment here..." id="comment_body"></textarea>
              </div>
              <button type="button" class="btn btn-success" id="AddComment" onclick="clear()">Submit</button>
            }
            @else
            
              <a href="/login"><h4>You must login to write comments</h4></a>
            
            @endif
          </div>

           <!-- Single Comment -->
        @foreach($comments as $comment)
        <div class="media mb-4" >
          <div class="media-body"  >
            <h5 class="mt-0">{{$comment->user->login}}, {{$comment->created_at}}</h5>
            <p>{{$comment->comment_body}}</p>
          </div>
        </div>
        @endforeach
        </div>
        </div>
        
       


      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">Lorem Ipsum</a>
                  </li>
                  <li>
                    <a href="#">Lorem Ipsum</a>
                  </li>
                  <li>
                    <a href="#">Lorem Ipsum</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">Lorem Ipsum</a>
                  </li>
                  <li>
                    <a href="#">Lorem Ipsum</a>
                  </li>
                  <li>
                    <a href="#">Lorem Ipsum</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Side Widget</h5>
          <div class="card-body">
            You can put anything you want inside of these side widgets. 
          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-4 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  
  <script src="{{ asset('js/read_more/jquery.min.js') }}" defer></script>
  <script src="{{ asset('js/read_more/bootstrap.bundle.min.js') }}" defer></script>
  <script src="{{ asset('js/read_more/read_more.js') }}" defer></script>
<!-- For Slideshow -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>