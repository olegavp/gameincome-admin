@extends('layouts/admin_layout')

@section('title', 'Создание платформы')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif

    <div class="card card-primary">
        <form enctype="multipart/form-data" action="{{ Route('platformsCreate') }}" method="POST">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <label for="name"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Название платформы</font></font></label>
                    <input value="{{ old('name') }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Введите название платформы">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="card-footer">
                    <button class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Создать платформу!</font></font></button>
                </div>
            </div>
        </form>
    </div>
@endsection


