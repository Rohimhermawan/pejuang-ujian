@extends('layouts.admin')
@section('main')
<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Categories</h1>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create Category</h6>
    </div>
    <div class="card-body">
      <form action="/admin/categories" method="post" enctype="multipart/form-data">
        @csrf
          <label for="tittle" class="form-label">Category Name</label>
        @error('name')   
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="input-group mb-3 col-md-6">
          <input type="text" class="form-control {{$errors->first('name', 'is-invalid')}}" id="tittle" name="name" value="{{old('name')}}">
        </div>
        <label for="slug" class="form-label">Slug</label>
        <div class="input-group mb-3 col-md-6">
          <input type="text" class="form-control {{$errors->first('slug', 'is-invalid')}}" readonly id="slug" name="slug" value="{{old('slug')}}">
        </div>
        @error('slug')   
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-success">Create</button>
      </form>
    </div>
  </div>
</div>
<script src="{{asset('js/my.js')}}"></script>
@endsection