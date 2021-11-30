@extends('layouts/admin_layout')

@section('title', 'Все рекомендации')

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
                            <th>ID продукта</th>
                            <th>Название</th>
                            <th>Фон</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($hits as $hit)
                            <tr>
                                <td>{{ $hit->id }}</td>
                                <td>{{ $itemsInfo->where('id', $hit->item_id)->pluck('name')[0] }}</td>
                                <td>{{ $itemsInfo->where('id', $hit->item_id)->pluck('header_image')[0] }}</td>

                                <td>
                                    <form action="{{ Route('hitDelete', ['hit' => $hit->id ]) }}" method="POST"
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
