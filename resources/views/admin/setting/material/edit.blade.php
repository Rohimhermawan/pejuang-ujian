@extends('layouts.admin')
@section('main')
<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Materials</h1>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create Material</h6>
    </div>
    <div class="card-body">
      <form action="/admin/materials/{{$material->id}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
          <label for="tittle" class="form-label">material Name</label>
        @error('name')   
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="input-group mb-3 col-md-6">
          <input type="text" class="form-control {{$errors->first('name', 'is-invalid')}}" id="tittle" name="name" value="{{old('name', $material->name)}}">
        </div>
        <label for="slug" class="form-label">Slug</label>
        <div class="input-group mb-3 col-md-6">
          <input type="text" class="form-control {{$errors->first('slug', 'is-invalid')}}" readonly id="slug" name="slug" value="{{old('slug', $material->slug)}}">
        </div>
        @error('slug')   
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-warning">Update</button>
      </form>
    </div>
  </div>
</div>
<script src="{{asset('js/my.js')}}"></script>
@endsection