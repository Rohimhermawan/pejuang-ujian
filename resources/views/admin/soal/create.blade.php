@extends('layouts.admin')
@section('main')
<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Posts</h1>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create Question</h6>
    </div>
    <div class="card-body">
      <form action="/admin/questions" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" class="form-control {{$errors->first('exam_id', 'is-invalid')}}" id="exam_id" name="exam_id" value="{{request('examid')}}" hidden>
        <label class="input-group mb-3" for="image">Image</label>
        <img class="image-preview img-fluid mb-2 col-sm-5">
        @error('image')   
          <div class="alert alert-danger col-md-8">{{ $message }}</div>
          @enderror    
          <div class="input-group mb-3">
            <input type="file" class="form-co{{$errors->first('image', 'is-invalid')}}" id="image" name="image" onchange="imagePreview()">
          </div>
        <label for="question" class="form-label">Question</label>
        @error('question')   
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="input-group mb-3">
          <textarea type="text" class="form-control" id="question" name="question">{{old('question')}}</textarea>
        </div>
        <label for="opt_a" class="form-label">Option A</label>
        @error('opt_a')   
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        <div class="input-group mb-3">
          <textarea type="text" class="form-control" id="opt_a" name="opt_a">{{old('opt_a')}}</textarea>
        </div>
        <label for="opt_b" class="form-label">Option B</label>
        @error('opt_b')   
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="input-group mb-3">
          <textarea type="text" class="form-control" id="opt_b" name="opt_b">{{old('opt_b')}}</textarea>
        </div>
        <label for="opt_c" class="form-label">Option C</label>
        @error('opt_c')   
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="input-group mb-3">
          <textarea type="text" class="form-control" id="opt_c" name="opt_c">{{old('opt_c')}}</textarea>
        </div>
        <label for="opt_d" class="form-label">Option D</label>
        @error('opt_d')   
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="input-group mb-3">
          <textarea type="text" class="form-control" id="opt_d" name="opt_d">{{old('opt_d')}}</textarea>
        </div>
        <label for="opt_e" class="form-label">Option E</label>
        @error('opt_e')   
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="input-group mb-3">
          <textarea type="text" class="form-control" id="opt_e" name="opt_e">{{old('opt_e')}}</textarea>
        </div>
        <label for="key" class="form-label">key</label>
        @error('key')   
        <div class="alert alert-danger col-md-8">{{ $message }}</div>
        @enderror
        <div class="input-group mb-3 col-md-8">
          <input type="text" class="form-control {{$errors->first('key', 'is-invalid')}}" id="key" name="key" value="{{old('key')}}">
        </div>
        <label for="explaination" class="form-label">Explanation</label>
        @error('explaination')   
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="input-group mb-3">
          <textarea type="text" class="form-control" id="explaination" name="explaination">{{old('explaination')}}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
      </form>
    </div>
  </div>
</div>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('js/my.js')}}"></script>
<script>
  const body = document.getElementById("question");
  const opt_a = document.getElementById("opt_a");
  const opt_b = document.getElementById("opt_b");
  const opt_c = document.getElementById("opt_c");
  const opt_d = document.getElementById("opt_d");
  const opt_e = document.getElementById("opt_e");
  const explaination = document.getElementById("explaination");

  var editor_config = {
    language:'en-gb'
  }
  CKEDITOR.replace(body,editor_config);
  CKEDITOR.replace(opt_a,editor_config);
  CKEDITOR.replace(opt_b,editor_config);
  CKEDITOR.replace(opt_c,editor_config);
  CKEDITOR.replace(opt_d,editor_config);
  CKEDITOR.replace(opt_e,editor_config);
  CKEDITOR.replace(explaination,editor_config);
  CKEDITOR.config.allowedContent = true;
</script>
@endsection