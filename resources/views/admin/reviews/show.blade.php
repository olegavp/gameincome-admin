@extends('layouts/admin_layout')

@section('title', 'Обзор: ' . $review->name)

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
                    <h3 class="d-inline-block d-sm-none">{{$review->name}}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="col-12">
                        <img src="{{ $review->item ? $review->item->header_image : '' }}" class="product-image"
                             alt="Product Image">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <h3 class="my-3">{{$review->name}}</h3>
                    @if ($review->item)
                        <h5>Обзор на: {{$review->item_type_name}} {{$review->item->name}}</h5>
                        <p>Автор: {{$review->writer->full_name}}</p>
                        <p>{{$review->item->short_description}}</p>
                    @endif
                </div>
            </div>
            <div class="row mt-4">
                <nav class="w-100">
                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                        <a class="nav-item nav-link active" id="review-desc-tab" data-toggle="tab" href="#review-desc"
                           role="tab" aria-controls="review-desc" aria-selected="true">Описание</a>
                        <a class="nav-item nav-link" id="review-comments-tab" data-toggle="tab"
                           href="#review-comments" role="tab" aria-controls="review-comments" aria-selected="false">Комментарии</a>
                    </div>
                </nav>
                <div class="tab-content p-3" id="nav-tabContent" style="width: 100% !important;">
                    <div class="tab-pane fade show active" id="review-desc" role="tabpanel"
                         aria-labelledby="review-desc-tab">
                        <h5>Описание</h5>
                        {{ $review->description }}
                    </div>
                    <div class="tab-pane fade" id="review-comments" role="tabpanel"
                         aria-labelledby="review-comments-tab">
                        <div class="col-12">
                            @foreach($comments as $comment)
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                             src="{{ $comment->user->avatar }}"
                                             alt="аватар">
                                        <span class="username">
                                        <a href="{{ Route('toUser', ['user' => $comment->user_id]) }}">{{ $comment->user->nickname . '(' . $comment->user->email . ')'  }}</a>
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
                                            <i class="fas fa-link mr-1"></i>Ответ на
                                            комментарий: {{ $comment->parent_id }}
                                        @endif
                                    </p>
                                    @if($comment->deleted_at != null)
                                        <form action="{{ Route('trashBoxReviewCommentRestore', ['id' => $comment->id]) }}"
                                              method="POST">
                                            @csrf
                                            @method('POST')
                                            <button class="btn btn-success btn-sm">
                                                <i class="fas fa-undo">
                                                </i>
                                            </button>
                                        </form>
                                    @endif

                                    @if($comment->deleted_at == null)
                                        <form action="{{ Route('deleteReviewComment', ['comment' => $comment->id]) }}"
                                              method="POST">
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
        nav div div {
            display: none;
        }
    </style>
@endsection
