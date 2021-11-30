@extends('layouts/admin_layout')

@section('title', 'Создание вставки')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif

    <div class="card card-primary">
        <form enctype="multipart/form-data" action="{{ Route('createInsert') }}" method="POST">
            @csrf
            @method('POST')
            <div class="card-body">
                <i>Примечание: вы можете не добавлять информацию к слайду, кроме фона, сделав просто вставку как картинку на сайте. Просто не добавляйте описание, текст кнопки и тд.</i>
                <div class="form-group mt-4">
                    <label for="over_insert"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Текст над вставкой</font></font></label>
                    <input value="{{ old('over_insert') }}" name="over_insert" type="text" class="form-control @error('over_insert') is-invalid @enderror" id="over_insert" placeholder="Введите текст над вставкой">
                    @error('over_insert')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="small_description"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Краткое описание</font></font></label>
                    <textarea type="text" class="form-control @error('small_description') is-invalid @enderror" name="small_description" id="small_description" placeholder="Введите краткое описание">{{ old('small_description') }}</textarea>
                    @error('small_description')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Полное описание</font></font></label>
                    <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Введите описание">{{ old('small_description') }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="text_on_button"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Текст для кнопки</font></font></label>
                    <input value="{{ old('text_on_button') }}" name="text_on_button" type="text" class="form-control @error('text_on_button') is-invalid @enderror" id="text_on_button" placeholder="Введите текст для кнопки">
                    @error('text_on_button')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="link"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ссылка для кнопки</font></font></label>
                    <input value="{{ old('link') }}" name="text_on_button" type="text" class="form-control @error('link') is-invalid @enderror" id="link" placeholder="Вставьте любую действующую ссылку с сайта">
                    @error('link')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="background"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Основной фон слайдера</font></font></label>
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
                <div class="card-footer">
                    <button class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Создать вставку!</font></font></button>
                </div>
            </div>
        </form>
    </div>
@endsection

