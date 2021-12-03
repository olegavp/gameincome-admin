@extends('layouts.admin_layout')

@section('title', 'Удалённые либо истёкшие промокоды')

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
                            <th>Значение</th>
                            <th>Остаток</th>
                            <th>Когда закончится(-лся)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($promoCodes as $promoCode)
                            <tr>
                                <td>{{ $promoCode->name }}</td>
                                <td>{{ $promoCode->money / 100 }} руб.</td>
                                <td>{{ $promoCode->count }}</td>
                                @if($promoCode->finish_time != null)
                                    <td>{{ $promoCode->finish_time }}</td>
                                @else
                                    <td>Бессрочно</td>
                                @endif

                                <td>
                                    <form action="{{ Route('trashBoxPromoCodeRestore', ['id' => $promoCode->id ]) }}" method="POST"
                                          style="display: inline-block">
                                        @csrf
                                        @method('POST')
                                        <button class="btn btn-success btn-sm">
                                            <i class="fas fa-undo">
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
    <div class="mt-3 ml-3">
        {{$promoCodes->links()}}
    </div>

    <style>
        nav div div
        {
            display: none;
        }
    </style>

@endsection
