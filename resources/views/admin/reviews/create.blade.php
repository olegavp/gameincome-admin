@extends('layouts/admin_layout')

@section('title')
    @if($model->exists)
        Редактирование обзора
    @else
        Создание обзора
    @endif
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif

    <div class="card card-primary">
        <form action="{{ $model->exists ? Route('editReview', ['review' => $model->id]) : Route('createReview') }}"
              method="POST">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <label for="name"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Название
                                обзора</font></font></label>
                    <input value="{{ old('name', $model->name) }}" name="name" type="text"
                           class="form-control @error('name') is-invalid @enderror" id="name"
                           placeholder="Введите название обзора">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description"><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;">Описание</font></font></label>
                    <textarea type="text" name="description"
                              class="form-control @error('description') is-invalid @enderror" id="description"
                              placeholder="Введите описание" rows="4" cols="50"
                              required>{{ old('description', $model->description) }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="item_type"><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;">Тип обзора</font></font></label>
                    <select class="form-control @error('item_type') is-invalid @enderror" id="item_type" class="item_type">
                        @foreach(\App\Models\AdminPanel\Review\Enums\ItemTypeEnum::ITEM_TYPES as $key => $value)
                            <option value="{{$key}}" {{old('item_type', $model->item_type) === $key ? 'selected' : ''}}>
                                {{$value}}
                            </option>
                        @endforeach
                    </select>
                    @error('item_type')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                </div>

                <div class="card-footer">
                    <button class="btn btn-primary"><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;">@if ($model->exists) Изменить обзор! @else Создать
                                обзор! @endif</font></font></button>
                </div>
            </div>
        </form>
    </div>
@endsection


