@extends('layouts/admin_layout')

@section('title', 'Сотрудники')

@section('content')
@if (session('success'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
    </div>
@endif
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Роль</th>
                        <th>Когда стал сотрудником</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($adminUsers as $adminUser)
                        <tr>
                            <td>{{ $adminUser->name }}</td>
                            <td>{{ $adminUser->email }}</td>
                            <td>{{ DB::table('roles')->where('id', DB::table('model_has_roles')->where('model_id', $adminUser->id)->pluck('role_id')[0])->select('name')->get()[0]->name }}</td>
                            <td>{{ $adminUser->created_at }}</td>
                            <td>
                                <a class="btn btn-info btn-sm mr-3" href="{{ Route('editEmployeePage', ['adminUser' => $adminUser->id]) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                </a>
                            </td>
                            <td>
                                <form action="{{ Route('deleteEmployeeMethod', ['adminUser' => $adminUser->id ]) }}" method="POST"
                                      style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-times">
                                        </i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
