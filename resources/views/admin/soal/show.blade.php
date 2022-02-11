@extends('layouts.admin')
@section('main')
<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Posts</h1>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Question</h6>
    </div>
    <div class="card-body">
      <div class="row justify-content-center">
        <div class="col-md-10 text-center">
          <img src="{{asset('storage/questionsImage/'.$question->exam->category_id.'/'.$question->exam->material_id.'/'.$question->exam->slug.'/'.$question->image)}}" alt="">
          {!! $question->question !!}
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-10">
          <ul class="list-group">
            <li class="list-group-item">A. {!! $question->opt_a !!}</li>
            <li class="list-group-item">B. {!! $question->opt_b !!}</li>
            <li class="list-group-item">C. {!! $question->opt_c !!}</li>
            <li class="list-group-item">D. {!! $question->opt_d !!}</li>
            <li class="list-group-item">E. {!! $question->opt_e !!}</li>
            <li class="list-group-item">Kunjaw :  {!! $question->key !!}</li>
          </ul>
          {!! 'Penjelasan : '.$question->explanation !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection