<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/admin/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/admin/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/admin/plugins/summernote/summernote-bs4.min.css">
    
    <!-- jQuery -->
    <script src="/admin/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="/public/admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Контакты</a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block" style="pointer-events: none; color: white">
                        Пользователь: {{ Auth::user()->name }}
                    </a>
                    <a href="#" class="d-block" style="pointer-events: none; color: white">
                        @foreach(Auth::user()->getRoleNames() as $role)
                            Роль: {{ $role }}
                        @endforeach
                    </a>
                    <form action="{{ route('logout') }}" method="POST"
                          style="display: inline-block" class="mt-2">
                        @csrf
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-sign-out-alt">
                                Выход
                            </i>
                        </button>
                    </form>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('mainPage') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                ГЛАВНАЯ
                            </p>
                        </a>
                    </li>

                    @foreach(Auth::user()->getRoleNames() as $role)
                        @if($role == 'Администратор' or $role == 'Модератор' or $role == 'Писатель новостей' or $role == 'Писатель обзоров')
                            <li class="nav-header">КОНТЕНТ-ЦЕНТР</li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                        СОЗД/РЕД/УДАЛ
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if($role == 'Администратор' or $role == 'Модератор' or $role == 'Писатель новостей')
                                    <li class="nav-item">
                                        <a href="{{ route('newsPage') }}" class="nav-link">
                                            <p>Новости</p>
                                        </a>
                                    </li>
                                    @endif
                                    @if($role == 'Администратор' or $role == 'Модератор' or $role == 'Писатель обзоров')
                                        <li class="nav-item">
                                            <a href="{{ route('newsPage') }}" class="nav-link">
                                                <p>Обзоры</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if($role == 'Администратор' or $role == 'Модератор')
                                        <li class="nav-item">
                                            <a href="{{ route('promoCodesPage') }}" class="nav-link">
                                                <p>Промокоды</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if($role == 'Администратор' or $role == 'Модератор')
                                        <li class="nav-item">
                                            <a href="{{ route('sliderPage') }}" class="nav-link">
                                                <p>Слайдер</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if($role == 'Администратор' or $role == 'Модератор')
                                        <li class="nav-item">
                                            <a href="{{ route('insertsPage') }}" class="nav-link">
                                                <p>Вставки</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if($role == 'Администратор' or $role == 'Модератор')
                                        <li class="nav-item">
                                            <a href="{{ route('main-page-games') }}" class="nav-link">
                                                <p>Игры на главной странице</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if($role == 'Администратор' or $role == 'Модератор')
                                        <li class="nav-item">
                                            <a href="{{ route('categoriesPage') }}" class="nav-link">
                                                <p>Категории на главной странице</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if($role == 'Администратор' or $role == 'Модератор')
                                        <li class="nav-item">
                                            <a href="{{ Route('servicesPage') }}" class="nav-link">
                                                <p>Сервисы</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if($role == 'Администратор' or $role == 'Модератор')
                                        <li class="nav-item">
                                            <a href="{{ Route('platformsPage') }}" class="nav-link">
                                                <p>Платформы</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if($role == 'Администратор' or $role == 'Модератор')
                                        <li class="nav-item">
                                            <a href="pages/forms/validation.html" class="nav-link">
                                                <p>Товары</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if($role == 'Администратор' or $role == 'Модератор')
                                        <li class="nav-item">
                                            <a href="pages/forms/validation.html" class="nav-link">
                                                <p>Глобальные оповещения</p>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    @endforeach

                    @foreach(Auth::user()->getRoleNames() as $role)
                        @if($role == 'Администратор' or $role == 'Модератор' )
                            <li class="nav-header">ПОЛЬЗОВАТЕЛЬСКИЙ ЦЕНТР</li>
                            <li class="nav-item">
                                <a href="{{ Route('getUserPage') }}" class="nav-link">
                                    <i class="nav-icon fas fa-address-card"></i>
                                    <p>
                                        ПОЛЬЗОВАТЕЛИ
                                    </p>
                                </a>
                            </li>
                        @endif
                    @endforeach

                    @foreach(Auth::user()->getRoleNames() as $role)
                        @if($role == 'Администратор' or $role == 'Модератор' or $role == 'Поддержка по вопросам общего назначения' or
                            $role == 'Поддержка по вопросам сотрудничества' or $role == 'Поддержка по вопросам споров' or
                            $role == 'Поддержка по вопросам технической части')
                            <li class="nav-header">ЧАТ-ПОДДЕРЖКА</li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-handshake"></i>
                                    <p>
                                        ЧАТЫ
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @foreach(Auth::user()->getRoleNames() as $role)
                                        @if($role == 'Администратор' or $role == 'Модератор' or $role == 'Поддержка по вопросам сотрудничества')
                                            <li class="nav-item">
                                                <a href="{{ Route('getPartnershipAppealsPage') }}" class="nav-link">
                                                    <p>Сотрудничество</p>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                    @foreach(Auth::user()->getRoleNames() as $role)
                                        @if($role == 'Администратор' or $role == 'Модератор' or $role == 'Поддержка по вопросам общего назначения')
                                            <li class="nav-item">
                                                <a href="{{ Route('getGeneralAppealsPage') }}" class="nav-link">
                                                    <p>Общие</p>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                    @foreach(Auth::user()->getRoleNames() as $role)
                                        @if($role == 'Администратор' or $role == 'Модератор' or $role == 'Поддержка по вопросам споров')
                                            <li class="nav-item">
                                                <a href="{{ Route('getDisputeAppealsPage') }}" class="nav-link">
                                                    <p>Споры</p>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                    @foreach(Auth::user()->getRoleNames() as $role)
                                        @if($role == 'Администратор' or $role == 'Модератор' or $role == 'Поддержка по вопросам технической части')
                                            <li class="nav-item">
                                                <a href="{{ Route('getTechnicalAppealsPage') }}" class="nav-link">
                                                    <p>Технические</p>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach

                    @foreach(Auth::user()->getRoleNames() as $role)
                        @if($role == 'Администратор' or $role == 'Модератор' )
                            <li class="nav-header">КОРЗИНА</li>
                            <li class="nav-item">
                                <a href="{{ Route('trashBoxIndexPage') }}" class="nav-link">
                                    <i class="nav-icon fas fa-trash"></i>
                                    <p>КОРЗИНА</p>
                                </a>
                            </li>
                        @endif
                    @endforeach

                    <li class="nav-header">ДОПОЛНИТЕЛЬНО</li>
                    <li class="nav-item">
                        <a href="https://public/adminlte.io/docs/3.1/" class="nav-link">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>ВОПРОС-ОТВЕТ</p>
                        </a>
                    </li>

                    @foreach(Auth::user()->getRoleNames() as $role)
                        @if($role == 'Администратор')
                            <li class="nav-header">СОТРУДНИКИ</li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        УПР. СОТРУДНИКАМИ
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ Route('getEmployeesPage') }}" class="nav-link">
                                            <p>Список сотрудников</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ Route('registrationEmployeePage') }}" class="nav-link">
                                            <p>Создание сотрудника</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>


    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('title')</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        @yield('content')
    </div>

    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/admin/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/admin/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/admin/plugins/moment/moment.min.js"></script>
<script src="/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/admin/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/admin/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/admin/dist/js/pages/dashboard.js"></script>
<script src="https://use.fontawesome.com/9757df0596.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


</body>
</html>


