@extends('layouts/admin_layout')

@section('title', 'Создание хита')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif

    <div class="card card-primary">
        <form enctype="multipart/form-data" action="{{ Route('createHit') }}" method="POST">
            @csrf
            @method('POST')
            <div class="card-body">
                <i>Здесь предоставлены игры, которые имеют ключи на нашей площадке</i>

                <div class="form-group mt-2">
                    <label for="itemId" style="width: 100% !important;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Выберите игры, которые хотите указать на главной странице:</font></font></label>
                    <select class="custom-select @error('ItemId') is-invalid @enderror" name="itemId" id="itemId" style="width: 100% !important;">
                        <option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ null }}</font></font></option>
                        @foreach($games as $game)
                            <option value="{{ $game['id'] }}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $game['name'] }}</font></font></option>
                        @endforeach
                    </select>
                    @error('itemId')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Создать хит!</font></font></button>
                </div>
            </div>
        </form>
    </div>
@endsection


