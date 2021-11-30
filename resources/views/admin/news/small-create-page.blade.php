@extends('layouts/admin_layout')

@section('title', 'Создание маленькой новости')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif
    <div class="card card-primary">
        <form enctype="multipart/form-data" action="{{ Route('createNews') }}" method="POST">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <label for="name"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Название</font></font></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"  placeholder="Введите название новости" value="{{ old('name') }}" required autocomplete="name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="description_on_3_words"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Описание в «трёх словах»</font></font></label>
                    <input type="text" name="description_on_3_words" class="form-control @error('description_on_3_words') is-invalid @enderror" id="description_on_3_words" placeholder="Введите описание в «трёх словах»" value="{{ old('description_on_3_words') }}" required autocomplete="description_on_3_words">
                    @error('description_on_3_words')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="small_description"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Краткое описание</font></font></label>
                    <textarea type="text" name="small_description" class="form-control @error('small_description') is-invalid @enderror" id="small_description" placeholder="Введите краткое описание" required autocomplete="small_description">{{ old('small_description') }}</textarea>
                    @error('small_description')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Описание</font></font></label>
                    <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Введите описание" required autocomplete="description">{{ old('description') }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="relation" style="width: 100% !important;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Выберите связанные категории</font></font></label>
                    <select class="custom-select @error('relation') is-invalid @enderror" name="relation" id="relation" style="width: 100% !important;">
                        <option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ null }}</font></font></option>
                        @foreach($relations as $relation)
                            <option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $relation }}</font></font></option>
                        @endforeach
                    </select>
                    @error('relation')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="new_relation"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">или создайте новую</font></font></label>
                    <input type="text" name="new_relation" class="form-control @error('new_relation') is-invalid @enderror" id="new_relation" placeholder="Введите новую категорию связи новостей" value="{{ old('new_relation') }}" autocomplete="new_relation">
                    @error('new_relation')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="small_background"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Фон новости в списке</font></font></label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="small_background" class="custom-file-input @error('small_background') is-invalid @enderror" id="small_background">
                            <label class="custom-file-label" for="small_background"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Или выбрать новый файл</font></font></label>
                            @error('small_background')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="background"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Фон новости при переходе</font></font></label>
                    <div class="input-group" style="width: 100% !important;">
                        <div class="custom-file" style="width: 100% !important;">
                            <input type="file" name="background" class="custom-file-input @error('background') is-invalid @enderror" id="background" style="width: 100% !important;">
                            <label class="custom-file-label" for="background" style="width: 100% !important;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Или выбрать новый файл</font></font></label>
                        </div>
                        @error('background')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Создать новость!</font></font></button>
            </div>
        </form>
    </div>
@endsection
