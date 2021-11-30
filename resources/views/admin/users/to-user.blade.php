@extends('layouts/admin_layout')

@section('title', 'Страница пользователя')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif

    <div class="col-md-12">
        <!-- Widget: user widget style 2 -->
        <div class="card card-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-warning">
                <div class="widget-user-image">
                    <img class="" src="{{ $user->avatar }}" alt="Аватар">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">{{ $user->name }} {{ $user->surname }}</h3>
                <h5 class="widget-user-desc">{{ $user->email }}</h5>
                @if(!isset($likes))
                    <b class="widget-user-desc">Продавец: нет</b>
                @else
                    <b class="widget-user-desc">Продавец: да</b>
                @endif
                <br>
                @if(\Illuminate\Support\Facades\DB::table('users_banned')->where('user_id', $user->id)->get()->isNotEmpty())
                    <b class="widget-user-desc">Забанен: да</b>
                    <br>
                    <form action="{{ Route('unban', ['user' => $user->id]) }}" method="POST"
                          style="display: inline-block" >
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-success btn-sm">
                            <i class="fas fa-recycle">
                            </i>
                        </button>
                    </form>
                @else
                    <b class="widget-user-desc">Забанен: нет</b>
                    <br>
                    <form action="{{ Route('ban', ['user' => $user->id]) }}" method="POST"
                          style="display: inline-block" >
                        @csrf
                        @method('POST')
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-ban">
                            </i>
                        </button>
                    </form>
                @endif
            </div>
            <div class="card-footer p-0">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ Route('userComments', ['user' => $user->id]) }}" class="nav-link">
                            Комментарии
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Покупки
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Чаты
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Транзакции и баланс
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ Route('userSessions', ['user' => $user->id]) }}" class="nav-link">
                            Онлайн-сессии
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @if(isset($likes))
        <div class="col-md-12">
        <!-- Widget: user widget style 2 -->
        <div class="card card-widget widget-user-2">
            <div class="widget-user-header bg-info">
                <h5 class="ml-2 mt-2">Информация как о продавце:</h5>

                <p class="ml-2 mt-3">Лайки: {{ $likes }}</p>
                <p class="ml-2">Дизлайки: {{ $dislikes }}</p>
                <p class="ml-2">Отзывов оставлено: {{ $likes + $dislikes }}</p>
                <p class="ml-2">Товаров продано: {{ $purchases }}</p>
                <p class="ml-2">Товаров на продаже: {{ $sales }}</p>
            </div>

            <div class="card-footer p-0">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ Route('sellersItemsFeedbacks', ['user' => $user->id]) }}" class="nav-link">
                            Комментарии на товары данного пользоватлея
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Товары на продаже
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Проданные товары
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endif
@endsection
