@extends('layouts/admin_layout')

@section('title', 'Эта новость')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif

    <div class="card card-solid">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3 class="d-inline-block d-sm-none">{{$news->name}}</h3>
                    <div class="col-12">
                        <img src="{{ $news->small_background }}" class="product-image" alt="Product Image">
                    </div>
                    <div class="col-12 mt-2">
                        <img src="{{ $news->background }}" class="product-image" alt="Product Image">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <h3 class="my-3">{{$news->name}}</h3>
                    <h5>Описание в «трёх словах»:</h5> <p>{{$news->description_on_3_words}}</p>

                    <hr>

                    <h5>Краткое описание:</h5> <p>{{$news->small_description}}</p>

                </div>
            </div>
            <div class="row mt-4">
                <nav class="w-100">
                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                        <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Полное описание</a>
                        <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Комментарии</a>
                    </div>
                </nav>
                <div class="tab-content p-3" id="nav-tabContent" style="width: 100% !important;">
                    <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                        {{ $news->description }}
                    </div>
                    <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">
                        <div class="col-12">
                            @foreach($comments as $comment)
                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="{{ \App\Models\User::query()->find($comment->user_id)->avatar }}" alt="аватар">
                                    <span class="username">
                                        <a href="{{ Route('toUser', ['user' => $comment->user_id]) }}">{{ \App\Models\User::query()->find($comment->user_id)->nickname . '(' . \App\Models\User::query()->find($comment->user_id)->email . ')'  }}</a>
                                    </span>
                                    <span class="description">Опубликовано - {{ $comment->created_at }}</span>
                                </div>

                                <p>
                                    Id комментария: {{ $comment->id }}
                                </p>

                                @if($comment->deleted_at != null)
                                    <i>
                                        Комментарий был удалён.
                                    </i>
                                @endif
                                <b>
                                    {{ $comment->comment_text }}
                                </b>

                                <p class="mt-3">
                                    @if($comment->parent_id != null)
                                        <i class="fas fa-link mr-1"></i>Ответ на комментарий: {{ $comment->parent_id }}
                                    @endif
                                </p>
                                @if($comment->deleted_at != null)
                                    <form action="{{ Route('restore', ['type' => 'news-comments', 'id' => $comment->id]) }}" method="GET">
                                        @csrf
                                        @method('GET')
                                        <button class="btn btn-success btn-sm">
                                            <i class="fas fa-undo">
                                            </i>
                                        </button>
                                    </form>
                                @endif

                                @if($comment->deleted_at == null)
                                    <form action="{{ Route('deleteNewsComment', ['newsComment' => $comment->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash">
                                            </i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                            @endforeach
                            <div class="mt-4 ml-3">
                                {{$comments->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>


    <style>
        nav div div
        {
            display: none;
        }
    </style>
@endsection
