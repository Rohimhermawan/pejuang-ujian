@extends('layouts.ui')
@section('main')
@if ($data->count() > 3)
<div id="carouselExampleSlidesOnly" class="carousel slide mb-5" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://source.unsplash.com/1200x500?{{$data[0]->category}}" class="d-block w-100 img-fluid" alt="...">
      <div class="carousel-caption d-block">
        <h5>{{$data[0]->tittle}}</h5>
        <p>{{$data[0]->excerpt}}</p>
        <a href="/features/{{request('feature')}}/{{$data[0]->slug}}" class="btn btn-primary">Get to Know</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/1200x500?{{$data[1]->category}}" class="d-block w-100" alt="...">
      <div class="carousel-caption d-block">
        <h5>{{$data[1]->tittle}}</h5>
        <p>{{$data[1]->excerpt}}</p>
        <a href="/features/{{request('feature')}}/{{$data[1]->slug}}" class="btn btn-primary">Get to Know</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/1200x500?{{$data[2]->category}}" class="d-block w-100" alt="...">
      <div class="carousel-caption d-block">
        <h5>{{$data[2]->tittle}}</h5>
        <p>{{$data[2]->excerpt}}</p>
        <a href="/features/{{request('feature')}}/{{$data[2]->slug}}" class="btn btn-primary">Get to Know</a>
      </div>
    </div>
  </div>
</div>
@endif
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <form action="/features">
        <div class="input-group my-4">
          <input type="text" class="form-control" name="feature" placeholder="What are you looking for?" value="{{request('feature')}}" hidden>
          <select class="form-select" name="category">
            <option value="">All</option>
            @foreach ($categories as $category)
            @if (request('category') == $category->slug))
            <option value="{{$category->slug}}" selected>{{$category->name}}</option>
            @else
            <option value="{{$category->slug}}">{{$category->name}}</option>
            @endif
            @endforeach
          </select>
          <select class="form-select" name="material">
            <option value="">All</option>
            @foreach ($materials as $materials)
            @if (request('material') == $materials->slug))
            <option value="{{$materials->slug}}" selected>{{$materials->name}}</option>
            @else
            <option value="{{$materials->slug}}">{{$materials->name}}</option>
            @endif
            @endforeach
          </select>
          <input type="text" class="form-control" name="search" placeholder="What are you looking for?" value="{{request('search')}}">
          <button class="btn btn-outline-primary" type="submit">Search</button>
        </div>
      </form>
      @if ($data->count() == 0)
      <div class="alert alert-danger mb-5" role="alert">
        Mohon maaf, postingan yang anda cari belum ada dalam website kami.
      </div>
      @endif
    </div>
  </div>
  <div class="row justify-content-center">
    @if ($data->count() > 3)
    @foreach ($data->skip(3) as $post)    
    <div class="col-md-4 mb-3">
      <div class="card">
        <img src="https://source.unsplash.com/500x400?{{$post->category}}" class="card-img-top" alt="...">
        <div class="card-body">
          {{'#'.$post->material->name.' #'.$post->category->name}}
          <h5>{{$post->tittle}}</h5>
            <p>{{$post->excerpt}}</p>
            <a href="/features/{{request('feature')}}/{{$post->slug}}" class="btn btn-primary">Get to Know</a>
        </div>
      </div>
    </div>
    @endforeach
    @else
    @foreach ($data as $post)    
    <div class="col-md-4 mb-3">
      <div class="card">
        <img src="https://source.unsplash.com/500x400?{{$post->category}}" class="card-img-top" alt="...">
        <div class="card-body">
          {{'#'.$post->material->name.' #'.$post->category->name}}
          <h5>{{$post->tittle}}</h5>
            <p>{{$post->excerpt}}</p>
            <a href="/features/{{request('feature')}}/{{$post->slug}}" class="btn btn-primary">Get to Know</a>
        </div>
      </div>
    </div>
    @endforeach   
    @endif
  </div>
  <div class="d-flex justify-content-center">
    {{ $data->links() }}
  </div>
</div>
@endsection