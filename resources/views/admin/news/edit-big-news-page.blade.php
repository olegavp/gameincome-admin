@extends('layouts/admin_layout')

@section('title', 'Редактирование большой новости')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif

    <div class="card card-primary">
        <form enctype="multipart/form-data" action="{{ Route('editSmallNews', ['news' => $news->id]) }}" method="POST">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <label for="name"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Название</font></font></label>
                    <input value="{{ $news->name }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Введите название новости">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="small_description"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Краткое описание</font></font></label>
                    <textarea type="text" class="form-control @error('name') is-invalid @enderror" name="small_description" id="small_description" placeholder="Введите карткое описание">{{ $news->small_description }}</textarea>
                    @error('small_description')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Описание</font></font></label>
                    <textarea type="text" class="form-control @error('name') is-invalid @enderror" name="description" id="description" placeholder="Введите описание">{{ $news->description }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>



                <div class="form-group">
                    <label for="relation" style="width: 100% !important;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Выберите связанные категории</font></font></label>
                    <select class="custom-select @error('relation') is-invalid @enderror" name="relation" id="relation" style="width: 100% !important;">
                        <option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $news->relation }}</font></font></option>
                        @foreach(\App\Models\AdminPanel\News\News::query()->pluck('relation') as $relation)
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
                    <input type="text" name="new_relation" class="form-control @error('new_relation') is-invalid @enderror" id="new_relation" placeholder="Введите новую категорию связи новостей">
                    @error('new_relation')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="small_background"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Фон новости в списке</font></font></label>
                    <br>
                    <img src="{{ $news->small_background }}" alt="фон">
                    <br>
                    <br>
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
                    <br>
                    <img src="{{ $news->background }}" alt="фон">
                    <br>
                    <br>
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

            <div class="card-footer">
                <button class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Изменить новость!</font></font></button>
            </div>
        </form>
    </div>
@endsection
