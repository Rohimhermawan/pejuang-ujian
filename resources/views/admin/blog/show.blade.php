@extends('layouts.admin')
@section('main')
<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Posts</h1>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="/admin/posts" class="badge bg-primary py-1 px-2 text-white"><i width="16" height="16" data-feather="corner-down-left"></i></a>
      <a href="/admin/posts/{{$post->slug}}/edit" class="badge bg-warning py-1 px-2 text-white"><i width="16" height="16" data-feather="edit"></i></a>
      <form action="/admin/posts/{{$post->slug}}" method="POST" class="d-inline">
        @csrf
        @method('delete')
        <button type="submit" class="btn badge bg-danger py-1 px-2 text-white" onclick="return confirm('Apakah anda yakin ingin menghapus post ini?')"><i width="16" height="16" data-feather="trash-2"></i></button>
      </form>
    </div>
    <div class="card-body">
      <div class="row justify-content-center flex-column text-center">
        <h2>{{$post->tittle}}</h2>
        <figure class="px-5">
          <img src="{{asset('storage/postsImage/'.$post->category_id.'/'.$post->image)}}" alt="" class="img-fluid">
          <figcaption>Published {{$post->created_at->diffForHumans()}}</figcaption>
        </figure>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-10">
          {!! $post->body !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection