@extends('layouts/admin_layout')

@section('title', 'Сессии авторизации пользователя')

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
                            <th>IP</th>
                            <th>DEVICE</th>
                            <th>BROWSER</th>
                            <th>STATUS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sessions as $session)
                            <tr>
                                <td>{{ $session->ip }}</td>
                                <td>{{ $session->device }}</td>
                                <td>{{ $session->browser }}</td>
                                @if($session->confirmed == 0)
                                <td>Не подтверждён</td>
                                @else
                                <td>Подтверждён</td>
                                @endif

                                <td>
                                <form action="{{ Route('deleteUserSessions', ['id' => $session->id ]) }}" method="POST"
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
