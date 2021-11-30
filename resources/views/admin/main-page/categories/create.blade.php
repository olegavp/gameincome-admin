@extends('layouts/admin_layout')

@section('title', 'Создание категории для главной страницы')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif

    <div class="card card-primary">
        <form enctype="multipart/form-data" action="{{ Route('createCategory') }}" method="POST">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group mt-2">
                    <label for="category_id" style="width: 100% !important;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Выберите категорию, которую хотите указать на главной странице:</font></font></label>
                    <select class="custom-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id" style="width: 100% !important;">
                        <option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ null }}</font></font></option>
                        @foreach($categories as $category)
                            <option value="{{ $category['id'] }}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $category['name'] }}</font></font></option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group mt-3">
                        <label for="background"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Добавьте фон для категории главной страницы</font></font></label>
                        <div class="input-group" style="width: 100% !important;">
                            <div class="custom-file" style="width: 100% !important;">
                                <input type="file" name="background" class="custom-file-input @error('background') is-invalid @enderror" id="background" style="width: 100% !important;">
                                <label class="custom-file-label" for="background" style="width: 100% !important;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Выбрать файл</font></font></label>
                            </div>
                            @error('background')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Создать категорию!</font></font></button>
                </div>
            </div>
        </form>
    </div>
@endsection


