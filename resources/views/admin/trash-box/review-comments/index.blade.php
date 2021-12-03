@extends('layouts.admin_layout')

@section('title', 'Удалённые комментарии к обзорам')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif

    <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
            <tr>
                <th style="width: 1%">
                    #
                </th>
                <th style="width: 20%">
                    Никнейм пользователя
                </th>
                <th style="width: 30%">
                    Почта пользователя
                </th>
                <th>
                    Дата публикации
                </th>
                <th>
                    Дата удаления
                </th>
                <th style="width: 20%">
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>
                        #
                    </td>
                    <td>
                        <a>
                            {{ $comment->user->nickname }}
                        </a>
                    </td>
                    <td>
                        {{ $comment->user->email }}
                    </td>
                    <td class="project_progress">
                        {{ $comment->created_at }}
                    </td>
                    <td class="project_progress">
                        {{ $comment->deleted_at }}
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{ Route('showReview', ['review' => $comment->review_id]) }}">
                            <i class="fas fa-arrow-up">
                            </i>
                        </a>
                        <form action="{{ Route('trashBoxReviewCommentRestore', ['id' => $comment->id]) }}" method="POST"
                              style="display: inline-block" >
                            @csrf
                            @method('POST')
                            <button class="btn btn-success btn-sm">
                                <i class="fas fa-undo">
                                </i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3 ml-3">
        {{$comments->links()}}
    </div>

    <style>
        nav div div
        {
            display: none;
        }
    </style>

@endsection
