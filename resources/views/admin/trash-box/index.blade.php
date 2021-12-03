@extends('layouts.admin_layout')

@section('title', 'Корзина')

@section('content')
    <div class="row ml-1 mr-1">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-list-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="{{ Route('trashBoxNewsPage') }}">Новости</a></span>
                    <span class="info-box-number"></span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-list-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">
                        <a href="{{ Route('trashBoxNewsCommentsPage') }}">Комментарии к новостям</a>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-list-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">
                        <a href="{{ Route('trashBoxReviewsCommentsPage') }}">Комментарии к обзорам</a>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-list-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><a href="{{ Route('trashBoxPromoCodesPage') }}">Промокоды</a></span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-list-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><a href="{{ Route('trashBoxBannedUsersPage') }}">Пользователи в бане</a></span>
                </div>
            </div>
        </div>
        <i class="mt-2 ml-3">Предметы из корзины, кроме пользователей удалить вручную невозможно. Они сами будут
            уничтожены безвазрвтно в течении 60 дней. А пользователи будут находиться в бане, пока их саморучно не
            разблокировать через корзину или через их профиль.</i>
    </div>
@endsection
