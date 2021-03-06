@extends('layouts.ui')
@section('main')
    <div class="container my-4 text-dark">
      <div class="row text-center">
        <h2>{{$post->tittle}}</h2>
        <figure class="px-5">
          <img src="https://source.unsplash.com/600x500?{{$post->category}}" alt="" class="img-fluid">
          <figcaption style="font-weight: 100 !important">Published {{$post->published_at->diffForHumans()}}</figcaption>
        </figure>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-10 ">
          {!! $post->body !!}
        </div>
      </div>
    </div>
@endsection