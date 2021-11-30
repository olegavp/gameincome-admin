@extends('layouts/admin_layout')

@section('title', 'Все обращения по вопросам споров')

@section('content')
    <div class="row ml-1 mr-1">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-newspaper"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="{{ Route('getOpenDisputeAppealsPage') }}">Активные обращения</a></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-newspaper"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="{{ Route('getCloseDisputeAppealsPage') }}">Заверщённые обращения</a></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
@endsection
