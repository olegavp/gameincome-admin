@extends('layouts/admin_layout')

@section('title', 'Редактирование промокода')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif

    <div class="card card-primary">
        <form enctype="multipart/form-data" action="{{ Route('editPromoCode', ['promoCode' => $promoCode->id]) }}" method="POST">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <label for="name"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Название промокода</font></font></label>
                    <input value="{{ $promoCode->name }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Введите название промокода">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="count"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Количество промокода</font></font></label>
                    <input type="text" class="form-control @error('count') is-invalid @enderror" name="count" id="count" value="{{ $promoCode->count }}" placeholder="Введите количесвто промокода">
                    @error('count')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="money"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Значение промокода</font></font></label>
                    <input type="text" class="form-control @error('money') is-invalid @enderror" name="money" id="money" value="{{ $promoCode->money / 100 }}" placeholder="Введите значение промокода">
                    @error('money')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="finish_time"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Дата окончания промокода(может быть пустым, т.е. бессрочным до удаления)</font></font></label>
                    <br>
                    @if($promoCode->finish_time == null)
                    Дата окончания промокода сейчас: Бессрочно
                        <input type="date" class="form-control @error('finish_time') is-invalid @enderror" name="finish_time" id="finish_time">
                        @error('finish_time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    @else
                    <input type="date" class="form-control @error('finish_time') is-invalid @enderror" name="finish_time" id="finish_time" value="{{ date('Y-m-d', strtotime($promoCode->finish_time)) }}">
                    @error('finish_time')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @endif
                </div>

                <div class="card-footer">
                    <button class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Изменить прмокод!</font></font></button>
                </div>
            </div>
        </form>
    </div>
@endsection

