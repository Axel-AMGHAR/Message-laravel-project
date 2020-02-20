@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><div><b>Liste des utilisateurs</b></div>
                    <div>(cliquer sur un utilisateur pour converser avec lui)</div>  </div>
                <div class="card-body">
                    @foreach( $users as $user)
                        <div><a href="{{ route('chat',$user->id) }}">{{$user->name}}</a></div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
