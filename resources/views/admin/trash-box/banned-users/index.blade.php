@extends('layouts.admin_layout')

@section('title', 'Забаненные пользователи')

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
                    Баланс
                </th>
                <th>
                    Дата бана
                </th>
                <th style="width: 20%">
                </th>
            </tr>
            </thead>
            @foreach($users as $user)
                <tbody>
                <tr>
                    <td>
                        #
                    </td>
                    <td>
                        <a>
                            {{ $user->nickname }}
                        </a>
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td class="project_progress">
                        {{ 0000 }}
                    </td>
                    <td class="project_progress">
                        {{ \App\Models\AdminPanel\User\UserBanned::query()->where('user_id', $user->id)->first()->created_at }}
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{ Route('toUser', ['user' => $user->id]) }}">
                            <i class="fas fa-arrow-up">
                            </i>
                        </a>
                        <form action="{{ Route('trashBoxBannedUserRestoreMethod', ['id' => $user->id]) }}" method="POST"
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

    <style>
        nav div div
        {
            display: none;
        }
    </style>

@endsection
