@extends('layouts.admin')
@section('main')
<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Posts</h1>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create Post</h6>
    </div>
    <div class="card-body">
      <form action="/admin/posts" method="post" enctype="multipart/form-data">
        @csrf
        <label for="tittle" class="form-label">Tittle</label>
        @error('tittle')   
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="input-group mb-3 col-md-6">
          <input type="text" class="form-control {{$errors->first('tittle', 'is-invalid')}}" id="tittle" name="tittle" value="{{old('tittle')}}">
        </div>
        <label for="slug" class="form-label">Slug</label>
        <div class="input-group mb-3 col-md-6">
          <input type="text" class="form-control {{$errors->first('slug', 'is-invalid')}}" readonly id="slug" name="slug" value="{{old('slug')}}">
        </div>
        @error('slug')   
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="category_id" class="form-label">Category</label>
        @error('category_id')   
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="input-group mb-3 col-md-6">
          <select class="form-select w-100 mb-3" name="category_id">
            @foreach ($categories as $category)
              @if ($category->id == old('category_id')) 
              <option selected value="{{$category->id}}">{{$category->name}}</option>
              @else
              <option value="{{$category->id}}">{{$category->name}}</option>
              @endif
            @endforeach
          </select>
        </div>
        @error('material_id')   
        <label for="material_id" class="form-label">Material</label>
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="input-group mb-3 col-md-6">
          <select class="form-select w-100 mb-3" name="material_id">
          <option value="">Tidak Ada</option>
          @foreach ($materials as $material)
              @if ($material->name == old('material_id')) 
              <option selected value="{{$material->id}}">{{$material->name}}</option>
              @else
              <option value="{{$material->id}}">{{$material->name}}</option>
              @endif
            @endforeach
          </select>
        </div>
        <div class="input-group mb-3 col-md-6 d-none">
          <input type="text" class="form-control" id="author" name="author_id">
        </div>
        <label for="body" class="form-label">Body</label>
        @error('body')   
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="input-group mb-3">
          <textarea type="text" class="form-control" id="body" name="body">{{old('body')}}</textarea>
        </div>
        <label class="input-group mb-3" for="image">Image</label>
        <img class="image-preview img-fluid mb-2 col-sm-5">
        @error('image')   
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror    
        <div class="input-group mb-3">
          <input type="file" class="form-co{{$errors->first('image', 'is-invalid')}}" id="image" name="image" onchange="imagePreview()">
        </div>
        <button type="submit" class="btn btn-success">Create</button>    
      </form>
    </div>
  </div>
</div>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('js/my.js')}}"></script>
@endsection