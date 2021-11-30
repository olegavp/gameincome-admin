@extends('layouts/admin_layout')

@section('title', 'Сообщения по обращению')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @endif

    <div class="col-md-12">
        <!-- DIRECT CHAT PRIMARY -->
        <div class="card card-primary card-outline direct-chat direct-chat-primary">
            <div class="card-header">
                <h3 class="card-title">Чат</h3>

                <div class="card-tools">
                    <button type="submit" class="btn btn-tool" onClick="window.location.reload()">
                        <i class="fas fa-undo"> Обновить сообщения</i>
                    </button>
                    <form action="{{ Route('closeTechnicalAppealMessageMethod', ['id' => $appealId]) }}" method="GET" style="display: inline-block">
                        @method('GET')
                        <button class="btn btn-tool">
                            <i class="fas fa-times"> Закрыть обращение</i>
                        </button>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="height: 400px">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages" style="height: 400px">
                    @foreach($messages as $message)
                        @if($message->admin_id == null)
                            <div class="direct-chat-msg">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left">{{ \App\Models\User::query()->find($message->user_id)->name }}</span>
                                    <span class="direct-chat-timestamp float-right">{{ $message->created_at }}</span>
                                </div>
                                <img class="direct-chat-img" src="{{ \App\Models\User::query()->find($message->user_id)->avatar }}" alt=".">
                                <div class="direct-chat-text">
                                    {{ $message->text }}
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
                        @else
                            <div class="direct-chat-msg right">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-right">{{ \App\Models\AdminUser::query()->find($message->admin_id)->name }}</span>
                                    <span class="direct-chat-timestamp float-left">{{ $message->created_at }}</span>
                                </div>
                                <!-- /.direct-chat-infos -->
                                <img class="direct-chat-img" src="https://assets.zabbix.com/img/support.svg" alt=".">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    {{ $message->text }}
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
                        @endif
                    @endforeach
                </div>
                <!--/.direct-chat-messages-->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <form action="{{ Route('sendTechnicalAppealMessageMethod', ['id' => $appealId]) }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="input-group">
                        <label for="text"></label>
                        <input type="text" name="text" id="text" placeholder="Введите новое сообщение..." class="form-control" required>
                        <span class="input-group-append">
                      <button type="submit" class="btn btn-primary">Отправить</button>
                    </span>
                    </div>
                </form>
            </div>
            <!-- /.card-footer-->
        </div>
        <!--/.direct-chat -->
    </div>
@endsection
