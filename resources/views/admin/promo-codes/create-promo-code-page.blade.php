@extends('layouts/admin_layout')

@section('title', 'Создание промокода')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif

    <div class="card card-primary">
        <form enctype="multipart/form-data" action="{{ Route('createPromoCode') }}" method="POST">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <label for="name"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Название промокода</font></font></label>
                    <input value="{{ old('name') }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Введите название промокода">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="count"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Количество промокода</font></font></label>
                    <input type="text" class="form-control @error('count') is-invalid @enderror" name="count" id="count" value="{{ old('count') }}" placeholder="Введите количесвто промокода">
                    @error('count')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="money"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Значение промокода</font></font></label>
                    <input type="text" class="form-control @error('money') is-invalid @enderror" name="money" id="money" value="{{ old('money') }}" placeholder="Введите значение промокода">
                    @error('money')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="finish_time"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Дата окончания промокода(может быть пустым, т.е. бессрочным до удаления)</font></font></label>
                    <input type="date" class="form-control @error('finish_time') is-invalid @enderror" name="finish_time" id="finish_time" value="{{ old('finish_time') }}">
                    @error('finish_time')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="card-footer">
                    <button class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Создать прмокод!</font></font></button>
                </div>
            </div>
        </form>
    </div>
@endsection

