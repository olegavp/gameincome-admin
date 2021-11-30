@extends('layouts/admin_layout')

@section('title', 'Все слайды')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif
    @foreach($frames as $frame)
    <section class="content">
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h3 class="d-inline-block d-sm-none">{{ $frame->name }}</h3>
                        <div class="col-12">
                            <img src="{{ $frame->background }}" class="product-image" alt=".">
                        </div>
                        <div class="col-12 product-image-thumbs">
                            <div class="product-image-thumb active"><img src="{{ $frame->preview_background }}" alt="."></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3">{{ $frame->name }}</h3>
                        <b>Краткое описание: </b><p>{{ $frame->small_description }}</p>

                        <hr>
                        <b>Полное описание: </b><p>{{ $frame->description }}</p>
                        <hr>
                        <b>Текст на кнопке: </b><p>{{ $frame->text_on_button }}</p>
                        <b>Ссылка на кнопке: </b><p>{{ $frame->link }}</p>
                        <hr>
                        <a class="btn btn-info btn-sm mr-3" href="{{ Route('editSliderFramePage', ['slider' => $frame->id]) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                        </a>

                        <form action="{{ Route('deleteSliderFrame', ['slider' => $frame->id]) }}" method="POST"
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
