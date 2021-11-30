@extends('layouts/admin_layout')

@section('title', 'Новости')

@section('content')
    <div class="row ml-1 mr-1">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-newspaper"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="{{ Route('smallNews') }}">Маленькие новости</a></span>
                    <span class="info-box-number">{{ $countOfSmallNews }}</span>
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
                    <span class="info-box-text"><a href="{{ Route('bigNews') }}">Большие новости</a></span>
                    <span class="info-box-number">{{ $countOfBigNews }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-edit"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="{{ Route('createSmallNewsPage') }}">Создать маленькую новость</a></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-edit"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="{{ Route('createBigNewsPage') }}">Создать большую новость</a></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
@endsection
