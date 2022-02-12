@extends('layouts.admin')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">{{$datas->first()->name}}</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <a href="/admin/categories" class="badge bg-primary py-1 px-2 text-white"><i width="16" height="16" data-feather="corner-down-left"></i></a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Judul</th>
                              <th>Published_at</th>
                              <th>excerpt</th>
                              <th>Quantity</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tfoot>
                          <tr>
                              <th>No</th>
                              <th>Judul</th>
                              <th>Published_at</th>
                              <th>excerpt</th>
                              <th>Quantity</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </tfoot>
                      <tbody>
                        @foreach ($datas->first()->exam as $key => $exam)
                        <tr>
                          <td>{{$datas->firstItem() + $key}}</td>
                          <td>{{$exam->tittle}}</td>
                          <td>{{$exam->published_at}}</td>
                          <td>{{$exam->excerpt}}</td>
                          <td>{{$exam->quantity}}</td>
                          <td></td>
                          <td class="d-flex">
                            <a href="/admin/exams/{{$exam->slug}}" class="badge bg-info py-1 px-2 mx-1 text-white"><i width="16" height="16" data-feather="search"></i></a>
                            <a href="/admin/exams/{{$exam->slug}}/edit" class="badge bg-warning py-1 px-2 mx-1 text-white"><i width="16" height="16" data-feather="edit"></i></a>
                            <form action="/admin/exams/{{$exam->slug}}" method="POST" class="d-inline">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn badge bg-danger py-1 px-2 mx-1 text-white" onclick="return confirm('Apakah anda yakin ingin menghapus post ini?')"><i width="16" height="16" data-feather="trash-2"></i></button>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                        @foreach ($datas->first()->post as $key =>$post)
                        <tr>
                          <td>{{$datas->first()->exam->count() + $key + 1}}</td>
                          <td>{{$post->tittle}}</td>
                          <td>{{$post->published_at}}</td>
                          <td>{{$post->excerpt}}</td>
                          <td>{{$post->quantity}}</td>
                          <td></td>
                          <td class="d-flex">
                            <a href="/admin/posts/{{$post->slug}}" class="badge bg-info py-1 px-2 mx-1 text-white"><i width="16" height="16" data-feather="search"></i></a>
                            <a href="/admin/posts/{{$post->slug}}/edit" class="badge bg-warning py-1 px-2 mx-1 text-white"><i width="16" height="16" data-feather="edit"></i></a>
                            <form action="/admin/posts/{{$post->slug}}" method="POST" class="d-inline">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn badge bg-danger py-1 px-2 mx-1 text-white" onclick="return confirm('Apakah anda yakin ingin menghapus post ini?')"><i width="16" height="16" data-feather="trash-2"></i></button>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                  <div class=" d-flex justify-content-center">
                      {{$datas->links()}}
                  </div>
              </div>
            </div>
        </div>
    </div>
@endsection