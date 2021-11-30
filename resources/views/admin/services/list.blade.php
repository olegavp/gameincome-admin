@extends('layouts/admin_layout')

@section('title', 'Все новинки')

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
                            <th>Название</th>
                            <th>Название в поисковой строке</th>
                            <th>Фон</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->slug }}</td>
                                <td>{{ $service->background }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm mr-3" href="{{ Route('serviceEditPage', ['service' => $service->id]) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ Route('servicesDelete', ['service' => $service->id ]) }}" method="POST"
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
