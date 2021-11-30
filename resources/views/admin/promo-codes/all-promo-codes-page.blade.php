@extends('layouts/admin_layout')

@section('title', 'Все промокоды')

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
                        <th>Когда закончится</th>
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
                                <a class="btn btn-info btn-sm" href="{{ Route('editPromoCodePage', ['promoCode' => $promoCode->id]) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                </a>
                                <form action="{{ Route('deletePromoCode', ['promoCode' => $promoCode->id ]) }}" method="POST"
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
