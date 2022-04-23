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
                <h6 class="m-0 font-weight-bold badge bg-secondary p-2"><a href="/admin/posts/create" class="text-white">Tambah Posts</a></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Published_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Published_at</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                          @foreach ($posts as $key => $post)
                          <tr>
                            <td>{{$posts->firstItem() + $key}}</td>
                            <td>{{$post->tittle}}</td>
                            <td>{{$post->published_at}}</td>
                            <td>
                              <a href="/admin/posts/{{$post->slug}}" class="badge bg-info py-1 px-2 text-white"><i width="16" height="16" data-feather="search"></i></a>
                              <a href="/admin/posts/{{$post->slug}}/edit" class="badge bg-warning py-1 px-2 text-white"><i width="16" height="16" data-feather="edit"></i></a>
                              <form action="/admin/posts/{{$post->slug}}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn badge bg-danger py-1 px-2 text-white" onclick="return confirm('Apakah anda yakin ingin menghapus post ini?')"><i width="16" height="16" data-feather="trash-2"></i></button>
                              </form>
                              <form action="/admin/posts/publish/{{$post->slug}}" method="POST" class="d-inline">
                                @csrf
                                @if ($post->published_at == null)
                                <button type="submit" class="btn badge bg-success py-1 px-2 text-white"><i width="16" height="16" data-feather="send"></i></button>
                                @else
                                <button type="submit" class="btn badge bg-secondary py-1 px-2 text-white"><i width="16" height="16" data-feather="skip-back"></i></button>
                                @endif
                              </form>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                    <div class=" d-flex justify-content-center">
                        {{$posts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection