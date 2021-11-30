@extends('layouts/admin_layout')

@section('title', 'Отзывы о товарах продавца')

@section('content')
<div class="card card-solid">
    <div class="card-body">
        <div class="row mt-4">
            <div class="tab-content p-3" id="nav-tabContent" style="width: 100% !important;">
                <div class="col-12">
                    @foreach($feedbacks as $feedback)
                        <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="{{ \App\Models\User::query()->find($feedback->user_id)->avatar }}">
                                <span class="username">
                                    <a href="{{ Route('toUser', ['user' => $feedback->user_id]) }}">{{ \App\Models\User::query()->find($feedback->user_id)->nickname . '(' . \App\Models\User::query()->find($feedback->user_id)->email . ')'  }}</a>
                                </span>
                                <span class="description">Опубликовано - {{ $feedback->created_at }}</span>
                            </div>
                            <b>
                                {{ $feedback->comment }}
                            </b>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
@endsection
