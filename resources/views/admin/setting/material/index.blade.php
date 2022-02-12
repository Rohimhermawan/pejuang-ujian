@extends('layouts.admin')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Materials</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <h6 class="m-0 font-weight-bold badge bg-secondary p-2"><a href="/admin/materials/create" class="text-white">Tambah Material</a></h6>
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
                          @foreach ($materials as $key => $material)
                          <tr>
                            <td>{{$materials->firstItem() + $key}}</td>
                            <td>{{$material->name}}</td>
                            <td>{{$post[$material->name]}}</td>
                            <td>{{$exam[$material->name]}}</td>
                            <td>
                              <a href="/admin/materials/{{$material->id}}" class="badge bg-info py-1 px-2 text-white"><i width="16" height="16" data-feather="search"></i></a>
                              <a href="/admin/materials/{{$material->id}}/edit" class="badge bg-warning py-1 px-2 text-white"><i width="16" height="16" data-feather="edit"></i></a>
                              <form action="/admin/materials/{{$material->id}}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn badge bg-danger py-1 px-2 text-white" onclick="return confirm('Apakah anda yakin ingin menghapus material ini?')"><i width="16" height="16" data-feather="trash-2"></i></button>
                              </form>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                    <div class=" d-flex justify-content-center">
                        {{$materials->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection