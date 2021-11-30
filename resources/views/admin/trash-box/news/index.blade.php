@extends('layouts.admin_layout')

@section('title', 'Удалённые новости')

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
                        Название
                    </th>
                    <th style="width: 30%">
                        Количество комментариев
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
                @foreach($news as $post)
                    <tbody>
                    <tr>
                        <td>
                            #
                        </td>
                        <td>
                            <a>
                                {{ $post->name }}
                            </a>
                        </td>
                        <td>
                            {{ \App\Models\AdminPanel\News\NewsComment::query()->where('news_id', $post->id)->count() }}
                        </td>
                        <td class="project_progress">
                            {{ $post->created_at }}
                        </td>
                        <td class="project_progress">
                            {{ $post->deleted_at }}
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" href="{{ Route('trashBoxNewsToPage', ['id' => $post->id]) }}">
                                <i class="fas fa-arrow-up">
                                </i>
                            </a>
                            <form action="{{ Route('trashBoxNewsRestoreMethod', ['id' => $post->id]) }}" method="POST"
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
                    </tbody>
                @endforeach
            </table>
        </div>
    <div class="mt-3 ml-3">
        {{$news->links()}}
    </div>

    <style>
        nav div div
        {
            display: none;
        }
    </style>

@endsection
