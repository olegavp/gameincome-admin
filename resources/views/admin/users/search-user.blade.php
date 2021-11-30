@extends('layouts/admin_layout')

@section('title', 'Поиск пользователя')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-warning" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-times"></i>{{ session('error') }}</h4>
        </div>
    @endif

    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container-fluid mt-5">
        <h2 class="text-center display-4">Найти пользователя/продавца по email</h2>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form action="{{ Route('getUserMethod') }}" method="GET">
                    @csrf
                    @method('GET')
                    <div class="input-group">
                        <label for="email"></label>
                        <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Введите email пользователя">
                        <div class="input-group-append">
                            <button class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
