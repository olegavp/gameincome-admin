@extends('layouts/admin_layout')

@section('title', 'Рекомендации')

@section('content')
    <div class="row ml-1 mr-1">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-list-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="{{ Route('recommendationsListPage') }}">Рекомендации</a></span>
                    <span class="info-box-number"></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-list-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><a href="{{ Route('createRecommendationPage') }}">Создание рекомендации</a></span>
                    </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
@endsection
