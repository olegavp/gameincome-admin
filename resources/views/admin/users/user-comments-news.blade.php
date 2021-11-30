@extends('layouts/admin_layout')

@section('title', 'Комментарии пользователя к новостям')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif

    <div class="card card-solid">
        <div class="card-body">
            <div class="row mt-4">
                <div class="tab-content p-3" id="nav-tabContent" style="width: 100% !important;">
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
                                <form action="{{ Route('deleteComment', ['newsComment' => $comment->id]) }}" method="POST">
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
        <!-- /.card-body -->
    </div>

@endsection
