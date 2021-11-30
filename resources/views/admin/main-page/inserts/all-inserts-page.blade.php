@extends('layouts/admin_layout')

@section('title', 'Все слайды')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif
    @foreach($inserts as $insert)
    <section class="content">
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h3 class="d-inline-block d-sm-none">{{ $insert->name }}</h3>
                        <div class="col-12">
                            <img src="{{ $insert->background }}" class="product-image" alt=".">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3">{{ $insert->name }}</h3>
                        <b>Текст над вставкой: </b><p>{{ $insert->over_insert }}</p>

                        <hr>
                        <b>Краткое описание: </b><p>{{ $insert->small_description }}</p>
                        <hr>
                        <b>Полное описание: </b><p>{{ $insert->description }}</p>
                        <b>Текст на кнопке: </b><p>{{ $insert->text_on_button }}</p>
                        <b>Ссылка на кнопке: </b><p>{{ $insert->link }}</p>
                        <hr>
                        <form action="{{ Route('deleteInsert', ['insert' => $insert->id]) }}" method="POST"
                              style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash">
                                </i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    @endforeach
@endsection
