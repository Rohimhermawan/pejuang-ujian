@extends('layouts.admin')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Posts</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <a href="/admin/exams" class="badge bg-primary py-1 px-2 text-white"><i width="16" height="16" data-feather="corner-down-left"></i></a>
                <h6 class="m-0 font-weight-bold badge bg-secondary p-2"><a href="/admin/questions/create?examid={{request('examid')??$examid}}" class="text-white">Tambah Question</a></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Soal</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Soal</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                          @foreach ($questions as $key => $question)
                          <tr>
                            <td>{{$questions->firstItem() + $key}}</td>
                            <td>{!! $question->question !!}</td>
                            <td></td>
                            <td>
                              <a href="/admin/questions/{{$question->id}}" class="badge bg-info py-1 px-2 text-white"><i width="16" height="16" data-feather="search"></i></a>
                              <a href="/admin/questions/{{$question->id}}/edit" class="badge bg-warning py-1 px-2 text-white"><i width="16" height="16" data-feather="edit"></i></a>
                              <form action="/admin/questions/{{$question->id}}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn badge bg-danger py-1 px-2 text-white" onclick="return confirm('Apakah anda yakin ingin menghapus post ini?')"><i width="16" height="16" data-feather="trash-2"></i></button>
                              </form>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                    <div class=" d-flex justify-content-center">
                        {{$questions->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection