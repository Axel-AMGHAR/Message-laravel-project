@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div>  <img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
                            <b>{{$user->name}}</b></div>
                    </div>
                    <div class="card-body">
                        <div class="px-0">
                            <div class="px-4 py-5 chat-box bg-white">
                            @if(isset($conversation_id))
                                @foreach($messages as $message)
                                    @if ($message[0] == Auth::user()->name )
                                        <!-- Reciever Message-->
                                            <div class="media w-50 ml-auto mb-3">
                                                <div class="media-body">
                                                    <div class="bg-primary rounded py-2 px-3 mb-2">
                                                        <p class="text-small mb-0 text-white">{{$message[1]}}</p>
                                                    </div>
                                                    <p class="small text-muted">{{$message[2]}}</p>
                                                </div>
                                            </div>

                                    @else
                                        <!-- Sender Message-->
                                            <div class="media w-50 mb-3"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
                                                <div class="media-body ml-3">
                                                    <div class="bg-light rounded py-2 px-3 mb-2">
                                                        <p class="text-small mb-0 text-muted">{{$message[1]}}</p>
                                                    </div>
                                                    <p class="small text-muted">{{$message[2]}}</p>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <form action="{{ route('chat_add')}}" class="bg-light" method="post">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name='message' placeholder="Tapez un message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light" required>
                                    @if(isset($conversation_id))
                                        <input type="hidden" name="conversation_id" value="{{ $conversation_id }}">
                                    @endif
                                    <input type="hidden" name="user" value="{{ $user}}">
                                    <div class="input-group-append">
                                        <button id="button-addon2" type="submit" class="btn btn-link"> <i class="fa fa-paper-plane"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
