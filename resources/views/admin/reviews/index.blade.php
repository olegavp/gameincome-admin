@extends('layouts/admin_layout')

@section('title', 'Обзоры')

@section('content')
    <div class="row ml-1 mr-1">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-credit-card"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="{{ route('allReviewsPage') }}">Список обзоров</a></span>
                    <span class="info-box-number"></span>
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
                    <span class="info-box-text"><a href="{{ Route('createReviewPage') }}">Создать обзор</a></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
@endsection
