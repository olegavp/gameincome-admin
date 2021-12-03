@extends('layouts/admin_layout')

@section('title', 'Обзоры')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible my-2">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul class="mt-3 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
                    Название
                </th>
                <th style="width: 30%">
                    Количество комментариев
                </th>
                <th style="width: 10%">
                    Автор
                </th>
                <th>
                    Дата публикации
                </th>
                <th style="width: 20%">
                </th>
            </tr>
            </thead>
            @foreach($reviews as $review)
                <tbody>
                <tr>
                    <td>
                        #
                    </td>
                    <td>
                        {{ $review->name }}
                    </td>
                    <td>
                        {{ \App\Models\AdminPanel\Review\ReviewComment::query()->where('review_id', $review->id)->count() }}
                    </td>
                    <td class="project_progress">
                        {{ $review->writer->full_name }}
                    </td>
                    <td class="project_progress">
                        {{ $review->created_at }}
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{ Route('showReview', ['review' => $review->id]) }}">
                            <i class="fas fa-arrow-up">
                            </i>
                        </a>
                        <a class="btn btn-info btn-sm" href="{{ Route('editReviewPage', ['review' => $review->id]) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                        </a>
                        <form action="{{ Route('deleteReview', ['review' => $review->id]) }}" method="POST"
                              style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash">
                                </i>
                            </button>
                        </form>
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>
    <div class="mt-3 ml-3">
        {{$reviews->links()}}
    </div>

    <style>
        nav div div {
            display: none;
        }
    </style>

@endsection