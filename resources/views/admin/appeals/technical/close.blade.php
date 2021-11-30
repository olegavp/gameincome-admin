@extends('layouts/admin_layout')

@section('title', 'Завершённые обращения по техническим вопросам')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Email обращающего</th>
                            <th>Дата создания обращения</th>
                            <th>Есть ответ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appeals as $appeal)
                            <tr>
                                <td>{{ \App\Models\User::find($appeal->user_id)->email }}</td>
                                <td>{{ $appeal->created_at }}</td>
                                @if(\App\Models\AdminPanel\Appeals\Technical\TechnicalAppealMessage::where('appeal_id', $appeal->id)->latest()->first()->user_id == $appeal->user_id)
                                    <td>Да</td>
                                @else
                                    <td>Нет</td>
                                @endif

                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ Route('toTechnicalAppealMessagesPage', ['id' => $appeal->id]) }}">
                                        <i class="fas fa-arrow-up">
                                        </i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="mt-3 ml-3">
        {{$appeals->links()}}
    </div>

    <style>
        nav div div
        {
            display: none;
        }
    </style>
@endsection
