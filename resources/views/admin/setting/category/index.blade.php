@extends('layouts.admin')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Categories</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <h6 class="m-0 font-weight-bold badge bg-secondary p-2"><a href="/admin/categories/create" class="text-white">Tambah Category</a></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah Blog</th>
                                <th>Jumlah Soal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah Blog</th>
                                <th>Jumlah Soal</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                          @foreach ($categories as $key => $category)
                          <tr>
                            <td>{{$categories->firstItem() + $key}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$post[$category->name]}}</td>
                            <td>{{$exam[$category->name]}}</td>
                            <td>
                              <a href="/admin/categories/{{$category->id}}" class="badge bg-info py-1 px-2 text-white"><i width="16" height="16" data-feather="search"></i></a>
                              <a href="/admin/categories/{{$category->id}}/edit" class="badge bg-warning py-1 px-2 text-white"><i width="16" height="16" data-feather="edit"></i></a>
                              <form action="/admin/categories/{{$category->id}}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn badge bg-danger py-1 px-2 text-white" onclick="return confirm('Apakah anda yakin ingin menghapus category ini?')"><i width="16" height="16" data-feather="trash-2"></i></button>
                              </form>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                    <div class=" d-flex justify-content-center">
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection