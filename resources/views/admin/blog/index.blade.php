@extends('layouts.admin')
@section('main')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Posts</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
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
                          @foreach ($posts as $post)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$post->tittle}}</td>
                            <td>{{$post->published_at}}</td>
                            <td>
                              <a href="" class="badge bg-info py-1 px-2"><i width="16" height="16" data-feather="search"></i></a>
                              <a href="" class="badge bg-warning py-1 px-2"><i width="16" height="16" data-feather="edit"></i></a>
                              <a href="" class="badge bg-danger py-1 px-2"><i width="16" height="16" data-feather="trash-2"></i></a>
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
    <!-- /.container-fluid -->
@endsection